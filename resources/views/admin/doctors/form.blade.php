@extends('layouts.admin')

@section('title', $doctor->exists ? 'Edit Doctor' : 'New Doctor')

@section('content')
<form method="POST" action="{{ $doctor->exists ? route('admin.doctors.update', $doctor) : route('admin.doctors.store') }}" enctype="multipart/form-data" class="max-w-2xl rounded-xl bg-white p-6 shadow-sm">
    @csrf
    @if($doctor->exists) @method('PUT') @endif

    <div class="grid gap-5">
        <label class="block">
            <span class="text-sm font-semibold">Name *</span>
            <input type="text" name="name" value="{{ old('name', $doctor->name) }}" required class="mt-1 w-full rounded-lg border-gray-300">
            @error('name')<span class="text-sm text-red-600">{{ $message }}</span>@enderror
            <x-text-style-control name="text_styles[name]" :style="$doctor->text_styles['name'] ?? null" />
        </label>

        <label class="block">
            <span class="text-sm font-semibold">Role</span>
            <input type="text" name="role" value="{{ old('role', $doctor->role) }}" placeholder="e.g. Practice Principal" class="mt-1 w-full rounded-lg border-gray-300">
            <x-text-style-control name="text_styles[role]" :style="$doctor->text_styles['role'] ?? null" />
        </label>

        <label class="block">
            <span class="text-sm font-semibold">Qualifications</span>
            <input type="text" name="qualifications" value="{{ old('qualifications', $doctor->qualifications) }}" placeholder="e.g. MBBS, DCH, FRACGP" class="mt-1 w-full rounded-lg border-gray-300">
            <x-text-style-control name="text_styles[qualifications]" :style="$doctor->text_styles['qualifications'] ?? null" />
        </label>

        <label class="block">
            <span class="text-sm font-semibold">Bio</span>
            <textarea name="bio" class="mt-1 w-full rounded-lg border-gray-300" rows="4">{{ old('bio', $doctor->bio) }}</textarea>
            <x-text-style-control name="text_styles[bio]" :style="$doctor->text_styles['bio'] ?? null" />
        </label>

        <div class="grid gap-5 sm:grid-cols-2">
            <label class="block">
                <span class="text-sm font-semibold">Years of experience</span>
                <input type="text" name="years_experience" value="{{ old('years_experience', $doctor->years_experience) }}" placeholder="e.g. 12+ yrs" class="mt-1 w-full rounded-lg border-gray-300">
            </label>

            <label class="block">
                <span class="text-sm font-semibold">Languages spoken</span>
                <input type="text" name="languages" value="{{ old('languages', $doctor->languages) }}" placeholder="Comma separated, e.g. English, Bengali" class="mt-1 w-full rounded-lg border-gray-300">
            </label>
        </div>

        <label class="block">
            <span class="text-sm font-semibold">HealthEngine doctor ID <span class="text-gray-400">(numeric ID from HealthEngine; when set, this doctor's Book Appointment button preselects them in the booking popup)</span></span>
            <input type="number" min="1" name="healthengine_doctor_id" value="{{ old('healthengine_doctor_id', $doctor->healthengine_doctor_id) }}" placeholder="e.g. 118736" class="mt-1 w-full rounded-lg border-gray-300">
        </label>

        <div class="block">
            <span class="text-sm font-semibold">Available days</span>
            <div class="mt-2 flex flex-wrap gap-3">
                @php
                    $selectedDays = old('availability_days', $doctor->availability_days ?? []);
                    $dayOptions = ['sun' => 'Sun', 'mon' => 'Mon', 'tue' => 'Tue', 'wed' => 'Wed', 'thu' => 'Thu', 'fri' => 'Fri'];
                @endphp
                @foreach($dayOptions as $value => $label)
                    <label class="flex items-center gap-1.5 text-sm">
                        <input type="checkbox" name="availability_days[]" value="{{ $value }}" @checked(in_array($value, $selectedDays)) class="rounded border-gray-300">
                        {{ $label }}
                    </label>
                @endforeach
            </div>
        </div>

        <label class="block">
            <span class="text-sm font-semibold">Photo</span>
            <input type="file" name="photo" accept="image/*" class="mt-1 w-full">
            @if($doctor->photo)
                <img src="{{ image_url($doctor->photo) }}" class="mt-2 h-24 w-24 rounded-full object-cover" alt="">
                <label class="mt-2 flex items-center gap-2 text-sm text-gray-600">
                    <input type="checkbox" name="remove_photo" value="1" class="rounded border-gray-300">
                    Remove photo
                </label>
            @endif
        </label>

        <label class="block">
            <span class="text-sm font-semibold">Sort order</span>
            <input type="number" name="sort_order" value="{{ old('sort_order', $doctor->sort_order ?? 0) }}" class="mt-1 w-32 rounded-lg border-gray-300">
        </label>

        <label class="flex items-center gap-2">
            <input type="checkbox" name="is_active" value="1" @checked(old('is_active', $doctor->is_active ?? true)) class="rounded border-gray-300">
            <span class="text-sm font-semibold">Active (shown on the public site)</span>
        </label>
    </div>

    <div class="mt-6 flex gap-3">
        <button type="submit" class="rounded-lg bg-brand-blue px-5 py-2 font-semibold text-white">Save</button>
        <a href="{{ route('admin.doctors.index') }}" class="rounded-lg border px-5 py-2 font-semibold">Cancel</a>
    </div>
</form>
@endsection
