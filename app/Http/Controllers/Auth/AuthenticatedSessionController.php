<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class AuthenticatedSessionController extends Controller
{
    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): JsonResponse
    {
        try {
            $request->authenticate();

            $user = Auth::user();

            if (!$user) {
                return response()->json([
                    'message' => 'Authentication failed. User not found.'
                ], Response::HTTP_UNAUTHORIZED); // 401
            }

            $token = $user->createToken('api-token')->plainTextToken;

            return response()->json([
                'user' => $user,
                'token' => $token,
            ], Response::HTTP_OK); // 200 OK

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $e->errors(),
            ], Response::HTTP_UNPROCESSABLE_ENTITY); // 422

        } catch (Throwable $e) {
            Log::error('Login error: ' . $e->getMessage());

            return response()->json([
                'message' => 'Internal server error'
            ], Response::HTTP_INTERNAL_SERVER_ERROR); // 500
        }
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): JsonResponse
    {
        try {
            $user = $request->user();

            if (!$user) {
                return response()->json([
                    'message' => 'Unauthenticated'
                ], Response::HTTP_UNAUTHORIZED); // 401
            }

            $user->currentAccessToken()->delete();

            return response()->json([
                'message' => 'Logged out successfully'
            ], Response::HTTP_OK); // 200 OK

        } catch (Throwable $e) {
            Log::error('Logout error: ' . $e->getMessage());

            return response()->json([
                'message' => 'Internal server error during logout'
            ], Response::HTTP_INTERNAL_SERVER_ERROR); // 500
        }
    }
}
