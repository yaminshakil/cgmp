@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="grid gap-6 md:grid-cols-3">
    <div class="rounded-xl bg-white p-6 shadow-sm transition-all duration-300 hover:-translate-y-0.5 hover:shadow-md">
        <div class="admin-icon-badge flex h-10 w-10 items-center justify-center rounded-xl">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16v16H4zM4 8l8 6 8-6"/></svg>
        </div>
        <p class="mt-4 text-sm text-gray-500">Unread Messages</p>
        <p class="mt-1 text-3xl font-bold text-ink">{{ $unreadMessages }}</p>
        <a href="{{ route('admin.messages.index') }}" class="mt-3 inline-flex items-center gap-1 text-sm font-semibold text-brand-blue transition-transform duration-200 hover:translate-x-1">
            View messages
            <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
        </a>
    </div>
    <div class="rounded-xl bg-white p-6 shadow-sm transition-all duration-300 hover:-translate-y-0.5 hover:shadow-md">
        <div class="admin-icon-badge flex h-10 w-10 items-center justify-center rounded-xl">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
        </div>
        <p class="mt-4 text-sm text-gray-500">Total Messages</p>
        <p class="mt-1 text-3xl font-bold text-ink">{{ $totalMessages }}</p>
    </div>
    <div class="rounded-xl bg-white p-6 shadow-sm transition-all duration-300 hover:-translate-y-0.5 hover:shadow-md">
        <div class="admin-icon-badge flex h-10 w-10 items-center justify-center rounded-xl">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M13 2 3 14h9l-1 8 10-12h-9z"/></svg>
        </div>
        <p class="mt-4 text-sm text-gray-500">Quick Links</p>
        <div class="mt-3 flex flex-col gap-2 text-sm">
            <a href="{{ route('admin.posts.create') }}" class="font-semibold text-brand-blue hover:underline">+ New blog post</a>
            <a href="{{ route('admin.sections.edit') }}" class="font-semibold text-brand-blue hover:underline">Edit homepage content</a>
            @if(auth()->user()->isAdmin())
                <a href="{{ route('admin.settings.edit') }}" class="font-semibold text-brand-blue hover:underline">Edit site settings</a>
            @endif
        </div>
    </div>
</div>

<div class="mt-8 overflow-hidden rounded-xl bg-white shadow-sm">
    <div class="flex items-center gap-3 border-b border-gray-100 px-6 py-4">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-brand-blue" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><path d="M14 2v6h6M9 13h6M9 17h6M9 9h1"/></svg>
        <h2 class="font-serif text-lg font-bold text-ink">Recent Blog Posts</h2>
    </div>
    <div class="overflow-x-auto">
    <table class="w-full text-left text-sm">
        <thead class="bg-gray-50 text-xs uppercase tracking-wide text-gray-500">
            <tr>
                <th class="px-6 py-3 font-semibold">Title</th>
                <th class="px-6 py-3 font-semibold">Status</th>
                <th class="px-6 py-3 font-semibold">Updated</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse($recentPosts as $post)
                <tr class="transition-colors duration-150 hover:bg-brand-blue-tint/40">
                    <td class="px-6 py-3"><a href="{{ route('admin.posts.edit', $post) }}" class="font-semibold text-brand-blue hover:underline">{{ $post->title }}</a></td>
                    <td class="px-6 py-3">
                        <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-semibold {{ $post->status === 'published' ? 'bg-blue-100 text-blue-700' : 'bg-amber-100 text-amber-700' }}">{{ ucfirst($post->status) }}</span>
                    </td>
                    <td class="px-6 py-3 text-gray-500">{{ $post->updated_at->diffForHumans() }}</td>
                </tr>
            @empty
                <tr><td colspan="3" class="px-6 py-6 text-center text-gray-500">No posts yet.</td></tr>
            @endforelse
        </tbody>
    </table>
    </div>
</div>
@endsection
