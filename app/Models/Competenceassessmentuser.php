<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Competenceassessmentuser extends Model
{
    use HasFactory;

    public function competenceassessment(){
        return $this->belongsTo(Competenceassessment::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function sentto(){
        return $this->belongsTo(User::class);
    }
}
