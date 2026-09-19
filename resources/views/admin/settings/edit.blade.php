@extends('layouts.admin')

@section('title', 'Settings')

@section('content')
<form method="POST" action="{{ route('admin.settings.update') }}" enctype="multipart/form-data" class="max-w-2xl rounded-xl bg-white p-4 shadow-sm sm:p-6">
    @csrf @method('PUT')

    <div class="grid gap-5">
        <h2 class="font-bold text-gray-700">Branding</h2>
        <div class="flex items-start gap-4">
            <div class="flex h-16 w-28 shrink-0 items-center justify-center rounded-lg border border-dashed border-gray-300 bg-gray-50">
                @if($settings['logo_path'] ?? null)
                    <img src="{{ image_url($settings['logo_path']) }}" alt="Current logo" class="max-h-14 max-w-full object-contain">
                @else
                    <span class="px-2 text-center text-xs text-gray-400">Default mark</span>
                @endif
            </div>
            <div class="min-w-0 flex-1">
                <label class="block">
                    <span class="text-sm font-semibold">Logo image <span class="text-gray-400">(PNG, SVG, or JPG with transparent background recommended)</span></span>
                    <input type="file" name="logo" accept=".png,.svg,.jpg,.jpeg,.webp" class="mt-1 w-full rounded-lg border-gray-300 text-sm">
                </label>
                @if($settings['logo_path'] ?? null)
                    <label class="mt-2 flex items-center gap-2 text-sm text-gray-600">
                        <input type="checkbox" name="remove_logo" value="1" class="rounded border-gray-300">
                        Remove uploaded logo and use the default mark
                    </label>
                @endif
            </div>
        </div>

        <div class="flex items-start gap-4">
            <div class="flex h-16 w-16 shrink-0 items-center justify-center rounded-lg border border-dashed border-gray-300 bg-gray-50">
                @if($settings['favicon_path'] ?? null)
                    <img src="{{ image_url($settings['favicon_path']) }}" alt="Current favicon" class="max-h-10 max-w-full object-contain">
                @else
                    <span class="px-1 text-center text-xs text-gray-400">Default</span>
                @endif
            </div>
            <div class="min-w-0 flex-1">
                <label class="block">
                    <span class="text-sm font-semibold">Favicon <span class="text-gray-400">(browser tab icon &mdash; square PNG or SVG recommended)</span></span>
                    <input type="file" name="favicon" accept=".png,.svg,.jpg,.jpeg,.webp,.ico" class="mt-1 w-full rounded-lg border-gray-300 text-sm">
                </label>
                @if($settings['favicon_path'] ?? null)
                    <label class="mt-2 flex items-center gap-2 text-sm text-gray-600">
                        <input type="checkbox" name="remove_favicon" value="1" class="rounded border-gray-300">
                        Remove uploaded favicon and use the default
                    </label>
                @endif
            </div>
        </div>

        <h2 class="mt-4 font-bold text-gray-700">Identity</h2>
        <label class="block">
            <span class="text-sm font-semibold">Clinic name</span>
            <input type="text" name="clinic_name" value="{{ old('clinic_name', $settings['clinic_name'] ?? '') }}" class="mt-1 w-full rounded-lg border-gray-300">
        </label>
        <label class="block">
            <span class="text-sm font-semibold">Tagline</span>
            <input type="text" name="tagline" value="{{ old('tagline', $settings['tagline'] ?? '') }}" class="mt-1 w-full rounded-lg border-gray-300">
        </label>

        <h2 class="mt-4 font-bold text-gray-700">Contact</h2>
        <label class="block">
            <span class="text-sm font-semibold">Address line</span>
            <input type="text" name="address_line1" value="{{ old('address_line1', $settings['address_line1'] ?? '') }}" class="mt-1 w-full rounded-lg border-gray-300">
        </label>
        <label class="block">
            <span class="text-sm font-semibold">Suburb / postcode</span>
            <input type="text" name="address_suburb" value="{{ old('address_suburb', $settings['address_suburb'] ?? '') }}" class="mt-1 w-full rounded-lg border-gray-300">
        </label>
        <label class="block">
            <span class="text-sm font-semibold">Phone</span>
            <input type="text" name="phone" value="{{ old('phone', $settings['phone'] ?? '') }}" class="mt-1 w-full rounded-lg border-gray-300">
        </label>
        <label class="block">
            <span class="text-sm font-semibold">Email</span>
            <input type="email" name="contact_email" value="{{ old('contact_email', $settings['contact_email'] ?? '') }}" class="mt-1 w-full rounded-lg border-gray-300">
        </label>
        <label class="block">
            <span class="text-sm font-semibold">Fax <span class="text-gray-400">(leave blank if none)</span></span>
            <input type="text" name="fax" value="{{ old('fax', $settings['fax'] ?? '') }}" class="mt-1 w-full rounded-lg border-gray-300">
        </label>
        <label class="block">
            <span class="text-sm font-semibold">Opening hours <span class="text-gray-400">(one line per day)</span></span>
            <textarea name="opening_hours" class="mt-1 w-full rounded-lg border-gray-300" rows="3">{{ old('opening_hours', $settings['opening_hours'] ?? '') }}</textarea>
        </label>
        <label class="block">
            <span class="text-sm font-semibold">Emergency note</span>
            <input type="text" name="emergency_note" value="{{ old('emergency_note', $settings['emergency_note'] ?? '') }}" class="mt-1 w-full rounded-lg border-gray-300">
        </label>

        <h2 class="mt-4 font-bold text-gray-700">Contact form email</h2>
        <p class="-mt-3 text-sm text-gray-500">Messages sent from the website contact form are emailed to the address below. To send them, enter a Gmail address and its <a href="https://myaccount.google.com/apppasswords" target="_blank" rel="noopener" class="text-brand-blue underline">app password</a> (needs 2-Step Verification on).</p>
        <label class="block">
            <span class="text-sm font-semibold">Send messages to</span>
            <input type="email" name="mail_to" value="{{ old('mail_to', $settings['mail_to'] ?? config('mail.contact_to')) }}" class="mt-1 w-full rounded-lg border-gray-300">
        </label>
        <label class="block">
            <span class="text-sm font-semibold">Sending Gmail address</span>
            <input type="email" name="mail_username" value="{{ old('mail_username', $settings['mail_username'] ?? '') }}" autocomplete="off" class="mt-1 w-full rounded-lg border-gray-300">
        </label>
        <label class="block">
            <span class="text-sm font-semibold">App password <span class="text-gray-400">{{ $hasMailPassword ? '(saved — leave blank to keep it)' : '(not set)' }}</span></span>
            <input type="password" name="mail_password" value="" autocomplete="new-password" placeholder="{{ $hasMailPassword ? '••••••••••••••••' : '16-character app password' }}" class="mt-1 w-full rounded-lg border-gray-300">
        </label>
        @if($hasMailPassword)
            <label class="flex items-center gap-2 text-sm text-gray-600">
                <input type="checkbox" name="clear_mail_password" value="1" class="rounded border-gray-300"> Remove the saved app password
            </label>
        @endif
        @error('mail_test')
            <p class="rounded-lg bg-red-50 px-3 py-2 text-sm text-red-700">{{ $message }}</p>
        @enderror
        <h2 class="mt-4 font-bold text-gray-700">Booking</h2>
        <label class="block">
            <span class="text-sm font-semibold">HealthEngine practice page URL <span class="text-gray-400">(your public HealthEngine listing, used as a fallback link)</span></span>
            <input type="url" name="healthengine_url" value="{{ old('healthengine_url', $settings['healthengine_url'] ?? '') }}" class="mt-1 w-full rounded-lg border-gray-300">
        </label>
        <label class="block">
            <span class="text-sm font-semibold">HealthEngine practice ID <span class="text-gray-400">(the numeric ID from your HealthEngine "Web Plugin" embed code, e.g. 98588 &mdash; enables the real live-availability booking popup instead of just a link)</span></span>
            <input type="text" name="healthengine_id" value="{{ old('healthengine_id', $settings['healthengine_id'] ?? '') }}" class="mt-1 w-full rounded-lg border-gray-300">
        </label>

        <h2 class="mt-4 font-bold text-gray-700">Social</h2>
        <label class="block">
            <span class="text-sm font-semibold">Facebook URL</span>
            <input type="url" name="facebook_url" value="{{ old('facebook_url', $settings['facebook_url'] ?? '') }}" class="mt-1 w-full rounded-lg border-gray-300">
        </label>
        <label class="block">
            <span class="text-sm font-semibold">Instagram URL</span>
            <input type="url" name="instagram_url" value="{{ old('instagram_url', $settings['instagram_url'] ?? '') }}" class="mt-1 w-full rounded-lg border-gray-300">
        </label>

        <h2 class="mt-4 font-bold text-gray-700">Footer &amp; SEO</h2>
        <label class="block">
            <span class="text-sm font-semibold">Footer text</span>
            <textarea name="footer_text" class="mt-1 w-full rounded-lg border-gray-300" rows="2">{{ old('footer_text', $settings['footer_text'] ?? '') }}</textarea>
        </label>
        <label class="block">
            <span class="text-sm font-semibold">Copyright text <span class="text-gray-400">(leave blank to use clinic name)</span></span>
            <input type="text" name="copyright_text" value="{{ old('copyright_text', $settings['copyright_text'] ?? '') }}" class="mt-1 w-full rounded-lg border-gray-300">
        </label>
        <label class="block">
            <span class="text-sm font-semibold">Google Map embed URL</span>
            <input type="url" name="google_map_embed" value="{{ old('google_map_embed', $settings['google_map_embed'] ?? '') }}" class="mt-1 w-full rounded-lg border-gray-300">
        </label>
        <label class="block">
            <span class="text-sm font-semibold">Analytics code <span class="text-gray-400">(raw HTML/JS snippet)</span></span>
            <textarea name="analytics_code" class="mt-1 w-full rounded-lg border-gray-300 font-mono text-sm" rows="3">{{ old('analytics_code', $settings['analytics_code'] ?? '') }}</textarea>
        </label>
    </div>

    <div class="mt-6">
        <button type="submit" class="rounded-lg bg-brand-blue px-5 py-2 font-semibold text-white">Save Settings</button>
        <button type="submit" form="test-mail-form" class="ml-2 rounded-lg border border-gray-300 px-5 py-2 font-semibold text-gray-700">Send test email</button>
    </div>
</form>
<form id="test-mail-form" method="POST" action="{{ route('admin.settings.test-mail') }}">@csrf</form>
@endsection
