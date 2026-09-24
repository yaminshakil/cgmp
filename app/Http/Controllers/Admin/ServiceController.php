<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Support\ImageUploader;
use App\Support\Slug;
use App\Support\TextStyles;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index(): View
    {
        return view('admin.services.index', [
            'services' => Service::query()->orderBy('sort_order')->orderBy('title')->get(),
        ]);
    }

    public function create(): View
    {
        return view('admin.services.form', ['service' => new Service()]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validated($request);
        $data['slug'] = Slug::unique(Service::class, ($data['slug'] ?? null) ?: $data['title'], 'service');

        if ($request->hasFile('image')) {
            $data['image'] = ImageUploader::store($request->file('image'), 'services');
        }

        $data['gallery'] = $this->storeGallery($request, []);

        Service::create($data);

        return redirect()->route('admin.services.index')->with('status', 'Service created.');
    }

    public function edit(Service $service): View
    {
        return view('admin.services.form', ['service' => $service]);
    }

    public function update(Request $request, Service $service): RedirectResponse
    {
        $data = $this->validated($request);
        $data['slug'] = Slug::unique(Service::class, ($data['slug'] ?? null) ?: $data['title'], 'service', $service->id);

        if ($request->boolean('remove_image')) {
            ImageUploader::delete($service->image);
            $data['image'] = null;
        } elseif ($request->hasFile('image')) {
            ImageUploader::delete($service->image);
            $data['image'] = ImageUploader::store($request->file('image'), 'services');
        }

        $data['gallery'] = $this->storeGallery($request, $service->gallery ?? []);

        $service->update($data);

        return redirect()->route('admin.services.index')->with('status', 'Service updated.');
    }

    public function destroy(Service $service): RedirectResponse
    {
        ImageUploader::delete($service->image);
        array_map(ImageUploader::delete(...), $service->gallery ?? []);

        $service->delete();

        return redirect()->route('admin.services.index')->with('status', 'Service deleted.');
    }

    /** Drops the images ticked for removal, then appends any newly uploaded ones. */
    private function storeGallery(Request $request, array $existing): array
    {
        $removed = (array) $request->input('remove_gallery', []);
        array_map(ImageUploader::delete(...), array_intersect($existing, $removed));

        $gallery = array_values(array_diff($existing, $removed));

        foreach ((array) $request->file('gallery', []) as $file) {
            $gallery[] = ImageUploader::store($file, 'services');
        }

        return array_slice($gallery, 0, 12);
    }

    private function validated(Request $request): array
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255'],
            'icon' => ['nullable', 'string', 'max:100'],
            'short_description' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'sort_order' => ['nullable', 'integer'],
            'is_active' => ['nullable', 'boolean'],
            'image' => ['nullable', 'image', 'max:4096'],
            'gallery' => ['nullable', 'array', 'max:12'],
            'gallery.*' => ['image', 'max:4096'],
            'remove_gallery' => ['nullable', 'array'],
            'remove_gallery.*' => ['string'],
        ]);

        $data['is_active'] = $request->boolean('is_active');
        $data['text_styles'] = TextStyles::sanitizeAll(
            $request->input('text_styles', []),
            ['title', 'short_description', 'description']
        );
        unset($data['image'], $data['gallery'], $data['remove_gallery']);

        return $data;
    }
}
