<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\QueryException;
use Exception;

class RegisteredUserController extends Controller
{
    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): JsonResponse
    {
        try {
            $validated = $request->validate([
                'username' => ['required', 'string', 'max:255', 'unique:users,username'],
                'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email'],
                'password' => ['required', 'confirmed', Rules\Password::min(8)
                            ->mixedCase()
                            ->letters()
                            ->numbers()
                            ->symbols(),
                        'max:12',],
                'PIN' => ['required', 'digits:6'],
                'role' => ['nullable', 'string', 'in:user,admin'],
            ]);

            $user = User::create([
                'username' => $validated['username'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
                'PIN' => Hash::make($validated['PIN']), // Hashing the PIN for security
                // If 'is_admin' is provided by the client, use:
                // 'is_admin' => $request->boolean('is_admin'),
                // Otherwise, it's safer to set a default (e.g., false) in your User model or database migration.
            ]);

            $role = $validated['role'] ?? 'user'; // default: user
            $user->assignRole($role);

            event(new Registered($user));

            Log::info('User created: ID ' . $user->id);

            // Create a Sanctum token for the new user
            $token = $user->createToken('api-token')->plainTextToken;

            Auth::login($user);

            return response()->json([
                'message' => 'Registration successful!',
                'user' => $user,
                'token' => $token,
            ], 201); // 201 Created

        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Validation error during registration: ', $e->errors());
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $e->errors(),
            ], 422); // 422 Unprocessable Entity

        } catch (QueryException $e) {
            Log::error('Database query error during registration: ' . $e->getMessage());
            return response()->json([
                'message' => 'A database error occurred. It\'s possible the username or email already exists.',
                'error' => $e->getMessage(),
            ], 409); // 409 Conflict

        } catch (\TypeError $e) {
            Log::error('Type error during registration: ' . $e->getMessage());
            return response()->json([
                'message' => 'Invalid input type provided.',
                'error' => $e->getMessage(),
            ], 400); // 400 Bad Request

        } catch (Exception $e) {
            Log::error('General error during registration: ' . $e->getMessage());
            return response()->json([
                'message' => 'Something went wrong during registration',
                'error' => $e->getMessage(),
            ], 500); // 500 Internal Server Error
        }
    }
}
