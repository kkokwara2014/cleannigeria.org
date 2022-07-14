<?php

namespace App\Models;

use App\Models\Scannerlocation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Biotimesheet extends Model
{
    use HasFactory;

    protected $fillable = ['user_location',
                            'user_id',
                            'location_id',
                            'clocked_in',
                            'clocked_out',];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function location()
    {
        return $this->hasOne(Scannerlocation::class, 'id', 'location_id');
    }

    
    public static function boot()
    {
        parent::boot();
        
        static::addGlobalScope('duration', function (Builder $builder) {
                if (is_null($builder->getQuery()->columns)) {
                $builder->select($builder->getQuery()->from.'.*');
                }

            $builder->addSelect(
                \DB::raw('TIMESTAMPDIFF(minute, clocked_in, clocked_out) as duration')
            );
        });
    }

}
