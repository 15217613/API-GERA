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
        Schema::create('eval_p_acciones_requeridas', function (Blueprint $table) {
            $table->comment('EvaluacionPresismicaAccionRequerida');
            $table->id();
            $table->foreignId('evaluacion_presismica_id')->constrained('evaluaciones_presismicas');
            $table->foreignId('accion_requerida_id')->constrained('acciones_requeridas');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('eval_p_acciones_requeridas');
    }
};
