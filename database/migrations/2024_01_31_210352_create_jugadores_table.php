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
        Schema::create('jugadores', function (Blueprint $table) {
            $table->id();
            $table->string('dni', 8)->nullable();
            $table->string('nombre', 45)->nullable();
            $table->string('apellido', 45)->nullable();
            $table->string('foto', 256)->nullable();
            $table->date('fechanac')->nullable();
            $table->string('telefono', 45)->nullable();
            $table->string('domicilio', 256)->nullable();
            $table->unsignedBigInteger('equipo_id')->nullable();
            $table->foreign('equipo_id')->references('id')->on('equipos')->onDelete('set null')->onUpdate('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jugadores');
    }
};
