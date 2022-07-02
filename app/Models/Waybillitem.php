<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Waybillitem extends Model
{
    use HasFactory;

    protected $fillable=[
        'waybill_id',
        'issuenum',
        'description',
    ];

    public function waybill(){
        return $this->belongsTo(Waybill::class);
    }
}
