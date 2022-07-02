<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lga extends Model
{
    use HasFactory;

    public function employeeinfos(){
        return $this->hasMany(Employeeinfo::class);
    }
}
