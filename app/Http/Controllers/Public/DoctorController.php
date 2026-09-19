<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use Illuminate\Contracts\View\View;

class DoctorController extends Controller
{
    public function index(): View
    {
        return view('pages.doctors', [
            'doctors' => Doctor::active()->get(),
        ]);
    }

    public function show(Doctor $doctor): View
    {
        abort_unless($doctor->is_active, 404);

        return view('pages.doctor', ['doctor' => $doctor]);
    }
}
