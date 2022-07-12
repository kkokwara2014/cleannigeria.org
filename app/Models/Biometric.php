<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Biometric extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','template','created_by'];

    public function owner()
    {
        return $this->belongTo(User::class);
    }
}
