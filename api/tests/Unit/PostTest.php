<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PostTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_create_uuid_automatically_when_creating_post()
    {
        $post = Post::factory()->create(['title' => 'Test title']);

        $this->assertDatabaseHas('posts', ['uuid' => $post->uuid]);
    }

    /** @test */
    public function it_automatically_set_slug_equal_to_uuid()
    {
        $post = Post::factory()->create(['title' => 'Test title']);

        $this->assertSame($post->uuid, $post->slug);
    }
}
