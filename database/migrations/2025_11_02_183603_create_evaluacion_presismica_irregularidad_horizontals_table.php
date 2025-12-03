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
        Schema::create('eval_p_irregularidades_horizontales', function (Blueprint $table) {
            $table->id();
            $table->foreignId('e_presismica_id')->constrained('evaluaciones_presismicas');
            $table->foreignId('i_horizontal_id')->constrained('irregularidades_horizontales');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('eval_p_irregularidades_horizontales');
    }
};
