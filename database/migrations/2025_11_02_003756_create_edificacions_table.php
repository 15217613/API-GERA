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
        Schema::create('edificaciones', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('habitante_contacto');
            $table->string('telefono_contacto');
            $table->string('email_contacto');
            $table->bigInteger('area_construccion')->comment('Area en metros cuadrados');
            $table->integer('niveles_sobre_suelo');
            $table->integer('niveles_bajo_suelo');
            $table->foreignId('direccion_id')->constrained('direcciones')->cascadeOnDelete();
            $table->foreignId('ocupacion_id')->constrained('ocupaciones')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('edificaciones');
    }
};
