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
        Schema::create('eval_p_e_presismicas_detalladas', function (Blueprint $table) {
            $table->comment('Evaluacion presismica evaluacion detallada');
            $table->id();
            $table->foreignId('e_presismica_id')->constrained('evaluaciones_presismicas');
            $table->foreignId('e_p_detallada_id')->constrained('e_presismicas_detalladas');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('eval_p_e_presismicas_detalladas');
    }
};
