<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\Post;
use App\Models\Service;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    public function __invoke(): Response
    {
        $urls = collect([
            ['loc' => route('home'), 'priority' => '1.0'],
            ['loc' => route('about'), 'priority' => '0.8'],
            ['loc' => route('services.index'), 'priority' => '0.8'],
            ['loc' => route('doctors'), 'priority' => '0.8'],
            ['loc' => route('blog.index'), 'priority' => '0.7'],
            ['loc' => route('booking'), 'priority' => '0.9'],
            ['loc' => route('contact'), 'priority' => '0.6'],
            ['loc' => route('faq'), 'priority' => '0.5'],
            ['loc' => route('pages.privacy'), 'priority' => '0.3'],
            ['loc' => route('pages.terms'), 'priority' => '0.3'],
        ]);

        foreach (Service::active()->get() as $service) {
            $urls->push(['loc' => route('services.show', $service), 'priority' => '0.6']);
        }

        foreach (Post::query()->published()->get() as $post) {
            $urls->push(['loc' => route('blog.show', $post), 'lastmod' => $post->updated_at->toAtomString(), 'priority' => '0.5']);
        }

        foreach (Page::query()->whereNotIn('slug', ['privacy-policy', 'terms'])->get() as $page) {
            $urls->push(['loc' => route('pages.show', $page->slug), 'priority' => '0.4']);
        }

        return response()
            ->view('sitemap', ['urls' => $urls])
            ->header('Content-Type', 'application/xml');
    }
}
