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
        Schema::create('fixtures', function (Blueprint $table) {
            
            $table->id(); // Auto-increment and Unsigned
            
            $table->unsignedBigInteger('campeonato_id')->nullable();
            $table->unsignedBigInteger('cancha_id')->nullable();

            $table->string('division', 2)->nullable();
            $table->string('zona', 2)->nullable();
            $table->integer('fecha_num')->nullable();
            $table->date('fecha')->nullable();
            $table->tinyInteger('hora')->nullable();
            $table->string('equipo_local', 45)->nullable();
            $table->string('equipo_visitante', 45)->nullable();
            $table->integer('goles_equipo_local')->nullable();
            $table->integer('goles_equipo_visitante')->nullable();            

            $table->foreign('cancha_id')->references('id')->on('canchas')
                  ->onDelete('set null')
                  ->onUpdate('set null');

            $table->foreign('campeonato_id')->references('id')->on('campeonatos')
                  ->onDelete('set null')
                  ->onUpdate('set null');            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fixtures');
    }
};
