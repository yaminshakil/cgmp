@extends('layouts.admin')

@section('title', $user->exists ? 'Edit User' : 'New User')

@section('content')
<form method="POST" action="{{ $user->exists ? route('admin.users.update', $user) : route('admin.users.store') }}" class="max-w-2xl rounded-xl bg-white p-6 shadow-sm">
    @csrf
    @if($user->exists) @method('PUT') @endif

    <div class="grid gap-5">
        <label class="block">
            <span class="text-sm font-semibold">Name *</span>
            <input type="text" name="name" value="{{ old('name', $user->name) }}" required class="mt-1 w-full rounded-lg border-gray-300">
            @error('name')<span class="mt-1 block text-sm text-red-600">{{ $message }}</span>@enderror
        </label>

        <label class="block">
            <span class="text-sm font-semibold">Email *</span>
            <input type="email" name="email" value="{{ old('email', $user->email) }}" required class="mt-1 w-full rounded-lg border-gray-300">
            @error('email')<span class="mt-1 block text-sm text-red-600">{{ $message }}</span>@enderror
        </label>

        <label class="block">
            <span class="text-sm font-semibold">Role *</span>
            @if($user->is(auth()->user()))<input type="hidden" name="role" value="{{ $user->role }}">@endif
            <select name="role" class="mt-1 w-full rounded-lg border-gray-300 sm:w-64" @disabled($user->is(auth()->user()))>
                <option value="manager" @selected(old('role', $user->role) === 'manager')>Manager</option>
                <option value="admin" @selected(old('role', $user->role) === 'admin')>Admin</option>
            </select>
            <span class="mt-1 block text-xs text-gray-500">Managers can edit all content and messages but cannot open Settings or manage users.</span>
            @error('role')<span class="mt-1 block text-sm text-red-600">{{ $message }}</span>@enderror
        </label>

        <div class="grid gap-5 sm:grid-cols-2">
            <label class="block">
                <span class="text-sm font-semibold">Password {{ $user->exists ? '' : '*' }}</span>
                <input type="password" name="password" @required(! $user->exists) autocomplete="new-password" class="mt-1 w-full rounded-lg border-gray-300">
                @if($user->exists)<span class="mt-1 block text-xs text-gray-500">Leave blank to keep the current password.</span>@endif
                @error('password')<span class="mt-1 block text-sm text-red-600">{{ $message }}</span>@enderror
            </label>
            <label class="block">
                <span class="text-sm font-semibold">Confirm password</span>
                <input type="password" name="password_confirmation" autocomplete="new-password" class="mt-1 w-full rounded-lg border-gray-300">
            </label>
        </div>
    </div>

    <div class="mt-6 flex gap-3">
        <button type="submit" class="rounded-lg bg-brand-blue px-5 py-2 font-semibold text-white">Save</button>
        <a href="{{ route('admin.users.index') }}" class="rounded-lg border px-5 py-2 font-semibold">Cancel</a>
    </div>
</form>
@endsection