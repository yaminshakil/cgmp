@extends('layouts.admin')

@section('title', 'My Profile')

@section('content')
<div class="grid max-w-2xl gap-6">
    <div class="rounded-xl bg-white p-4 shadow-sm sm:p-6">
        @include('profile.partials.update-profile-information-form')
    </div>

    <div class="rounded-xl bg-white p-4 shadow-sm sm:p-6">
        @include('profile.partials.update-password-form')
    </div>
</div>
@endsection
