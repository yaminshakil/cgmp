@extends('layouts.admin')

@section('title', 'FAQs')

@section('content')
<div class="mb-4 flex justify-end">
    <a href="{{ route('admin.faqs.create') }}" class="rounded-lg bg-brand-blue px-4 py-2 text-sm font-semibold text-white">+ New FAQ</a>
</div>

<div class="overflow-hidden rounded-xl bg-white shadow-sm">
    <div class="overflow-x-auto">
        <table class="w-full text-left text-sm">
        <thead class="bg-gray-50 text-gray-500">
            <tr><th class="p-4">Question</th><th class="p-4">Order</th><th class="p-4">Active</th><th class="p-4"></th></tr>
        </thead>
        <tbody class="divide-y">
            @foreach($faqs as $faq)
                <tr>
                    <td class="p-4 font-semibold">{{ $faq->question }}</td>
                    <td class="p-4">{{ $faq->sort_order }}</td>
                    <td class="p-4">{{ $faq->is_active ? 'Yes' : 'No' }}</td>
                    <td class="p-4 text-right">
                        <a href="{{ route('admin.faqs.edit', $faq) }}" class="font-semibold text-brand-blue">Edit</a>
                        <form action="{{ route('admin.faqs.destroy', $faq) }}" method="POST" class="inline" onsubmit="return confirm('Delete this FAQ?')">
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
