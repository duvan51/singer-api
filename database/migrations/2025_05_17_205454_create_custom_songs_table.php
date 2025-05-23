<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('custom_songs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('original_song_id')->constrained('song');
            $table->foreignId('repertorio_id')->constrained('repertorios');
            $table->foreignId('repertorio_song_category_id')->constrained('repertorio_song_category');
            $table->string('title');
            $table->text('lyrics')->nullable();
            $table->string('key')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('custom_songs');
    }
};

