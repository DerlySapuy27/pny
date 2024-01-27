<?php

namespace App\Models;
/* use App\Http\Models\Area; */


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    public function areas(){
        return $this->hasMany(Area::class);
    }
}
