<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class AuthenticatedSessionController extends Controller
{
    /**
     * Handle an API authentication request (Bearer token, not session).
     */
    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        try {
            $request->validate([
                'username' => 'required|string',
                'password' => 'required|string',
            ]);

            // Attempt login using provided credentials
            if (!Auth::attempt($request->only('username', 'password'))) {
                return response()->json([
                    'message' => 'Invalid credentials',
                ], Response::HTTP_UNAUTHORIZED); // 401
            }

            $user = Auth::user();

            if (!$user) {
                return response()->json([
                    'message' => 'Authentication failed. User not found.',
                ], Response::HTTP_UNAUTHORIZED);
            }

            // Create personal access token using Laravel Sanctum
            $token = $user->createToken('api-token')->plainTextToken;

            return response()->json([
                'user' => $user,
                'token' => $token,
            ], Response::HTTP_OK);

        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $e->errors(),
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        } catch (Throwable $e) {
            Log::error('Login error: ' . $e->getMessage());

            return response()->json([
                'message' => 'Internal server error',
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Logout and revoke token (Bearer token version).
     */
    public function destroy(Request $request): \Illuminate\Http\JsonResponse
    {
        try {
            $user = $request->user();

            if (!$user) {
                return response()->json([
                    'message' => 'Unauthenticated'
                ], Response::HTTP_UNAUTHORIZED);
            }

            $user->currentAccessToken()->delete();

            return response()->json([
                'message' => 'Logged out successfully',
            ], Response::HTTP_OK);

        } catch (Throwable $e) {
            Log::error('Logout error: ' . $e->getMessage());

            return response()->json([
                'message' => 'Internal server error during logout'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
