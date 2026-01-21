<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutPage extends Model
{
    protected $fillable = [
        'hero_title',
        'hero_subtitle',
        'hero_desc',
        'video_url',
        'highlights',
        'legal_items',
        'sbu_items',
        'team_groups',
        'certifications_text',
    ];

    protected $casts = [
        'highlights' => 'array',
        'legal_items' => 'array',
        'sbu_items' => 'array',
        'team_groups' => 'array',
    ];
}
