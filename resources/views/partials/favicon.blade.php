@if(setting('favicon_path'))
    {{-- Icon uploaded under Admin → Settings --}}
    <link rel="icon" href="{{ image_url(setting('favicon_path')) }}">
    <link rel="apple-touch-icon" href="{{ image_url(setting('favicon_path')) }}">
@else
    {{-- Bundled square heart icons (the wide logo shrinks to an unreadable sliver in a tab) --}}
    <link rel="icon" href="{{ asset('favicon.ico') }}" sizes="48x48">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('icon-32.png') }}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('icon-192.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('apple-icon.png') }}">
@endif
