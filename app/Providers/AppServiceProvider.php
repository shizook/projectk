<?php

namespace App\Providers;

use App\Models\SiteSetting;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        View::composer('*', function ($view) {
            static $logo;

            if (!isset($logo)) {
                $logo = null;

                if (Schema::hasTable('site_settings')) {
                    $value = SiteSetting::getValue('site_logo');

                    if ($value) {
                        $logo = asset('storage/' . ltrim($value, '/'));
                    }
                }
            }

            $view->with('siteLogo', $logo);
        });
    }
}