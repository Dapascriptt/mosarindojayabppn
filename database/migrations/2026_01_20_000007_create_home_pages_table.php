<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('home_pages', function (Blueprint $table) {
            $table->id();
            $table->string('card_image')->nullable();
            $table->text('vision_text')->nullable();
            $table->text('about_excerpt')->nullable();
            $table->json('mission_points')->nullable();
            $table->json('partner_logos')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('home_pages');
    }
};
