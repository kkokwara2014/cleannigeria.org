<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Forkliftop extends Model
{
    use HasFactory;

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function legend(){
        return $this->belongsTo(Legend::class);
    }
    public function competenceassessment(){
        return $this->belongsTo(Competenceassessment::class);
    }
}
