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
        Schema::create('edif_eval_presismicas', function (Blueprint $table) {
            $table->comment('Edificaciones Evaluaciones Presismicas');
            $table->id();
            $table->foreignId('edificacion_id')->constrained('edificaciones');
            $table->foreignId('evaluacion_presismica_id')->constrained('evaluaciones_presismicas');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('edif_eval_presismicas');
    }
};
