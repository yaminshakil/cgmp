<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use App\Support\ContactMailer;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Throwable;

class ContactController extends Controller
{
    public function show(): View
    {
        return view('pages.contact');
    }

    public function store(Request $request): RedirectResponse|JsonResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:50'],
            'message' => ['required', 'string', 'max:5000'],
        ]);

        $message = ContactMessage::create($data);

        try {
            ContactMailer::send($message);
        } catch (Throwable $e) {
            // The message is already saved; don't show the visitor an error if mail fails.
            Log::error('Contact form email failed: '.$e->getMessage());
        }

        $status = 'Thanks — your message has been sent. We\'ll be in touch soon.';

        if ($request->expectsJson()) {
            return response()->json(['message' => $status]);
        }

        // No-JS fallback: return to the form rather than the top of the page.
        $returnTo = route('contact');
        $previous = url()->previous() ?: $returnTo;
        // Only follow a referer on this same host to avoid open-redirecting to external sites.
        if (parse_url($previous, PHP_URL_HOST) === null || parse_url($previous, PHP_URL_HOST) === parse_url($returnTo, PHP_URL_HOST)) {
            $returnTo = $previous;
        }

        return redirect($returnTo.'#contact-form')->with('status', $status);
    }
}
