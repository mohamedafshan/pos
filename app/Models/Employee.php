<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $guarded = []; //here don't need to add one after one fillable this is a simple way as empty array

    public function advance(){
        return $this->belongsTo(AdvanceSalary::class,'id','employee_id');
    }
}
