<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard') — {{ setting('clinic_name', 'CGMP') }} Admin</title>

    @if(setting('favicon_path') || setting('logo_path'))
        <link rel="icon" href="{{ image_url(setting('favicon_path') ?: setting('logo_path')) }}">
        <link rel="apple-touch-icon" href="{{ image_url(setting('favicon_path') ?: setting('logo_path')) }}">
    @else
        <link rel="icon" href="/icon.svg" type="image/svg+xml">
        <link rel="apple-touch-icon" href="/apple-icon.png">
    @endif

    <link rel="preconnect" href="https://cdn.jsdelivr.net">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/aileron@5/index.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/aileron@5/600.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/aileron@5/700.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/fraunces@5/600.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/fraunces@5/700.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/trix@2/dist/trix.css">
    <script src="https://cdn.jsdelivr.net/npm/trix@2/dist/trix.umd.min.js" defer></script>
    <style>
        trix-toolbar .trix-button { font-size: 0.8rem; }
        trix-editor { min-height: 220px; border-radius: 0.5rem; border-color: #d1d5db; }
    </style>
    @stack('scripts')
</head>
<body class="bg-[#F3F6FA] font-sans antialiased text-gray-900" x-data="{ sidebarOpen: false }">
    <div class="flex min-h-screen">
        <div x-show="sidebarOpen" x-cloak @click="sidebarOpen = false" class="fixed inset-0 z-30 bg-black/50 lg:hidden" x-transition.opacity></div>

        <aside
            class="fixed inset-y-0 left-0 z-40 w-64 -translate-x-full transform overflow-y-auto bg-brand-blue-darker text-blue-100 transition-transform duration-300 lg:static lg:w-64 lg:shrink-0 lg:translate-x-0"
            :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
        >
            <div class="flex items-center justify-between border-b border-white/10 p-6">
                <a href="{{ route('admin.dashboard') }}"><x-logo light /></a>
                <button aria-label="Close menu" class="text-blue-100/70 hover:text-white lg:hidden" @click="sidebarOpen = false">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18M6 6l12 12"/></svg>
                </button>
            </div>
            <nav class="mt-4 flex flex-col gap-1 px-4 text-sm">
                @php
                    $links = [
                        ['admin.dashboard', 'Dashboard', 'M3 3h8v8H3zM13 3h8v5h-8zM13 12h8v9h-8zM3 15h8v6H3z'],
                        ['admin.services.index', 'Services', 'M4.8 2.3A.3.3 0 1 0 4.2 2.3.3.3 0 0 0 4.8 2.3M8 2v11.7a5.3 5.3 0 0 0 10.6 0V9.3a2.3 2.3 0 1 0-4.6 0v1.4a1 1 0 0 1-2 0V9.3a4.3 4.3 0 1 1 8.6 0v4.4a7.3 7.3 0 0 1-14.6 0V2M19.2 2.3A.3.3 0 1 0 18.6 2.3.3.3 0 0 0 19.2 2.3'],
                        ['admin.doctors.index', 'Doctors', 'M12 12a5 5 0 1 0 0-10 5 5 0 0 0 0 10ZM20 21a8 8 0 0 0-16 0'],
                        ['admin.posts.index', 'Blog Posts', 'M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8zM14 2v6h6M9 13h6M9 17h6M9 9h1'],
                        ['admin.categories.index', 'Categories', 'M20.6 12.3 12.3 20.6a2 2 0 0 1-2.8 0L2 13.1V4a2 2 0 0 1 2-2h9.1a2 2 0 0 1 1.4.6l6.1 6.1a2 2 0 0 1 0 2.8zM7 7h.01'],
                        ['admin.faqs.index', 'FAQs', 'M9 9a3 3 0 1 1 4 2.83c-.7.26-1.3.93-1.3 1.67V14M12 17.5h.01M12 22a10 10 0 1 0 0-20 10 10 0 0 0 0 20z'],
                        ['admin.pages.index', 'Pages', 'M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8zM14 2v6h6M10 12h4M10 16h4'],
                        ['admin.sections.edit', 'Homepage Sections', 'M3 9h18M9 21V9M3 5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z'],
                        ['admin.settings.edit', 'Settings', 'M12 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6zM19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 1 1-2.83 2.83l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-4 0v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 1 1-2.83-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1 0-4h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 1 1 2.83-2.83l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 4 0v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 1 1 2.83 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 0 4h-.09a1.65 1.65 0 0 0-1.51 1z'],
                        ['admin.messages.index', 'Messages', 'M4 4h16v16H4zM4 8l8 6 8-6'],
                    ];
                @endphp
                @foreach($links as [$routeName, $label, $iconPath])
                    <a href="{{ route($routeName) }}" class="flex items-center gap-3 rounded-lg border-l-4 px-3 py-2 transition-colors duration-200 {{ request()->routeIs($routeName.'*') ? 'border-sky-400 bg-white/10 font-semibold text-white' : 'border-transparent hover:bg-white/5' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="{{ $iconPath }}"/></svg>
                        {{ $label }}
                    </a>
                @endforeach
            </nav>
            <div class="mt-8 border-t border-white/10 px-4 pt-4 text-sm">
                <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 rounded-lg px-3 py-2 hover:bg-white/5">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21a8 8 0 0 0-16 0"/><circle cx="12" cy="7" r="4"/></svg>
                    My Profile
                </a>
                <a href="{{ route('home') }}" class="flex items-center gap-3 rounded-lg px-3 py-2 hover:bg-white/5" target="_blank">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><path d="M15 3h6v6M10 14 21 3"/></svg>
                    View Site
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="mt-1 flex w-full items-center gap-3 rounded-lg px-3 py-2 text-left hover:bg-white/5">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><path d="M16 17l5-5-5-5"/><path d="M21 12H9"/></svg>
                        Log Out
                    </button>
                </form>
            </div>
        </aside>

        <div class="min-w-0 flex-1">
            <header class="flex items-center justify-between gap-3 border-b-2 border-brand-blue bg-white px-4 py-4 shadow-[0_2px_16px_rgba(15,42,67,0.08)] sm:px-6">
                <div class="flex min-w-0 items-center gap-3">
                    <button aria-label="Open menu" class="shrink-0 text-[#062238] lg:hidden" @click="sidebarOpen = true">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 12h18M3 6h18M3 18h18"/></svg>
                    </button>
                    <h1 class="truncate font-serif text-lg font-bold text-[#062238] sm:text-xl">@yield('title', 'Dashboard')</h1>
                </div>
                <div class="flex shrink-0 items-center gap-2.5 text-sm text-gray-600">
                    <span class="admin-icon-badge flex h-8 w-8 shrink-0 items-center justify-center rounded-full text-xs font-bold text-white">
                        {{ collect(explode(' ', auth()->user()?->name ?? 'A'))->map(fn ($w) => mb_substr($w, 0, 1))->implode('') }}
                    </span>
                    <span class="hidden sm:inline">{{ auth()->user()?->name }}</span>
                </div>
            </header>

            <main class="p-4 sm:p-6">
                @if(session('status') && ! in_array(session('status'), ['profile-updated', 'password-updated', 'verification-link-sent'], true))
                    <div class="mb-6 rounded-xl bg-emerald-50 p-4 text-emerald-800">{{ session('status') }}</div>
                @endif
                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>
