<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Section;
use App\Support\HtmlSanitizer;
use App\Support\ImageUploader;
use App\Support\TextStyles;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    public function edit(): View
    {
        return view('admin.sections.edit', [
            'hero' => section_data('hero'),
            'about' => section_data('about'),
            'nearestHospitals' => section_data('nearest_hospitals'),
            'navigation' => section_data('navigation'),
            'footerLinks' => section_data('footer_links'),
        ]);
    }

    public function updateHero(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'heading' => ['required', 'string', 'max:255'],
            'subheading' => ['nullable', 'string', 'max:500'],
            'badge_text' => ['nullable', 'string', 'max:255'],
            'primary_button_text' => ['nullable', 'string', 'max:100'],
            'primary_button_link' => ['nullable', 'string', 'max:255'],
            'secondary_button_text' => ['nullable', 'string', 'max:100'],
            'secondary_button_link' => ['nullable', 'string', 'max:255'],
            'review_rating' => ['nullable', 'string', 'max:20'],
            'review_count' => ['nullable', 'string', 'max:20'],
            'video_url' => ['nullable', 'url:http,https', 'max:500'],
            'image' => ['nullable', 'image', 'max:6144'],
            'mobile_image' => ['nullable', 'image', 'max:6144'],
            'bg_color' => ['nullable', 'regex:/^#[0-9a-fA-F]{6}$/'],
            'text_color' => ['nullable', 'regex:/^#[0-9a-fA-F]{6}$/'],
        ]);

        $current = section_data('hero');
        unset($data['image'], $data['mobile_image']);

        // Drop javascript:/data: links; only http(s), mailto, tel and site-relative URLs are kept.
        $data['primary_button_link'] = HtmlSanitizer::safeUrl($data['primary_button_link'] ?? null);
        $data['secondary_button_link'] = HtmlSanitizer::safeUrl($data['secondary_button_link'] ?? null);
        $data['video_url'] = HtmlSanitizer::safeUrl($data['video_url'] ?? null);

        // The color picker always submits a value, so a checkbox opts into using it;
        // left unchecked, the section keeps its default gradient background.
        $data['bg_color'] = $request->boolean('use_bg_color') ? ($data['bg_color'] ?? null) : null;
        $data['text_color'] = $request->boolean('use_text_color') ? ($data['text_color'] ?? null) : null;

        if ($request->boolean('remove_image')) {
            ImageUploader::delete($current['image'] ?? null);
            $data['image'] = null;
        } elseif ($request->hasFile('image')) {
            ImageUploader::delete($current['image'] ?? null);
            $data['image'] = ImageUploader::store($request->file('image'), 'sections', 2000);
        } else {
            $data['image'] = $current['image'] ?? null;
        }

        if ($request->boolean('remove_mobile_image')) {
            ImageUploader::delete($current['mobile_image'] ?? null);
            $data['mobile_image'] = null;
        } elseif ($request->hasFile('mobile_image')) {
            ImageUploader::delete($current['mobile_image'] ?? null);
            $data['mobile_image'] = ImageUploader::store($request->file('mobile_image'), 'sections', 1600);
        } else {
            $data['mobile_image'] = $current['mobile_image'] ?? null;
        }

        $data['styles'] = TextStyles::sanitizeAll(
            $request->input('text_styles', []),
            ['heading', 'subheading', 'badge_text']
        );

        Section::store('hero', $data);

        return redirect()->route('admin.sections.edit')->with('status', 'Hero section updated.');
    }

    public function updateAbout(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'heading' => ['required', 'string', 'max:255'],
            'subheading' => ['nullable', 'string', 'max:500'],
            'body' => ['nullable', 'string'],
            'points' => ['nullable', 'string'],
            'image' => ['nullable', 'image', 'max:6144'],
        ]);

        $current = section_data('about');
        $points = collect(explode("\n", (string) ($data['points'] ?? '')))
            ->map(fn ($line) => trim($line))
            ->filter()
            ->values()
            ->all();

        $payload = [
            'heading' => $data['heading'],
            'subheading' => $data['subheading'] ?? ($current['subheading'] ?? ''),
            'body' => HtmlSanitizer::clean($data['body'] ?? ''),
            'points' => $points,
            'stats' => $current['stats'] ?? [],
            'image' => $current['image'] ?? null,
            'styles' => TextStyles::sanitizeAll(
                $request->input('text_styles', []),
                ['heading', 'subheading', 'body']
            ),
        ];

        if ($request->boolean('remove_image')) {
            ImageUploader::delete($current['image'] ?? null);
            $payload['image'] = null;
        } elseif ($request->hasFile('image')) {
            ImageUploader::delete($current['image'] ?? null);
            $payload['image'] = ImageUploader::store($request->file('image'), 'sections', 2000);
        }

        Section::store('about', $payload);

        return redirect()->route('admin.sections.edit')->with('status', 'About section updated.');
    }

    public function updateNearestHospitals(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'hospitals' => ['nullable', 'string'],
        ]);

        $hospitals = collect(explode("\n", (string) ($data['hospitals'] ?? '')))
            ->map(fn ($line) => trim($line))
            ->filter()
            ->map(function ($line) {
                $parts = array_map('trim', explode('|', $line));

                return [
                    'name' => $parts[0] ?? '',
                    'distance' => $parts[1] ?? '',
                    'address' => $parts[2] ?? '',
                    'phone' => $parts[3] ?? '',
                ];
            })
            ->filter(fn ($hospital) => $hospital['name'] !== '')
            ->values()
            ->all();

        Section::store('nearest_hospitals', ['hospitals' => $hospitals]);

        return redirect()->route('admin.sections.edit')->with('status', 'Nearest hospitals updated.');
    }

    public function updateNavigation(Request $request): RedirectResponse
    {
        Section::store('navigation', ['items' => $this->parseLinkLines($request, 'items')]);

        return redirect()->route('admin.sections.edit')->with('status', 'Navigation menu updated.');
    }

    public function updateFooterLinks(Request $request): RedirectResponse
    {
        Section::store('footer_links', ['items' => $this->parseLinkLines($request, 'items')]);

        return redirect()->route('admin.sections.edit')->with('status', 'Footer links updated.');
    }

    private function parseLinkLines(Request $request, string $field): array
    {
        $data = $request->validate([
            $field => ['nullable', 'string'],
        ]);

        return collect(explode("\n", (string) ($data[$field] ?? '')))
            ->map(fn ($line) => trim($line))
            ->filter()
            ->map(function ($line) {
                $parts = array_map('trim', explode('|', $line));

                return [
                    'label' => $parts[0] ?? '',
                    'url' => HtmlSanitizer::safeUrl($parts[1] ?? '') ?? '',
                ];
            })
            ->filter(fn ($item) => $item['label'] !== '' && $item['url'] !== '')
            ->values()
            ->all();
    }
}
