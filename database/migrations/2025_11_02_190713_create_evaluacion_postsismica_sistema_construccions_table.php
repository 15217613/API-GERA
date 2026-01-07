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
        Schema::create('eval_post_s_construcciones', function (Blueprint $table) {
            $table->comment('Evaluaciones Postsismicas Sistemas Construcciones');
            $table->id();
            $table->foreignId('evaluacion_postsismica_id')->constrained('evaluaciones_postsismicas');
            $table->foreignId('sistema_construccion_id')->constrained('sistemas_construccion');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('eval_post_s_construcciones');
    }
};
