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
                            ->symbols()
                            ->uncompromised(),
                        'max:12',],
                'PIN' => ['required', 'digits:6'],
            ]);

            $user = User::create([
                'username' => $validated['username'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
                'PIN' => Hash::make($validated['PIN']),
            ]);

            event(new Registered($user));

            Auth::login($user);

            $token = $user->createToken('api-token')->plainTextToken;

            return response()->json([
                'user' => $user,
                'token' => $token,
            ], 201); // 201 Created

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $e->errors(),
            ], 422); // 422 Unprocessable Entity

        } catch (QueryException $e) {
            // kemungkinan duplicate atau masalah query
            return response()->json([
                'message' => 'Email already exists.',
                'error' => $e->getMessage(),
            ], 409); // 409 Conflict

        } catch (\TypeError $e) {
            return response()->json([
                'message' => 'Invalid input type',
                'error' => $e->getMessage(),
            ], 400); // 400 Bad Request

        } catch (Exception $e) {
            Log::error('Registration error: '.$e->getMessage());

            return response()->json([
                'message' => 'Something went wrong during registration',
            ], 500); // 500 Internal Server Error
        }
    }
}
