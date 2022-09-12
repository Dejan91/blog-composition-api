<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;

class PostStoreCntroller extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:sanctum']);
    }

    public function __invoke()
    {
        $post = Post::create(['title' => 'Untitled post']);

        return PostResource::make($post);
    }
}
