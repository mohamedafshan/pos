<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendence extends Model
{
    use HasFactory;
    protected $guadred = [];

    public function employee(){
        return $this->belongsTo(Employee::class,'employee_id','id');
    }
}