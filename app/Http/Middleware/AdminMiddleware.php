<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): mixed
    {
        if(!auth()->check() || !auth()->user()->is_admin) {
            return response()->json([
                'message' => 'Unauthorized access. Admins only.'
            ], Response::HTTP_FORBIDDEN); // 403 Forbidden
        }
        return $next($request);
    }
}
