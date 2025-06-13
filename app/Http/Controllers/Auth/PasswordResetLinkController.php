<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;
use App\Models\User;

class PasswordResetLinkController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'username' => ['required', 'string', 'exists:users,username'],
            'email' => ['required', 'email', 'exists:users,email'],
            'pin' => ['required', 'string', 'size:6'],
        ]);


        $user = User::where('email', $request->email)
        ->where('username', $request->username)
        ->first();

        if (!$user || !Hash::check($request->pin, $user->PIN)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials do not match our records.'],
            ]);
        }

        return response()->json([
            'status' => $user->only('id', 'username', 'email')
        ]);

        // $status = Password::sendResetLink(
        //     $request->only('email')
        // );

        // if ($status === Password::RESET_LINK_SENT) {
        //     return response()->json(['status' => __($status)]);
        // }

        // throw ValidationException::withMessages([
        //     'email' => [__($status)],
        // ]);
    }
}
