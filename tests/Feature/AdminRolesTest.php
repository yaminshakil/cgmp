<?php

namespace Tests\Feature;

use App\Models\Page;
use App\Models\Post;
use App\Models\Service;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminRolesTest extends TestCase
{
    use RefreshDatabase;

    private function user(string $role): User
    {
        return User::factory()->create(['role' => $role]);
    }

    public function test_manager_can_use_content_screens_but_not_settings_or_users(): void
    {
        $manager = $this->user('manager');

        $this->actingAs($manager)->get('/admin')->assertOk();
        $this->actingAs($manager)->get('/admin/posts')->assertOk();
        $this->actingAs($manager)->get('/admin/messages')->assertOk();

        $this->actingAs($manager)->get('/admin/settings')->assertForbidden();
        $this->actingAs($manager)->put('/admin/settings', [])->assertForbidden();
        $this->actingAs($manager)->get('/admin/users')->assertForbidden();
        $this->actingAs($manager)->post('/admin/users', [])->assertForbidden();
    }

    public function test_admin_can_open_settings_and_create_a_manager(): void
    {
        $admin = $this->user('admin');

        $this->actingAs($admin)->get('/admin/settings')->assertOk();

        $this->actingAs($admin)->post('/admin/users', [
            'name' => 'Mia Manager',
            'email' => 'mia@example.com',
            'role' => 'manager',
            'password' => 'a-Long-Passw0rd!',
            'password_confirmation' => 'a-Long-Passw0rd!',
        ])->assertRedirect('/admin/users');

        $this->assertSame('manager', User::where('email', 'mia@example.com')->value('role'));
    }

    public function test_plain_users_and_guests_are_kept_out(): void
    {
        $this->get('/admin')->assertRedirect('/login');
        $this->actingAs($this->user('user'))->get('/admin')->assertForbidden();
    }

    public function test_admin_cannot_demote_or_delete_themselves(): void
    {
        $admin = $this->user('admin');

        $this->actingAs($admin)->put("/admin/users/{$admin->id}", [
            'name' => $admin->name,
            'email' => $admin->email,
            'role' => 'manager',
        ]);
        $this->assertSame('admin', $admin->fresh()->role);

        $this->actingAs($admin)->delete("/admin/users/{$admin->id}");
        $this->assertNotNull($admin->fresh());
    }

    public function test_public_registration_does_not_grant_admin_access(): void
    {
        $this->post('/register', [
            'name' => 'Sneaky',
            'email' => 'sneaky@example.com',
            'password' => 'a-Long-Passw0rd!',
            'password_confirmation' => 'a-Long-Passw0rd!',
        ]);

        $this->assertSame('user', User::where('email', 'sneaky@example.com')->value('role'));
        $this->get('/admin')->assertForbidden();
    }

    public function test_duplicate_titles_get_unique_slugs_instead_of_crashing(): void
    {
        $manager = $this->user('manager');
        $payload = ['title' => 'Flu Shots', 'body' => '<p>Hello</p>', 'status' => 'draft'];

        $this->actingAs($manager)->post('/admin/posts', $payload)->assertRedirect('/admin/posts');
        $this->actingAs($manager)->post('/admin/posts', $payload)->assertRedirect('/admin/posts');

        $this->assertEqualsCanonicalizing(['flu-shots', 'flu-shots-2'], Post::pluck('slug')->all());

        $this->actingAs($manager)->post('/admin/pages', ['title' => 'Contact'])->assertRedirect('/admin/pages');
        $this->assertSame('contact-2', Page::first()->slug);
    }

    public function test_post_body_is_sanitised_on_save(): void
    {
        $this->actingAs($this->user('manager'))->post('/admin/posts', [
            'title' => 'Evil', 'body' => '<p>Hi</p><script>alert(1)</script>', 'status' => 'draft',
        ]);

        $this->assertSame('<p>Hi</p>', Post::first()->body);
    }

    public function test_inactive_service_and_scheduled_post_are_not_public(): void
    {
        $service = Service::create(['title' => 'Hidden', 'slug' => 'hidden', 'is_active' => false]);
        $this->get('/services/hidden')->assertNotFound();

        Post::create(['title' => 'Later', 'slug' => 'later', 'body' => 'x', 'status' => 'published', 'published_at' => now()->addDay()]);
        $this->get('/blog/later')->assertNotFound();

        Post::create(['title' => 'Now', 'slug' => 'now', 'body' => 'x', 'status' => 'published', 'published_at' => now()->subMinute()]);
        $this->get('/blog/now')->assertOk();
    }

    public function test_contact_form_json_response(): void
    {
        $this->postJson('/contact', ['name' => 'A', 'email' => 'a@example.com', 'message' => 'Hello'])
            ->assertOk()->assertJsonStructure(['message']);

        $this->postJson('/contact', ['name' => 'A'])->assertStatus(422)->assertJsonValidationErrors(['email', 'message']);
    }
}
