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
        Schema::create('canchas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 256)->nullable();
            $table->string('domicilio', 256)->nullable();
            $table->decimal('latitud', 10, 7)->nullable(); // Rango de -90 a 90, 7 decimales de precisión
            $table->decimal('longitud', 11, 7)->nullable(); // Rango de -180 a 180, 7 decimales de precisión
            $table->string('imagen', 256)->nullable();
            $table->string('descripcion', 256)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('canchas');
    }
};
