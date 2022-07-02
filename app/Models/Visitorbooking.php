<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visitorbooking extends Model
{
    use HasFactory;

    protected $guarded=[];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public static function search($search){
        return empty($search)?
            static::query():
            static::query()->where('bookingnum','like','%'.$search.'%')
                ->orWhere('visitorname','like','%'.$search.'%')
                ->orWhere('visitingdate','like','%'.$search.'%')
                ->orWhere('visitingtime','like','%'.$search.'%')
                ->orWhereHas('user',function($query) use($search){
                    $query->where('firstname','like','%'.$search.'%')
                        ->orWhere('lastname','like','%'.$search.'%')
                        ->orWhere('phone','like','%'.$search.'%')
                        ->orWhere('email','like','%'.$search.'%');
                });
    }
}
