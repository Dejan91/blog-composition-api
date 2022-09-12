<?php

namespace Tests\Feature\Posts;

use Tests\TestCase;
use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PostIndexControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_exposes_only_selected_data()
    {
        $post = Post::factory()->create(['published' => true]);

        $response = $this->get(route('posts.index'));

        $response->assertJsonFragment([
            'uuid' => $post->uuid,
            'title' => $post->title,
            'slug' => $post->slug,
            'teaser' => $post->teaser,
            'body' => $post->body,
            'published' => $post->published
        ]);

        $response->assertJsonMissing([
            'created_at',
            'updated_at'
        ]);
    }

    /** @test */
    public function it_returns_only_featured_posts()
    {
        $publishedPost = Post::factory()->create(['published' => true]);
        $unpublishedPost = Post::factory()->create(['published' => false]);

        $response = $this->get(route('posts.index'));

        $response->assertJsonFragment(['uuid' => $publishedPost->uuid]);
        $response->assertJsonMissing(['uuid' => $unpublishedPost->uuid]);
    }
}
