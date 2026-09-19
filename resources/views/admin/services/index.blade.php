@extends('layouts.admin')

@section('title', 'Services')

@section('content')
<div class="mb-4 flex justify-end">
    <a href="{{ route('admin.services.create') }}" class="rounded-lg bg-brand-blue px-4 py-2 text-sm font-semibold text-white">+ New Service</a>
</div>

<div class="overflow-hidden rounded-xl bg-white shadow-sm">
    <div class="overflow-x-auto">
        <table class="w-full text-left text-sm">
        <thead class="bg-gray-50 text-gray-500">
            <tr><th class="p-4">Title</th><th class="p-4">Order</th><th class="p-4">Active</th><th class="p-4"></th></tr>
        </thead>
        <tbody class="divide-y">
            @foreach($services as $service)
                <tr>
                    <td class="p-4 font-semibold">{{ $service->title }}</td>
                    <td class="p-4">{{ $service->sort_order }}</td>
                    <td class="p-4">{{ $service->is_active ? 'Yes' : 'No' }}</td>
                    <td class="p-4 text-right">
                        <a href="{{ route('admin.services.edit', $service) }}" class="font-semibold text-brand-blue">Edit</a>
                        <form action="{{ route('admin.services.destroy', $service) }}" method="POST" class="inline" onsubmit="return confirm('Delete this service?')">
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
