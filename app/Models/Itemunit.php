<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Itemunit extends Model
{
    use HasFactory;

    public function srequipments(){
        return $this->hasMany(Srequipment::class);
    }
}
