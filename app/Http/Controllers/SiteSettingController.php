<?php

namespace App\Http\Controllers;

use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;

class SiteSettingController extends Controller
{
    public function updateLogo(Request $request)
    {
        if (!Schema::hasTable('site_settings')) {
            return back()->withErrors([
                'logo' => 'Tabel pengaturan situs belum tersedia. Jalankan migrasi dengan perintah php artisan migrate.',
            ]);
        }

        $data = $request->validate([
            'logo' => ['nullable', 'image', 'max:1024'],
            'remove_logo' => ['nullable', 'boolean'],
        ]);

        $setting = SiteSetting::firstOrNew(['key' => 'site_logo']);
        $current = $setting->value;

        if ($request->hasFile('logo')) {
            $path = $request->file('logo')->store('branding', 'public');
            $setting->value = $path;

            if ($current && Storage::disk('public')->exists($current)) {
                Storage::disk('public')->delete($current);
            }
        } elseif ($request->boolean('remove_logo')) {
            if ($current && Storage::disk('public')->exists($current)) {
                Storage::disk('public')->delete($current);
            }
            $setting->value = null;
        }

        $setting->save();

        return back()->with('ok', 'Logo situs diperbarui.');
    }
}
