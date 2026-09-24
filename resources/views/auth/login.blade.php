<x-guest-layout>
    <div class="text-center">
        <h1 class="font-serif text-2xl font-bold text-ink">Welcome Back</h1>
        <p class="mt-2 text-sm text-ink-faint">Sign in to manage {{ setting('clinic_name', 'the practice') }}'s website.</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mt-6" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="mt-8 space-y-5">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <div class="relative mt-2">
                <span class="pointer-events-none absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
                </span>
                <x-text-input id="email" class="pl-11" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="you@example.com" />
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Password')" />
            <div class="relative mt-2">
                <span class="pointer-events-none absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                </span>
                <x-text-input id="password" class="pl-11"
                                type="password"
                                name="password"
                                required autocomplete="current-password"
                                placeholder="&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;" />
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="flex flex-wrap items-center justify-between gap-x-3 gap-y-2">
            <label for="remember_me" class="inline-flex items-center gap-2">
                <input id="remember_me" type="checkbox" class="rounded border-slate-300 text-brand-blue focus:ring-brand-blue/30" name="remember">
                <span class="text-sm text-ink-faint">{{ __('Remember me') }}</span>
            </label>

            @if (Route::has('password.request'))
                <a class="text-sm font-semibold text-brand-blue hover:underline" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif
        </div>

        <x-primary-button>
            {{ __('Log in') }}
        </x-primary-button>
    </form>
</x-guest-layout>
