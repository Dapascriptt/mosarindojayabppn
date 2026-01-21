<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'category',
        'excerpt',
        'description',
        'image',
        'hero_media',
    ];

    public function details(): HasMany
    {
        return $this->hasMany(ProductDetail::class);
    }
}
