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
        Schema::create('eval_post_eval_detalladas', function (Blueprint $table) {
            $table->comment('Evaluaciones Postsismicas Evaluaciones Detalladas');
            $table->id();
            $table->foreignId('evaluacion_postsismica_id')->constrained('evaluaciones_postsismicas');
            $table->foreignId('evaluacion_detallada_id')->constrained('e_postsismicas_detalladas');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('eval_post_eval_detalladas');
    }
};
