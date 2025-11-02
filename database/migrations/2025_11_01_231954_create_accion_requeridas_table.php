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
        Schema::create('acciones_requeridas', function (Blueprint $table) {
            $table->id();
            $table->text('nombre');
            $table->tinyInteger('evaluacion_detallada')->comment('1: Estrutural, 2: No Estrutural');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('acciones_requeridas');
    }
};
