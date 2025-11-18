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
        Schema::create('c_observadas_base', function (Blueprint $table) {
            $table->comment('Condiciones observadas base');
            $table->id();
            $table->foreignId('grado_danio_id')->constrained('grado_danios');
            $table->foreignId('condicion_base_id')->constrained('condiciones_base');
            $table->text('comentario');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('c_observadas_base');
    }
};
