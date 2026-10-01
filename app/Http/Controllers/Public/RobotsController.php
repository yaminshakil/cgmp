<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class RobotsController extends Controller
{
    /** Served dynamically because the Sitemap line must be an absolute URL on the live domain. */
    public function __invoke(): Response
    {
        $body = "User-agent: *\nDisallow: /admin\n\nSitemap: " . route('sitemap') . "\n";

        return response($body, 200, ['Content-Type' => 'text/plain; charset=UTF-8']);
    }
}
