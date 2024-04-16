<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function catergory(){
        return $this->belongsTo(Catergory::class,'catergory_id','id'); //Forign key to Primary Relationship
    }

    public function supplier(){
        return $this->belongsTo(Supplier::class,'supplier_id','id'); //Forign key to Primary Relationship
    }
}
