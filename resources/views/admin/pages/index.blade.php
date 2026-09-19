@extends('layouts.admin')

@section('title', 'Pages')

@section('content')
<div class="mb-4 flex justify-end">
    <a href="{{ route('admin.pages.create') }}" class="rounded-lg bg-brand-blue px-4 py-2 text-sm font-semibold text-white">+ New Page</a>
</div>

<div class="overflow-hidden rounded-xl bg-white shadow-sm">
    <div class="overflow-x-auto">
        <table class="w-full text-left text-sm">
        <thead class="bg-gray-50 text-gray-500">
            <tr><th class="p-4">Title</th><th class="p-4">Slug</th><th class="p-4"></th></tr>
        </thead>
        <tbody class="divide-y">
            @foreach($pages as $page)
                <tr>
                    <td class="p-4 font-semibold">{{ $page->title }}</td>
                    <td class="p-4 text-gray-500">/{{ $page->slug }}</td>
                    <td class="p-4 text-right">
                        <a href="{{ route('admin.pages.edit', $page) }}" class="font-semibold text-brand-blue">Edit</a>
                        <form action="{{ route('admin.pages.destroy', $page) }}" method="POST" class="inline" onsubmit="return confirm('Delete this page?')">
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
