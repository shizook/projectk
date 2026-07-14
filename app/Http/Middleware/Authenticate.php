<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Tentukan ke mana user diarahkan jika tidak terotentikasi.
     */
    protected function redirectTo($request): ?string
    {
        if (! $request->expectsJson()) {
            return route('login'); // redirect ke halaman login
        }
        return null;
    }
}
