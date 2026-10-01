<!DOCTYPE html>
<html lang="en-AU" class="bg-[#023a58]">
<head>
    <script>
        (function () {
            try {
                if (localStorage.getItem('cgmp-theme') === 'dark') {
                    document.documentElement.classList.add('dark');
                }
            } catch (e) {}
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
    <meta property="og:image" content="@yield('og_image', asset('images/clinic-exterior.jpg'))">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('title', setting('clinic_name'))">
    <meta name="twitter:description" content="@yield('meta_description', setting('tagline'))">
    <meta name="twitter:image" content="@yield('og_image', asset('images/clinic-exterior.jpg'))">

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
    ], JSON_UNESCAPED_SLASHES | JSON_HEX_TAG | JSON_HEX_AMP) !!}
    </script>

    @include('partials.favicon')

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <noscript><style>[data-reveal], .hero-in { opacity: 1 !important; transform: none !important; }</style></noscript>
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
    <x-booking-modal />
</body>
</html>
