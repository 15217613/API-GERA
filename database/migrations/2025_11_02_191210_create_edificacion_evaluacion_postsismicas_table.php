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
        Schema::create('edif_eval_postsismicas', function (Blueprint $table) {
            $table->comment('Edificaciones Evaluaciones Postsismicas');
            $table->id();
            $table->foreignId('edificacion_id')->constrained('edificaciones');
            $table->foreignId('evaluacion_postsismica_id')->constrained('evaluaciones_postsismicas');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('edif_eval_postsismicas');
    }
};
