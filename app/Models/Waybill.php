<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Waybill extends Model
{
    use HasFactory;

    public function waybilllocation(){
        return $this->belongsTo(Waybilllocation::class);
    }
    public function waybillitems(){
        return $this->hasMany(Waybillitem::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function receiver(){
        return $this->belongsTo(User::class);
    }
    public function approver(){
        return $this->belongsTo(User::class);
    }


}
