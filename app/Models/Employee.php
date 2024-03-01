<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'name',
        'last_name',
        'document_number',
        'sex_type',
        'position_id',
        'blood_type',
        'area_id',
        'delivered',
        'observation',
        'license_number',
        'sede_id',
        'signature'
    ];

    public function area(){
        return $this->belongsTo(Area::class);
    }

    public function position(){
        return $this->belongsTo(Position::class);
    }

    public function sede(){
        return $this->belongsTo(Sede::class);
    }
}
