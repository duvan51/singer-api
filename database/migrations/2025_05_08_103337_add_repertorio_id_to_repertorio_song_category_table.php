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
        Schema::table('repertorio_song_category', function (Blueprint $table) {
            $table->unsignedBigInteger('repertorio_id')->after('id');

            $table->foreign('repertorio_id')
                  ->references('id')
                  ->on('repertorios')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('repertorio_song_category', function (Blueprint $table) {
            $table->dropForeign(['repertorio_id']);
            $table->dropColumn('repertorio_id');
        });
    }
};
