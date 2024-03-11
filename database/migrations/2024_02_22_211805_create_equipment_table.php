<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEquipmentTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('equipment', function (Blueprint $table) {
            $table->id();
            $table->string('brand', 50); // Limitando 'marca' a VARCHAR con longitud máxima de 50 caracteres
            $table->string('model', 50); // Limitando 'modelo' a VARCHAR con longitud máxima de 50 caracteres
            $table->string('series', 50)->unique(); // Limitando 'serial' a VARCHAR con longitud máxima de 50 caracteres
            $table->enum('type', ['Equipo portatil', 'I mpresora', 'Equipo de mesa']); // Utilizando un campo enum para 'type' con opciones predefinidas
            $table->string('description', 300); // Limitando 'serial' a VARCHAR con longitud máxima de 50 caracteres
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('equipment');
    }
}
