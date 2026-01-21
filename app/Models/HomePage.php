<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomePage extends Model
{
    protected $fillable = [
        'hero_media',
        'card_image',
        'vision_text',
        'about_excerpt',
        'mission_points',
        'partner_logos',
    ];

    protected $casts = [
        'hero_media' => 'array',
        'mission_points' => 'array',
        'partner_logos' => 'array',
    ];
}
