<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{
    /**
     * Gunakan: ->middleware('role:admin') atau ('role:author,admin')
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        $user = $request->user();
        if (!$user) {
            abort(403, 'Unauthorized.');
        }

        // Jika tidak disebutkan roles, cukup pastikan sudah login
        if (empty($roles)) {
            return $next($request);
        }

        if (!in_array($user->role, $roles)) {
            abort(403, 'Forbidden.');
        }

        return $next($request);
    }
}
