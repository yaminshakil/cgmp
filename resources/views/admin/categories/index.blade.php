@extends('layouts.admin')

@section('title', 'Categories')

@section('content')
<div class="grid gap-6 md:grid-cols-2">
    <div class="rounded-xl bg-white p-6 shadow-sm">
        <h2 class="font-bold">Add Category</h2>
        <form method="POST" action="{{ route('admin.categories.store') }}" class="mt-4 flex gap-3">
            @csrf
            <input type="text" name="name" placeholder="Category name" required class="w-full rounded-lg border-gray-300">
            <button type="submit" class="shrink-0 rounded-lg bg-brand-blue px-5 py-2 font-semibold text-white">Add</button>
        </form>
    </div>

    <div class="overflow-hidden rounded-xl bg-white shadow-sm">
        <div class="overflow-x-auto">
        <table class="w-full text-left text-sm">
            <thead class="bg-gray-50 text-gray-500">
                <tr><th class="p-4">Name</th><th class="p-4"></th></tr>
            </thead>
            <tbody class="divide-y">
                @foreach($categories as $category)
                    <tr>
                        <td class="p-4">
                            <form method="POST" action="{{ route('admin.categories.update', $category) }}" class="flex gap-2">
                                @csrf @method('PUT')
                                <input type="text" name="name" value="{{ $category->name }}" class="w-full rounded-lg border-gray-300 text-sm">
                                <button type="submit" class="shrink-0 text-sm font-semibold text-brand-blue">Save</button>
                            </form>
                        </td>
                        <td class="p-4 text-right">
                            <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" onsubmit="return confirm('Delete this category?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="font-semibold text-red-600">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        </div>
    </div>
</div>
@endsection
