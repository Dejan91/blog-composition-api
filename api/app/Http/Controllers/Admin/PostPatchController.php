<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostPatchController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:sanctum']);
    }

    public function __invoke(Request $request, Post $post)
    {
        $this->validate($request, [
            'title' => ['required'],
            'teaser' => ['nullable'],
            'body' => ['nullable'],
            'slug' => ['required', 'string', 'unique:posts,slug,' . $post->id],
            'published' => ['boolean'],
        ]);

        $post->update($request->only('title', 'teaser', 'body', 'published', 'slug'));
    }
}
