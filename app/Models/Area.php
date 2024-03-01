<?php

namespace App\Models;
/* use App\Http\Models\Department; */

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{

    protected $fillable = 
    [
        'name', 
        'department_id'
    ];

    public function department(){
        return $this->belongsTo(Department::class, 'department_id');
    }


    public function employees(){
        return $this->hasMany(Employee::class);
    }
}
