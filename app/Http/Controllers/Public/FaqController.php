<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Contracts\View\View;

class FaqController extends Controller
{
    public function __invoke(): View
    {
        return view('pages.faq', [
            'faqs' => Faq::active()->get(),
        ]);
    }
}
