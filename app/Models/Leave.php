<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leave extends Model
{
    use HasFactory;

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function approvedleaves(){
        return $this->hasMany(Approvedleave::class);
    }
    public function leavetype(){
        return $this->belongsTo(Leavetype::class);
    }
}
