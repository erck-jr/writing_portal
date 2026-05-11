<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::all()->pluck('value', 'key');
        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'logo_type' => 'required|in:text,image',
            'site_logo' => 'required_if:logo_type,text|nullable|string|max:20',
            'site_logo_image' => 'required_if:logo_type,image|nullable|image|max:2048',
            'welcome_title' => 'required|string|max:255',
            'welcome_description' => 'required|string',
            'social_instagram' => 'nullable|string',
            'social_facebook' => 'nullable|string',
            'social_tiktok' => 'nullable|string',
            'footer_text' => 'required|string',
        ]);

        if ($request->hasFile('site_logo_image')) {
            $path = $request->file('site_logo_image')->store('settings', 'public');
            Setting::set('site_logo_image', $path);
        }

        foreach ($validated as $key => $value) {
            if ($key !== 'site_logo_image') {
                Setting::set($key, $value);
            }
        }

        return redirect()->back()->with('success', 'Pengaturan berhasil diperbarui!');
    }
}
