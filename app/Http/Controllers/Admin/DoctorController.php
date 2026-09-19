<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Support\ImageUploader;
use App\Support\TextStyles;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    public function index(): View
    {
        return view('admin.doctors.index', [
            'doctors' => Doctor::query()->orderBy('sort_order')->orderBy('name')->get(),
        ]);
    }

    public function create(): View
    {
        return view('admin.doctors.form', ['doctor' => new Doctor()]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validated($request);

        if ($request->hasFile('photo')) {
            $data['photo'] = ImageUploader::store($request->file('photo'), 'doctors');
        }

        Doctor::create($data);

        return redirect()->route('admin.doctors.index')->with('status', 'Doctor created.');
    }

    public function edit(Doctor $doctor): View
    {
        return view('admin.doctors.form', ['doctor' => $doctor]);
    }

    public function update(Request $request, Doctor $doctor): RedirectResponse
    {
        $data = $this->validated($request);

        if ($request->boolean('remove_photo')) {
            $data['photo'] = null;
        } elseif ($request->hasFile('photo')) {
            $data['photo'] = ImageUploader::store($request->file('photo'), 'doctors');
        }

        $doctor->update($data);

        return redirect()->route('admin.doctors.index')->with('status', 'Doctor updated.');
    }

    public function destroy(Doctor $doctor): RedirectResponse
    {
        $doctor->delete();

        return redirect()->route('admin.doctors.index')->with('status', 'Doctor deleted.');
    }

    private function validated(Request $request): array
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'role' => ['nullable', 'string', 'max:255'],
            'qualifications' => ['nullable', 'string', 'max:500'],
            'bio' => ['nullable', 'string'],
            'years_experience' => ['nullable', 'string', 'max:50'],
            'languages' => ['nullable', 'string', 'max:255'],
            'availability_days' => ['nullable', 'array'],
            'availability_days.*' => ['string', 'in:sun,mon,tue,wed,thu,fri'],
            'sort_order' => ['nullable', 'integer'],
            'is_active' => ['nullable', 'boolean'],
            'photo' => ['nullable', 'image', 'max:4096'],
        ]);

        $data['is_active'] = $request->boolean('is_active');
        $data['availability_days'] = array_values($data['availability_days'] ?? []);
        $data['text_styles'] = TextStyles::sanitizeAll(
            $request->input('text_styles', []),
            ['name', 'qualifications', 'role', 'bio']
        );
        unset($data['photo']);

        return $data;
    }
}
