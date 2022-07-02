<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    public function users(){
        return $this->hasMany(User::class);
    }
    public function stores(){
        return $this->hasMany(Store::class);
    }

    public function srequipments(){
        return $this->hasManyThrough(Srequipment::class, Store::class);
    }

    public function employeeinfos(){
        return $this->hasMany(Employeeinfo::class);
    }
    

}
