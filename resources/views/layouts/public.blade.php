<!DOCTYPE html>
<html lang="en-AU" class="bg-[#023a58]">
<head>
    <script>
        (function () {
            var stored = localStorage.getItem('cgmp-theme');
            if (stored === 'dark') {
                document.documentElement.classList.add('dark');
            }
        })();
    </script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <meta name="theme-color" content="#023a58">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <title>@yield('title', setting('clinic_name')) | {{ setting('clinic_name') }}</title>
    <meta name="description" content="@yield('meta_description', setting('tagline'))">
    <link rel="canonical" href="{{ url()->current() }}">

    <meta property="og:type" content="website">
    <meta property="og:site_name" content="{{ setting('clinic_name') }}">
    <meta property="og:title" content="@yield('title', setting('clinic_name'))">
    <meta property="og:description" content="@yield('meta_description', setting('tagline'))">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="{{ asset('images/hero-team.jpg') }}">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('title', setting('clinic_name'))">
    <meta name="twitter:description" content="@yield('meta_description', setting('tagline'))">
    <meta name="twitter:image" content="{{ asset('images/hero-team.jpg') }}">

    <script type="application/ld+json">
    {!! json_encode([
        '@context' => 'https://schema.org',
        '@type' => 'MedicalClinic',
        'name' => setting('clinic_name'),
        'url' => url('/'),
        'telephone' => setting('phone'),
        'email' => setting('contact_email'),
        'address' => [
            '@type' => 'PostalAddress',
            'streetAddress' => setting('address_line1'),
            'addressLocality' => setting('address_suburb'),
            'addressCountry' => 'AU',
        ],
    ], JSON_UNESCAPED_SLASHES) !!}
    </script>

    @if(setting('favicon_path') || setting('logo_path'))
        <link rel="icon" href="{{ image_url(setting('favicon_path') ?: setting('logo_path')) }}">
        <link rel="apple-touch-icon" href="{{ image_url(setting('favicon_path') ?: setting('logo_path')) }}">
    @else
        <link rel="icon" href="/icon.svg" type="image/svg+xml">
        <link rel="apple-touch-icon" href="/apple-icon.png">
    @endif

    <link rel="preconnect" href="https://cdn.jsdelivr.net">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/inter@5/400.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/inter@5/500.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/inter@5/600.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/inter@5/700.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/montserrat@5/600.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/playfair-display@5/600.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/playfair-display@5/700.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/playfair-display@5/800.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/playfair-display@5/700-italic.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    {!! setting('analytics_code') !!}
</head>
<body class="bg-white font-sans antialiased dark:bg-[#121212] dark:text-[#e0e0e0]" x-data>
    <div class="sticky top-0 z-30">
        <x-header />
    </div>

    <main>
        @yield('content')
    </main>

    <x-footer />
</body>
</html>
