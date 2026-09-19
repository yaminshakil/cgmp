<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Contracts\View\View;

class ServiceController extends Controller
{
    public function index(): View
    {
        return view('services.index', [
            'services' => Service::active()->get(),
        ]);
    }

    public function show(Service $service): View
    {
        return view('services.show', [
            'service' => $service,
            'others' => Service::active()->where('id', '!=', $service->id)->take(3)->get(),
        ]);
    }
}
