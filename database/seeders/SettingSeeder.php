<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            'site_logo' => 'WP',
            'logo_type' => 'text',
            'site_logo_image' => '',
            'welcome_title' => 'Menulis. Terhubung. Berkembang.',
            'welcome_description' => 'Tempat bagi pemikiran minimalist dan ide-ide mendalam. Bergabunglah dengan komunitas penulis kami dan bagikan visimu dengan dunia.',
            'social_instagram' => '',
            'social_facebook' => '',
            'social_tiktok' => '',
            'footer_text' => '© ' . date('Y') . ' Writing Portal. Dibuat dengan cinta dan minimalisme.',
        ];

        foreach ($settings as $key => $value) {
            Setting::updateOrCreate(['key' => $key], ['value' => $value]);
        }
    }
}
