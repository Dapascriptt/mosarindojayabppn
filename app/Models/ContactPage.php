<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactPage extends Model
{
    protected $fillable = [
        'hero_title',
        'hero_desc',
        'hero_bg',
        'form_title',
        'form_desc',
        'info_title',
        'company_name',
        'address',
        'whatsapp',
        'email',
        'maps_embed_url',
        'cta_whatsapp_label',
        'cta_email_label',
    ];
}
