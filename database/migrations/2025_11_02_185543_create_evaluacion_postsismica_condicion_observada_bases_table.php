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
        Schema::create('eval_post_c_observadas_bases', function (Blueprint $table) {
            $table->comment('Evaluaciones Postsismicas Condiciones Observadas Base');
            $table->id();
            $table->foreignId('condicion_base_id')->constrained('condiciones_base');
            $table->foreignId('evaluacion_postsismica_id')->constrained('evaluaciones_postsismicas');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('eval_post_c_observadas_bases');
    }
};
