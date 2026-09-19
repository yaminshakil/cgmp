<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ __('Sign In') }} | {{ setting('clinic_name', config('app.name', 'Laravel')) }}</title>

        <link rel="preconnect" href="https://cdn.jsdelivr.net">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/inter@5/400.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/inter@5/500.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/inter@5/600.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/inter@5/700.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/playfair-display@5/700.css">

        @if(setting('favicon_path') || setting('logo_path'))
            <link rel="icon" href="{{ image_url(setting('favicon_path') ?: setting('logo_path')) }}">
        @endif

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-[#062238] antialiased">
        <div class="flex min-h-screen flex-col items-center justify-center bg-brand-blue-tint px-6 py-12">
            <a href="/" class="mb-8">
                <x-logo />
            </a>

            <div class="w-full sm:max-w-md">
                <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white p-8 shadow-xl sm:p-10">
                    {{ $slot }}
                </div>

                <p class="mt-6 text-center text-sm text-[#60758d]">
                    <a href="/" class="font-semibold text-brand-blue hover:underline">&larr; Back to website</a>
                </p>
            </div>
        </div>
    </body>
</html>
