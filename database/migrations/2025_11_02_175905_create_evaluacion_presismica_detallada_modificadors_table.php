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
        Schema::create('eval_p_d_modificadores', function (Blueprint $table) {
            $table->comment('Evaluacion Presismica Detallada Modificadores');
            $table->id();
            $table->foreignId('e_presismica_detallada_id')->constrained('e_presismicas_detalladas');
            $table->foreignId('modificador_id')->constrained('modificadores');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('eval_p_d_modificadores');
    }
};
