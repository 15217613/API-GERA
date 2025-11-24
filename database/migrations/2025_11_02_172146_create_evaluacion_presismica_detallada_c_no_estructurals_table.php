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
        Schema::create('eval_p_d_c_no_estructurales', function (Blueprint $table) {
            $table->comment('evaluacion_presismica_detallada_condicion_no_estructural');
            $table->id();
            $table->foreignId('e_presismica_detallada_id')->constrained('e_presismicas_detalladas');
            $table->foreignId('condicion_no_estructural_id')->constrained('condiciones_no_estructurales');
            $table->text('comentario')->nullable();
            $table->tinyInteger('existencia')->comment('1: Si, 0: No');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('eval_p_d_c_no_estructurales');
    }
};
