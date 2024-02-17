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
        Schema::create('sorteo_zonas', function (Blueprint $table) {
            
            $table->id();

            $table->char('division', 1)->nullable();
            $table->tinyInteger('zona')->nullable();
            $table->date('fecha')->nullable();

            $table->unsignedBigInteger('campeonato_id')->nullable();
            $table->unsignedBigInteger('equipo_id')->nullable();

            $table->foreign('campeonato_id')->references('id')->on('campeonatos')->onDelete('set null')->onUpdate('set null');
            $table->foreign('equipo_id')->references('id')->on('equipos')->onDelete('set null')->onUpdate('set null');            

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sorteo_zonas');
    }
};
