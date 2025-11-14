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
        Schema::create('evaluaciones_postsismicas', function (Blueprint $table) {
            $table->id();
            $table->date('fecha');
            $table->time('hora');
            $table->integer('numero_unidades_residenciales');
            $table->integer('numero_unidades_residenciales_habitables');
            $table->text('comentario_senial');
            $table->tinyInteger('evaluacion_detallada_recomendada_estructural')->comment('1 = Si, 0 = No');
            $table->tinyInteger('evaluacion_detallada_recomendada_geotecnia')->comment('1 = Si, 0 = No');
            $table->text('otras_recomendaciones');
            $table->text('comentarios');
            $table->text('evaluacion_detallada_recomendada_otra');
            $table->integer('version');
            $table->foreignId('senializacion_id')->constrained('senializaciones')->cascadeOnDelete();
            $table->foreignId('porcentaje_danio_id')->constrained('porcentaje_danios')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evaluaciones_postsismicas');
    }
};
