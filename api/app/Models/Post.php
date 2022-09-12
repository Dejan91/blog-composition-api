<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $casts = [
        'published' => 'bool'
    ];

    public static function booted()
    {
        static::creating(function (Post $post) {
            $post->uuid = Str::uuid()->toString();

            if (!$post->slug) {
                $post->slug = $post->uuid;
            }
        });
    }

    protected $fillable = [
        'uuid',
        'title',
        'body',
        'slug',
        'teaser',
        'published'
    ];
}
