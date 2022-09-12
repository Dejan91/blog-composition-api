<?php

namespace Tests\Feature\Posts;

use Tests\TestCase;
use App\Models\Post;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PostShowControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_returns_single_post_by_slug()
    {
        $post = Post::factory()->create();

        $responseBySlug = $this->get(route('posts.show', [$post->slug]));

        $responseBySlug->assertOk();
        $responseBySlug->assertJsonFragment([
            'uuid' => $post->uuid,
            'title' => $post->title,
            'slug' => $post->slug,
            'teaser' => $post->teaser,
            'body' => $post->body,
            'published' => $post->published ?: false
        ]);

        $responseByID = $this->get(route('posts.show', [$post->id]));
        $responseByID->assertStatus(Response::HTTP_NOT_FOUND);
    }
}
