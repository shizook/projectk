<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\SiteSetting;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DashboardController extends Controller
{
    public function index()
    {
        $visitorsRaw = DB::table('site_metrics')
            ->orderBy('metric_date')
            ->limit(14)
            ->get();

        $visitors = collect($visitorsRaw)->map(function ($row) {
            return [
                'date' => Carbon::parse($row->metric_date)->format('d M'),
                'visits' => $row->visits,
            ];
        });

        $vLabels = $visitors->pluck('date')->toArray();
        $vData = $visitors->pluck('visits')->toArray();

        $topPostsRaw = Post::published()
            ->orderByDesc('view_count')
            ->take(5)
            ->get(['title', 'view_count']);

        $tpLabels = $topPostsRaw->pluck('title')->toArray();
        $tpData = $topPostsRaw->pluck('view_count')->toArray();

        $last7 = DB::table('post_views')
            ->select('post_id', 'view_date', 'views')
            ->where('view_date', '>=', now()->subDays(6)->toDateString())
            ->get();

        $currentLogoPath = Schema::hasTable('site_settings') ? SiteSetting::getValue('site_logo') : null;

        return view('admin.dashboard', compact('vLabels', 'vData', 'tpLabels', 'tpData', 'last7', 'currentLogoPath'));
    }
}
