<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    use HasFactory;

    protected $fillable = ['brand', 'model', 'series', 'type', 'description'];
    
    protected $casts = [
        'type' => 'string' // Esto asegura que el campo 'type' sea tratado como una cadena en PHP
    ];

    // Define las opciones de tipo disponibles
    public static $enums = [
        'type' => ['Equipo portatil', 'Impresora', 'Equipo de mesa']
    ];
}