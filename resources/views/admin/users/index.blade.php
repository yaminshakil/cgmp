@extends('layouts.admin')

@section('title', 'Users')

@section('content')
<div class="mb-4 flex justify-end">
    <a href="{{ route('admin.users.create') }}" class="rounded-lg bg-brand-blue px-4 py-2 text-sm font-semibold text-white">+ New User</a>
</div>

<div class="overflow-hidden rounded-xl bg-white shadow-sm">
    <div class="overflow-x-auto">
        <table class="w-full text-left text-sm">
            <thead class="bg-gray-50 text-gray-500">
                <tr><th class="p-4">Name</th><th class="p-4">Email</th><th class="p-4">Role</th><th class="p-4"></th></tr>
            </thead>
            <tbody class="divide-y">
                @foreach($users as $user)
                    <tr>
                        <td class="p-4 font-semibold">{{ $user->name }}@if($user->is(auth()->user())) <span class="text-xs font-normal text-gray-400">(you)</span>@endif</td>
                        <td class="p-4">{{ $user->email }}</td>
                        <td class="p-4">
                            <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-semibold {{ $user->isAdmin() ? 'bg-blue-100 text-blue-700' : 'bg-amber-100 text-amber-700' }}">{{ ucfirst($user->role) }}</span>
                        </td>
                        <td class="p-4 text-right">
                            <a href="{{ route('admin.users.edit', $user) }}" class="font-semibold text-brand-blue">Edit</a>
                            @unless($user->is(auth()->user()))
                                <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="inline" onsubmit="return confirm('Delete this user?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="ml-3 font-semibold text-red-600">Delete</button>
                                </form>
                            @endunless
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection