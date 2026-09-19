<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;

class EmergencyController extends Controller
{
    public function __invoke(): View
    {
        return view('pages.emergency', [
            'hospitals' => section_data('nearest_hospitals')['hospitals'] ?? [],
        ]);
    }
}
