<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            'clinic_name' => 'Cringila General Medical Practice',
            'tagline' => 'Personalised support for all your healthcare needs',
            'address_line1' => '[Street address — verify with practice]',
            'address_suburb' => 'Cringila NSW 2502',
            'phone' => '(02) 0000 0000',
            'contact_email' => 'reception@cgmp.com.au',
            'fax' => '',
            'opening_hours' => "Sunday - Friday: 8:30am - 5:30pm\nSaturday: Closed",
            'emergency_note' => 'In a medical emergency, call 000 immediately.',
            'healthengine_url' => '',
            'healthengine_id' => '98588',
            'facebook_url' => '',
            'instagram_url' => '',
            'google_map_embed' => '',
            'footer_text' => 'Personalised, bulk-billing healthcare for Cringila and surrounding communities. Same day appointments and walk-ins welcome.',
            'copyright_text' => '',
            'analytics_code' => '',
        ];

        foreach ($settings as $key => $value) {
            Setting::query()->updateOrCreate(['key' => $key], ['value' => $value]);
        }
    }
}
