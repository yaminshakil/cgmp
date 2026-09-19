<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Section;
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
            'image' => ['nullable', 'image', 'max:6144'],
        ]);

        $current = section_data('hero');
        unset($data['image']);

        if ($request->boolean('remove_image')) {
            $data['image'] = null;
        } elseif ($request->hasFile('image')) {
            $data['image'] = ImageUploader::store($request->file('image'), 'sections', 2000);
        } else {
            $data['image'] = $current['image'] ?? null;
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
            'body' => $data['body'] ?? '',
            'points' => $points,
            'stats' => $current['stats'] ?? [],
            'image' => $current['image'] ?? null,
            'styles' => TextStyles::sanitizeAll(
                $request->input('text_styles', []),
                ['heading', 'subheading', 'body']
            ),
        ];

        if ($request->boolean('remove_image')) {
            $payload['image'] = null;
        } elseif ($request->hasFile('image')) {
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
                    'url' => $parts[1] ?? '',
                ];
            })
            ->filter(fn ($item) => $item['label'] !== '' && $item['url'] !== '')
            ->values()
            ->all();
    }
}
