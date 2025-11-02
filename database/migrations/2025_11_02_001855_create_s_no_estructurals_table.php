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
        Schema::create('s_no_estructurales', function (Blueprint $table) {
            $table->comment('Tabla que almacena las condiciones no estructurales');
            $table->id();
            $table->text('nombre');
            $table->text('accion');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('s_no_estructurales');
    }
};
