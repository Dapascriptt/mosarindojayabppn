<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('about_pages', function (Blueprint $table) {
            $table->id();
            $table->string('hero_title')->nullable();
            $table->string('hero_subtitle')->nullable();
            $table->text('hero_desc')->nullable();
            $table->string('video_url')->nullable();
            $table->json('highlights')->nullable();
            $table->json('legal_items')->nullable();
            $table->json('sbu_items')->nullable();
            $table->json('team_groups')->nullable();
            $table->text('certifications_text')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('about_pages');
    }
};
