<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Waybilllocation extends Model
{
    use HasFactory;

    public function waybills(){
        return $this->hasMany(Waybill::class);
    }
}
