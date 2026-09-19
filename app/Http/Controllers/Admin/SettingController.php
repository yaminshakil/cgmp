<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Support\ContactMailer;
use App\Support\ImageUploader;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SettingController extends Controller
{
    public const KEYS = [
        'clinic_name', 'tagline', 'address_line1', 'address_suburb', 'phone', 'contact_email', 'fax',
        'opening_hours', 'emergency_note', 'healthengine_url', 'healthengine_id', 'facebook_url', 'instagram_url',
        'google_map_embed', 'footer_text', 'copyright_text', 'analytics_code', 'mail_to', 'mail_username',
    ];

    public function edit(): View
    {
        $settings = Setting::query()->pluck('value', 'key');

        return view('admin.settings.edit', [
            'settings' => $settings,
            'hasMailPassword' => ContactMailer::hasPassword(),
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        $request->validate([
            'mail_to' => ['nullable', 'email', 'max:255'],
            'mail_username' => ['nullable', 'email', 'max:255'],
            'mail_password' => ['nullable', 'string', 'max:255'],
        ]);

        foreach (self::KEYS as $key) {
            Setting::query()->updateOrCreate(['key' => $key], ['value' => $request->input($key)]);
        }

        // Blank means "keep the saved password"; it is stored encrypted and never shown again.
        if ($request->filled('mail_password')) {
            ContactMailer::storePassword($request->input('mail_password'));
        } elseif ($request->boolean('clear_mail_password')) {
            ContactMailer::storePassword(null);
        }

        $request->validate([
            'logo' => ['nullable', 'file', 'mimes:jpg,jpeg,png,webp,svg', 'max:2048'],
            'favicon' => ['nullable', 'file', 'mimes:jpg,jpeg,png,webp,svg,ico', 'max:1024'],
        ]);

        if ($request->boolean('remove_logo')) {
            Setting::query()->updateOrCreate(['key' => 'logo_path'], ['value' => null]);
        } elseif ($request->hasFile('logo')) {
            Setting::query()->updateOrCreate(
                ['key' => 'logo_path'],
                ['value' => ImageUploader::storeLogo($request->file('logo'))]
            );
        }

        if ($request->boolean('remove_favicon')) {
            Setting::query()->updateOrCreate(['key' => 'favicon_path'], ['value' => null]);
        } elseif ($request->hasFile('favicon')) {
            Setting::query()->updateOrCreate(
                ['key' => 'favicon_path'],
                ['value' => ImageUploader::storeLogo($request->file('favicon'), 'branding', 256)]
            );
        }

        return redirect()->route('admin.settings.edit')->with('status', 'Settings updated.');
    }

    public function testMail(): RedirectResponse
    {
        try {
            ContactMailer::sendTest();
        } catch (\Throwable $e) {
            Log::error('Test email failed: '.$e->getMessage());

            return redirect()->route('admin.settings.edit')->withErrors(['mail_test' => 'Test email failed: '.$e->getMessage()]);
        }

        return redirect()->route('admin.settings.edit')->with('status', 'Test email sent to '.ContactMailer::recipient().'.');
    }
}
