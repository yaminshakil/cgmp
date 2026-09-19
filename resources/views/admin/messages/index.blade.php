@extends('layouts.admin')

@section('title', 'Messages')

@section('content')
<div class="overflow-hidden rounded-xl bg-white shadow-sm">
    <div class="overflow-x-auto">
        <table class="w-full text-left text-sm">
        <thead class="bg-gray-50 text-gray-500">
            <tr><th class="p-4">Name</th><th class="p-4">Email</th><th class="p-4">Received</th><th class="p-4">Status</th><th class="p-4"></th></tr>
        </thead>
        <tbody class="divide-y">
            @forelse($messages as $message)
                <tr class="{{ $message->is_read ? '' : 'bg-brand-blue-tint/40 font-semibold' }}">
                    <td class="p-4"><a href="{{ route('admin.messages.show', $message) }}" class="text-brand-blue">{{ $message->name }}</a></td>
                    <td class="p-4">{{ $message->email }}</td>
                    <td class="p-4">{{ $message->created_at->format('j M Y g:ia') }}</td>
                    <td class="p-4">{{ $message->is_read ? 'Read' : 'Unread' }}</td>
                    <td class="p-4 text-right">
                        <form action="{{ route('admin.messages.destroy', $message) }}" method="POST" onsubmit="return confirm('Delete this message?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="font-semibold text-red-600">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="5" class="p-4 text-gray-500">No messages yet.</td></tr>
            @endforelse
        </tbody>
    </table>
    </div>
</div>
@endsection
