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
        Schema::table('repertorio_song', function (Blueprint $table) {
            $table->unsignedBigInteger('repertorio_song_category_id')->nullable()->after('song_id');
            $table->foreign('repertorio_song_category_id')
                  ->references('id')
                  ->on('repertorio_song_category')
                  ->onDelete('set null');
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('repertorio_song', function (Blueprint $table) {
            $table->dropForeign(['repertorio_song_category_id']);
            $table->dropColumn('repertorio_song_category_id');
        });
    }
};
