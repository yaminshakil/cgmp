@extends('layouts.admin')

@section('title', 'Doctors')

@section('content')
<div class="mb-4 flex justify-end">
    <a href="{{ route('admin.doctors.create') }}" class="rounded-lg bg-brand-blue px-4 py-2 text-sm font-semibold text-white">+ New Doctor</a>
</div>

<div class="overflow-hidden rounded-xl bg-white shadow-sm">
    <div class="overflow-x-auto">
        <table class="w-full text-left text-sm">
        <thead class="bg-gray-50 text-gray-500">
            <tr><th class="p-4">Name</th><th class="p-4">Role</th><th class="p-4">Active</th><th class="p-4"></th></tr>
        </thead>
        <tbody class="divide-y">
            @foreach($doctors as $doctor)
                <tr>
                    <td class="p-4 font-semibold">{{ $doctor->name }}</td>
                    <td class="p-4">{{ $doctor->role }}</td>
                    <td class="p-4">{{ $doctor->is_active ? 'Yes' : 'No' }}</td>
                    <td class="p-4 text-right">
                        <a href="{{ route('admin.doctors.edit', $doctor) }}" class="font-semibold text-brand-blue">Edit</a>
                        <form action="{{ route('admin.doctors.destroy', $doctor) }}" method="POST" class="inline" onsubmit="return confirm('Delete this doctor?')">
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
