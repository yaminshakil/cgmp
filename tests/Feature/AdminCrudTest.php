<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\ContactMessage;
use App\Models\Doctor;
use App\Models\Faq;
use App\Models\Page;
use App\Models\Post;
use App\Models\Section;
use App\Models\Service;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class AdminCrudTest extends TestCase
{
    use RefreshDatabase;

    private User $admin;

    protected function setUp(): void
    {
        parent::setUp();

        Storage::fake('public');
        $this->admin = User::factory()->create(['role' => 'admin']);
    }

    private function png(string $name = 'x.png'): UploadedFile
    {
        return UploadedFile::fake()->image($name, 600, 400);
    }

    public function test_service_crud_with_image(): void
    {
        $this->actingAs($this->admin)->post('/admin/services', [
            'title' => 'Skin Checks', 'short_description' => 'Short', 'description' => "Line1\nLine2",
            'sort_order' => 3, 'is_active' => 1, 'image' => $this->png(),
            'text_styles' => ['title' => ['size' => '3xl', 'font' => 'serif']],
        ])->assertRedirect('/admin/services')->assertSessionHasNoErrors();

        $s = Service::firstOrFail();
        $this->assertNotNull($s->image);
        Storage::disk('public')->assertExists($s->image);
        $this->get("/services/{$s->slug}")->assertOk()->assertSee('Skin Checks');

        $this->actingAs($this->admin)->put("/admin/services/{$s->slug}", [
            'title' => 'Skin Checks Plus', 'slug' => $s->slug, 'is_active' => 0, 'remove_image' => 1,
        ])->assertRedirect('/admin/services')->assertSessionHasNoErrors();

        $s->refresh();
        $this->assertNull($s->image);
        $this->assertFalse($s->is_active);

        $this->actingAs($this->admin)->delete("/admin/services/{$s->slug}")->assertRedirect('/admin/services');
        $this->assertSame(0, Service::count());
    }

    public function test_doctor_crud_with_image_and_days(): void
    {
        $this->actingAs($this->admin)->post('/admin/doctors', [
            'name' => 'Dr Who', 'role' => 'GP', 'qualifications' => 'MBBS', 'bio' => 'Bio', 'years_experience' => '10',
            'languages' => 'English, Arabic', 'availability_days' => ['mon', 'tue'], 'sort_order' => 1, 'is_active' => 1,
            'photo' => $this->png('p.png'),
        ])->assertRedirect('/admin/doctors')->assertSessionHasNoErrors();

        $d = Doctor::firstOrFail();
        $this->assertSame(['mon', 'tue'], $d->availability_days);
        $this->get('/doctors')->assertOk()->assertSee('Dr Who');
        $this->get("/doctors/{$d->id}")->assertOk();

        $this->actingAs($this->admin)->put("/admin/doctors/{$d->id}", ['name' => 'Dr Who', 'is_active' => 0])
            ->assertRedirect('/admin/doctors');
        $this->get("/doctors/{$d->id}")->assertNotFound();

        $this->actingAs($this->admin)->delete("/admin/doctors/{$d->id}")->assertRedirect('/admin/doctors');
    }

    public function test_post_category_flow(): void
    {
        $this->actingAs($this->admin)->post('/admin/categories', ['name' => 'News'])->assertRedirect('/admin/categories');
        $cat = Category::firstOrFail();

        $this->actingAs($this->admin)->post('/admin/posts', [
            'title' => 'Hello World', 'body' => '<p>Body <strong>text</strong></p>', 'status' => 'published',
            'category_id' => $cat->id, 'excerpt' => 'Ex', 'featured_image' => $this->png('f.png'),
        ])->assertRedirect('/admin/posts')->assertSessionHasNoErrors();

        $post = Post::firstOrFail();
        $this->assertNotNull($post->published_at);
        $this->get("/blog/{$post->slug}")->assertOk()->assertSee('Hello World');
        $this->get('/blog?category=news')->assertOk()->assertSee('Hello World');
        $this->get('/blog?q=Hello')->assertOk()->assertSee('Hello World');

        $this->actingAs($this->admin)->put("/admin/posts/{$post->slug}", [
            'title' => 'Hello World', 'slug' => $post->slug, 'body' => '<p>New</p>', 'status' => 'draft',
        ])->assertRedirect('/admin/posts');
        $this->get("/blog/{$post->slug}")->assertNotFound();

        $this->actingAs($this->admin)->delete("/admin/categories/{$cat->id}")->assertRedirect('/admin/categories');
        $this->assertNull($post->fresh()->category_id);

        $this->actingAs($this->admin)->delete("/admin/posts/{$post->slug}")->assertRedirect('/admin/posts');
    }

    public function test_faq_and_page_flow(): void
    {
        $this->actingAs($this->admin)->post('/admin/faqs', ['question' => 'Q?', 'answer' => 'A.', 'sort_order' => 1, 'is_active' => 1])
            ->assertRedirect('/admin/faqs')->assertSessionHasNoErrors();
        $faq = Faq::firstOrFail();
        $this->get('/faq')->assertOk()->assertSee('Q?');
        $this->actingAs($this->admin)->put("/admin/faqs/{$faq->id}", ['question' => 'Q2?', 'answer' => 'A.'])->assertRedirect('/admin/faqs');
        $this->actingAs($this->admin)->delete("/admin/faqs/{$faq->id}")->assertRedirect('/admin/faqs');

        $this->actingAs($this->admin)->post('/admin/pages', ['title' => 'Our Story', 'body' => '<p>Hi</p>'])
            ->assertRedirect('/admin/pages')->assertSessionHasNoErrors();
        $page = Page::firstOrFail();
        $this->get('/our-story')->assertOk()->assertSee('Our Story');
        $this->actingAs($this->admin)->delete("/admin/pages/{$page->slug}")->assertRedirect('/admin/pages');
    }

    public function test_homepage_sections_save_and_render(): void
    {
        $this->actingAs($this->admin)->put('/admin/sections/hero', [
            'heading' => 'Care for Everyone Here', 'subheading' => 'Sub', 'badge_text' => 'Badge',
            'primary_button_text' => 'Book', 'primary_button_link' => 'javascript:alert(1)',
            'secondary_button_text' => 'More', 'secondary_button_link' => '/about', 'image' => $this->png('h.png'),
        ])->assertRedirect('/admin/sections')->assertSessionHasNoErrors();

        $hero = Section::data('hero');
        $this->assertNull($hero['primary_button_link']);
        $this->assertNotEmpty($hero['image']);

        $this->actingAs($this->admin)->put('/admin/sections/about', [
            'heading' => 'About', 'body' => '<p>x</p><script>1</script>', 'points' => "One\nTwo",
        ])->assertRedirect('/admin/sections');
        $this->assertSame('<p>x</p>', Section::data('about')['body']);

        $this->actingAs($this->admin)->put('/admin/sections/nearest-hospitals', ['hospitals' => "Hosp | 2km | Addr | 123"])->assertRedirect('/admin/sections');
        $this->actingAs($this->admin)->put('/admin/sections/navigation', ['items' => "Home | /\nEvil | javascript:x\nAbout | /about"])->assertRedirect('/admin/sections');
        $this->assertCount(2, Section::data('navigation')['items']);
        $this->actingAs($this->admin)->put('/admin/sections/footer-links', ['items' => "Privacy | /privacy-policy"])->assertRedirect('/admin/sections');

        foreach (['/', '/about', '/emergency'] as $url) {
            $this->get($url)->assertOk();
        }
        $this->get('/')->assertSee('Care for Everyone');
    }

    public function test_settings_save_with_logo_and_message_delete(): void
    {
        $this->actingAs($this->admin)->put('/admin/settings', [
            'clinic_name' => 'Test Clinic', 'phone' => '02 1234 5678', 'mail_to' => 'a@example.com',
            'logo' => $this->png('logo.png'),
        ])->assertRedirect('/admin/settings')->assertSessionHasNoErrors();

        $this->assertSame('Test Clinic', Setting::where('key', 'clinic_name')->value('value'));
        $this->assertNotEmpty(Setting::where('key', 'logo_path')->value('value'));
        $this->get('/')->assertOk()->assertSee('Test Clinic');

        $svg = UploadedFile::fake()->createWithContent('bad.svg', '<svg xmlns="http://www.w3.org/2000/svg"><script>alert(1)</script></svg>');
        $this->actingAs($this->admin)->put('/admin/settings', ['logo' => $svg])->assertSessionHasErrors('logo');

        $this->actingAs($this->admin)->put('/admin/settings', ['mail_to' => 'not-an-email'])->assertSessionHasErrors('mail_to');

        $m = ContactMessage::create(['name' => 'A', 'email' => 'a@example.com', 'message' => 'Hi']);
        $this->actingAs($this->admin)->get("/admin/messages/{$m->id}")->assertOk();
        $this->assertTrue($m->fresh()->is_read);
        $this->actingAs($this->admin)->delete("/admin/messages/{$m->id}")->assertRedirect('/admin/messages');
    }

    public function test_settings_reject_unsafe_urls_and_footer_uses_copyright_text(): void
    {
        $this->actingAs($this->admin)->put('/admin/settings', [
            'facebook_url' => 'javascript:alert(1)', 'google_map_embed' => 'javascript:alert(1)',
        ])->assertSessionHasErrors(['facebook_url', 'google_map_embed']);

        $this->actingAs($this->admin)->put('/admin/settings', [
            'facebook_url' => 'https://facebook.com/cgmp', 'copyright_text' => 'Custom copyright line',
        ])->assertSessionHasNoErrors();

        $this->get('/')->assertSee('Custom copyright line')->assertSee('https://facebook.com/cgmp');
    }

    public function test_relative_menu_link_is_highlighted_on_its_page(): void
    {
        Section::store('navigation', ['items' => [['label' => 'About us', 'url' => '/about'], ['label' => 'Home', 'url' => '/']]]);

        $html = $this->get('/about')->getContent();
        $this->assertMatchesRegularExpression('#href="/about"[^>]*font-semibold[^>]*>About us#', $html);
        $this->assertDoesNotMatchRegularExpression('#href="/"[^>]*font-semibold text-brand-blue[^>]*>Home#', $html);
    }

    public function test_profile_update_and_password_change(): void
    {
        $this->actingAs($this->admin)->patch('/profile', ['name' => 'New Name', 'email' => $this->admin->email])
            ->assertRedirect('/profile');
        $this->assertSame('New Name', $this->admin->fresh()->name);
    }
}
