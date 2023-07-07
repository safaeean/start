<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Blog\Post;
use App\Models\User;
use Database\Seeders\DefaultAdminSeeder;
use Tests\TestCase;

class BlogTest extends TestCase
{
    /**
     * Test the blog posts api returns a successful response.
     */
    public function test_the_blog_posts_api_returns_a_successful_response(): void
    {
        $response = $this->get('/api/blog/posts');
        $response->assertStatus(200);
    }

    /**
     * Test the blog post api returns a successful response.
     */
    public function test_the_blog_post_api_returns_a_successful_response(): void
    {
        (new DefaultAdminSeeder())->run();
        Post::factory(10)->create();
        $post = Post::query()->first();
        $response = $this->get("/api/blog/post/{$post->id}");
        $response->assertStatus(200);
    }
}
