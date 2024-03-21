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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('last_name');
            $table->string('document_number');
            $table->enum('sex_type', ['M', 'F']);
            $table->foreignId('position_id')->constrained()->onDelete('cascade');
            $table->enum('blood_type', ['A✛', 'A-', 'B✛', 'B-', 'AB✛', 'AB-', 'O✛', 'O-']);
            $table->foreignId('area_id')->constrained()->onDelete('cascade');
            $table->boolean('delivered')->default(false); // Por defecto, no entregado
            $table->string('observation')->nullable(); // Permite valores nulos
            $table->string('license_number')->nullable(); // Permite valores nulos
            $table->foreignId('sede_id')->constrained()->onDelete('cascade');
            $table->binary('signature')->nullable();
            $table->timestamps();
        });
    }
    
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
