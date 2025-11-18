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
        Schema::create('e_presismicas_detalladas', function (Blueprint $table) {
            $table->id();
            $table->year('anio_construccion');
            $table->tinyInteger('autoconstruccion')->comment('1: Si, 0: No');
            $table->year('anio_ampliacion');
            $table->tinyInteger('licuefaccion')->comment('1: Si, 0: No, 2: DESC');
            $table->tinyInteger('deslizamiento')->comment('1: Si, 0: No, 2: DESC');
            $table->tinyInteger('ruptura_superficie')->comment('1: Si, 0: No, 2: DESC');
            $table->tinyInteger('golpeo_adyacente')->comment('1: Si, 0: No');
            $table->tinyInteger('riesgo_caida')->comment('1: Si, 0: No');
            $table->text('comentario')->nullable();
            $table->longText('croquis')->charset('binary');
            $table->longText('fotografia')->charset('binary');
            $table->float('puntaje_final');
            $table->tinyInteger('revision_exterior')->comment('1: Si, 0: No, 2: DESC');
            $table->tinyInteger('revision_interior')->comment('1: Si, 0: No, 2: DESC');
            $table->tinyInteger('planos_revisados')->comment('1: Si, 0: No');
            $table->string('fuente_tipo_suelo');
            $table->string('fuente_riesgo_geologico');
            $table->integer('version');
            $table->foreignId('tipo_suelo_id')->constrained('tipos_suelos');
            $table->foreignId('tipo_construccion_id')->constrained('tipos_construcciones');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('e_presismicas_detalladas');
    }
};
