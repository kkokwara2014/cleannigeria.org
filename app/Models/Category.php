<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public function approver(){
        return $this->belongsTo(User::class);
    }
    public function srequipments(){
        return $this->hasMany(Srequipment::class);
    }
}
