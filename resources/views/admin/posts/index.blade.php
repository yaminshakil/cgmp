@extends('layouts.admin')

@section('title', 'Blog Posts')

@section('content')
<div class="mb-4 flex justify-end">
    <a href="{{ route('admin.posts.create') }}" class="rounded-lg bg-brand-blue px-4 py-2 text-sm font-semibold text-white">+ New Post</a>
</div>

<div class="overflow-hidden rounded-xl bg-white shadow-sm">
    <div class="overflow-x-auto">
        <table class="w-full text-left text-sm">
        <thead class="bg-gray-50 text-gray-500">
            <tr><th class="p-4">Title</th><th class="p-4">Category</th><th class="p-4">Status</th><th class="p-4">Published</th><th class="p-4"></th></tr>
        </thead>
        <tbody class="divide-y">
            @foreach($posts as $post)
                <tr>
                    <td class="p-4 font-semibold">{{ $post->title }}</td>
                    <td class="p-4">{{ $post->category?->name }}</td>
                    <td class="p-4 capitalize">{{ $post->status }}</td>
                    <td class="p-4">{{ $post->published_at?->format('j M Y') }}</td>
                    <td class="p-4 text-right">
                        <a href="{{ route('admin.posts.edit', $post) }}" class="font-semibold text-brand-blue">Edit</a>
                        <form action="{{ route('admin.posts.destroy', $post) }}" method="POST" class="inline" onsubmit="return confirm('Delete this post?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="ml-3 font-semibold text-red-600">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    </div>
</div>
@endsection
