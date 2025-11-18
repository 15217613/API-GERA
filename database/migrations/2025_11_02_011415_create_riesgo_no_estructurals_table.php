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
        Schema::create('riesgos_no_estructurales', function (Blueprint $table) {
            $table->id();
            $table->text('comentario');
            $table->foreignId('condicion_no_estructural_id')->constrained('condiciones_no_estructurales');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('riesgos_no_estructurales');
    }
};
