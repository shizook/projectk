<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * Mencatat visitor harian di tabel site_metrics.
 * Menghindari double-count dengan session key per hari.
 */
class TrackVisitsMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $key = 'visited_today_' . date('Y-m-d');

        if (!session()->has($key)) {
            session([$key => true]);
            DB::statement("
                INSERT INTO site_metrics (metric_date, visits)
                VALUES (CURDATE(), 1)
                ON DUPLICATE KEY UPDATE visits = visits + 1
            ");
        }

        return $next($request);
    }
}
