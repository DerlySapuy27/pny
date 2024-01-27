<?php

namespace App\Models;
/* use App\Http\Models\Department;
 */
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    public function department(){
        return $this->belongsTo(Department::class);
    }

    public function employees(){
        return $this->hasMany(Employee::class);
    }
}
