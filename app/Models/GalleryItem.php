<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GalleryItem extends Model
{
    protected $fillable = [
        'title',
        'tag',
        'desc',
        'images',
        'before_images',
        'after_images',
    ];

    protected $casts = [
        'images' => 'array',
        'before_images' => 'array',
        'after_images' => 'array',
    ];
}
