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
        Schema::create('repertorios', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('group_id'); // Clave foránea
            $table->string('nombre'); // o el campo que quieras
            $table->date('fecha');
            $table->timestamps();
    
            $table->foreign('group_id')->references('id')->on('group')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('repertorios');
    }
};
