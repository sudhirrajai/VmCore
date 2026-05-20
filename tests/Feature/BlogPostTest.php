<?php

namespace Tests\Feature;

use App\Models\BlogPost;
use App\Models\BlogCategory;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BlogPostTest extends TestCase
{
    use RefreshDatabase;

    protected User $admin;
    protected BlogCategory $category;

    protected function setUp(): void
    {
        parent::setUp();

        $this->admin = User::factory()->create();
        $this->category = BlogCategory::create([
            'title' => 'Technology',
            'slug' => 'technology',
            'status' => true,
        ]);
    }

    public function test_can_create_blog_post_with_body()
    {
        $this->actingAs($this->admin);

        $response = $this->post(route('admin.blog.store'), [
            'title' => 'Test Blog Post',
            'category_id' => $this->category->id,
            'excerpt' => 'Test Excerpt',
            'body' => '<p>This is the test body content.</p>',
            'status' => 1,
            'published_at' => now()->format('Y-m-d\TH:i'),
        ]);

        $response->assertRedirect(route('admin.blog.index'));
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('blog_posts', [
            'title' => 'Test Blog Post',
            'body' => '<p>This is the test body content.</p>',
        ]);
    }

    public function test_can_update_blog_post_body()
    {
        $this->actingAs($this->admin);

        $post = BlogPost::create([
            'title' => 'Old Title',
            'category_id' => $this->category->id,
            'excerpt' => 'Old Excerpt',
            'body' => '<p>Old body content.</p>',
            'user_id' => $this->admin->id,
            'status' => true,
        ]);

        $response = $this->put(route('admin.blog.update', $post), [
            'title' => 'Updated Title',
            'category_id' => $this->category->id,
            'excerpt' => 'Updated Excerpt',
            'body' => '<p>Updated body content.</p>',
            'status' => 1,
        ]);

        $response->assertRedirect(route('admin.blog.index'));
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('blog_posts', [
            'id' => $post->id,
            'title' => 'Updated Title',
            'body' => '<p>Updated body content.</p>',
        ]);
    }
}
