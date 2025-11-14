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
        Schema::create('e_postsismicas_detalladas', function (Blueprint $table) {
            $table->id();
            $table->longText('croquis')->charset('binary');
            $table->longText('fotografia')->charset('binary');
            $table->integer('version');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('e_postsismicas_detalladas');
    }
};
