<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\ContactMessage;
use App\Models\Doctor;
use App\Models\Faq;
use App\Models\Page;
use App\Models\Post;
use App\Models\Service;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Renders every public and admin page against the seeded content and fails on any 4xx/5xx or
 * server-side exception, so a broken view or query is caught without clicking through the site.
 */
class SmokeTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed();
        Category::firstOrCreate(['slug' => 'general'], ['name' => 'General']);
        ContactMessage::create(['name' => 'Jo', 'email' => 'jo@example.com', 'message' => 'Hi']);
    }

    public function test_public_pages_render(): void
    {
        $urls = ['/', '/about', '/doctors', '/services', '/blog', '/book-appointment', '/contact', '/faq', '/emergency',
            '/privacy-policy', '/terms', '/fees-info', '/sitemap.xml', '/login', '/register', '/forgot-password',
            '/blog?q=health', '/blog?category=general', '/this-page-does-not-exist'];

        foreach (Doctor::active()->get() as $d) {
            $urls[] = "/doctors/{$d->id}";
        }
        foreach (Service::active()->get() as $s) {
            $urls[] = "/services/{$s->slug}";
        }
        foreach (Post::published()->get() as $p) {
            $urls[] = "/blog/{$p->slug}";
        }
        foreach (Page::all() as $pg) {
            $urls[] = "/{$pg->slug}";
        }

        foreach ($urls as $url) {
            $res = $this->get($url);
            $expected = $url === '/this-page-does-not-exist' ? 404 : 200;
            $this->assertSame($expected, $res->getStatusCode(), "GET {$url} returned {$res->getStatusCode()}");
        }
    }

    public function test_admin_pages_render_for_admin_and_manager(): void
    {
        $urls = ['/admin', '/admin/services', '/admin/services/create', '/admin/doctors', '/admin/doctors/create',
            '/admin/posts', '/admin/posts/create', '/admin/faqs', '/admin/faqs/create', '/admin/pages', '/admin/pages/create',
            '/admin/categories', '/admin/sections', '/admin/messages', '/profile'];

        foreach (Service::all() as $m) { $urls[] = "/admin/services/{$m->slug}/edit"; }
        foreach (Doctor::all() as $m) { $urls[] = "/admin/doctors/{$m->id}/edit"; }
        foreach (Post::all() as $m) { $urls[] = "/admin/posts/{$m->slug}/edit"; }
        foreach (Faq::all() as $m) { $urls[] = "/admin/faqs/{$m->id}/edit"; }
        foreach (Page::all() as $m) { $urls[] = "/admin/pages/{$m->slug}/edit"; }
        foreach (ContactMessage::all() as $m) { $urls[] = "/admin/messages/{$m->id}"; }

        $admin = User::factory()->create(['role' => 'admin']);
        $manager = User::factory()->create(['role' => 'manager']);

        foreach ($urls as $url) {
            foreach ([$admin, $manager] as $who) {
                $res = $this->actingAs($who)->get($url);
                $this->assertSame(200, $res->getStatusCode(), "{$who->role} GET {$url} returned {$res->getStatusCode()}");
            }
        }

        foreach (['/admin/settings', '/admin/users', '/admin/users/create', "/admin/users/{$admin->id}/edit"] as $url) {
            $this->actingAs($admin)->get($url)->assertOk();
            $this->actingAs($manager)->get($url)->assertForbidden();
        }
    }
}
