@extends('layouts.admin')

@section('title', 'Message from ' . $message->name)

@section('content')
<div class="max-w-2xl rounded-xl bg-white p-6 shadow-sm">
    <dl class="grid gap-3 text-sm">
        <div><dt class="font-semibold text-gray-500">Name</dt><dd>{{ $message->name }}</dd></div>
        <div><dt class="font-semibold text-gray-500">Email</dt><dd><a href="mailto:{{ $message->email }}" class="text-brand-blue">{{ $message->email }}</a></dd></div>
        @if($message->phone)
            <div><dt class="font-semibold text-gray-500">Phone</dt><dd>{{ $message->phone }}</dd></div>
        @endif
        <div><dt class="font-semibold text-gray-500">Received</dt><dd>{{ $message->created_at->format('j M Y g:ia') }}</dd></div>
        <div>
            <dt class="font-semibold text-gray-500">Message</dt>
            <dd class="mt-1 whitespace-pre-line rounded-lg bg-gray-50 p-4">{{ $message->message }}</dd>
        </div>
    </dl>

    <div class="mt-6 flex flex-wrap gap-3">
        <a href="{{ route('admin.messages.index') }}" class="rounded-lg border px-5 py-2 font-semibold">Back to Messages</a>
        <form action="{{ route('admin.messages.destroy', $message) }}" method="POST" onsubmit="return confirm('Delete this message?')">
            @csrf @method('DELETE')
            <button type="submit" class="rounded-lg border border-red-300 px-5 py-2 font-semibold text-red-600">Delete</button>
        </form>
    </div>
</div>
@endsection
