@extends('layouts.admin')

@section('title', $faq->exists ? 'Edit FAQ' : 'New FAQ')

@section('content')
<form method="POST" action="{{ $faq->exists ? route('admin.faqs.update', $faq) : route('admin.faqs.store') }}" class="max-w-2xl rounded-xl bg-white p-6 shadow-sm">
    @csrf
    @if($faq->exists) @method('PUT') @endif

    <div class="grid gap-5">
        <label class="block">
            <span class="text-sm font-semibold">Question *</span>
            <input type="text" name="question" value="{{ old('question', $faq->question) }}" required class="mt-1 w-full rounded-lg border-gray-300">
            <x-text-style-control name="text_styles[question]" :style="$faq->text_styles['question'] ?? null" />
        </label>

        <label class="block">
            <span class="text-sm font-semibold">Answer *</span>
            <textarea name="answer" required class="mt-1 w-full rounded-lg border-gray-300" rows="4">{{ old('answer', $faq->answer) }}</textarea>
            <x-text-style-control name="text_styles[answer]" :style="$faq->text_styles['answer'] ?? null" />
        </label>

        <label class="block">
            <span class="text-sm font-semibold">Sort order</span>
            <input type="number" name="sort_order" value="{{ old('sort_order', $faq->sort_order ?? 0) }}" class="mt-1 w-32 rounded-lg border-gray-300">
        </label>

        <label class="flex items-center gap-2">
            <input type="checkbox" name="is_active" value="1" @checked(old('is_active', $faq->is_active ?? true)) class="rounded border-gray-300">
            <span class="text-sm font-semibold">Active</span>
        </label>
    </div>

    <div class="mt-6 flex gap-3">
        <button type="submit" class="rounded-lg bg-brand-blue px-5 py-2 font-semibold text-white">Save</button>
        <a href="{{ route('admin.faqs.index') }}" class="rounded-lg border px-5 py-2 font-semibold">Cancel</a>
    </div>
</form>
@endsection
