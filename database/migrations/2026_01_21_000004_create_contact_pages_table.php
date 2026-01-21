<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('contact_pages', function (Blueprint $table) {
            $table->id();
            $table->string('hero_title')->nullable();
            $table->text('hero_desc')->nullable();
            $table->string('hero_bg')->nullable();
            $table->string('form_title')->nullable();
            $table->text('form_desc')->nullable();
            $table->string('info_title')->nullable();
            $table->string('company_name')->nullable();
            $table->text('address')->nullable();
            $table->string('whatsapp')->nullable();
            $table->string('email')->nullable();
            $table->text('maps_embed_url')->nullable();
            $table->string('cta_whatsapp_label')->nullable();
            $table->string('cta_email_label')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contact_pages');
    }
};
