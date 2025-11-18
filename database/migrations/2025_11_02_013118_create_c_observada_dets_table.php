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
        Schema::create('c_observadas_det', function (Blueprint $table) {
            $table->id();
            $table->foreignId('grado_danio_id')->constrained('grado_danios');
            $table->foreignId('condicion_detallada_id')->constrained('condiciones_detalladas');
            $table->text('comentario')->nullable();
            $table->foreignId('postsismica_detallada_id')->constrained('e_postsismicas_detalladas');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('c_observadas_det');
    }
};
