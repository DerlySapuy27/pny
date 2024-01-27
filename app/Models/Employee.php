<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
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
