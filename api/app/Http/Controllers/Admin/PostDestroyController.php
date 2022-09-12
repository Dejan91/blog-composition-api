<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use App\Http\Controllers\Controller;

class PostDestroyController extends Controller
{
    public function __construct()
    {
        $this->authorize(['auth:sanctum']);
    }

    public function __invoke(Post $post)
    {
        $post->delete();
    }
}
