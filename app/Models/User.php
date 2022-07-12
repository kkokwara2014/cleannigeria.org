<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function roles(){
        return $this->belongsToMany(Role::class);
    }
    public function hasAnyRoles($roles){
        return null !== $this->roles()->whereIn('name',$roles)->first();
    }
    public function hasAnyRole($role){
        return null !== $this->roles()->where('name',$role)->first();
    }
    public function loginaudits(){
        return $this->hasMany(Loginaudit::class);
    }

    public function keypersonnels(){
        return $this->hasMany(Keypersonnel::class);
    }

    public function staffcategory(){
        return $this->belongsTo(Staffcategory::class);
    }
    public function location(){
        return $this->belongsTo(Location::class);
    }

    public function galleries(){
        return $this->hasMany(Gallery::class);
    }
    public function membcompanies(){
        return $this->hasMany(Membcompany::class);
    }
    public function employeeinfos(){
        return $this->hasMany(Employeeinfo::class);
    }
    public function news(){
        return $this->hasMany(News::class);
    }
    public function leaves(){
        return $this->hasMany(Leave::class);
    }
    public function approvedleaves(){
        return $this->hasMany(Approvedleave::class);
    }

    public function visitorbookings(){
        return $this->hasMany(Visitorbooking::class);
    }

    public function company(){
        return $this->belongsTo(Company::class);
    }

    public function maintrequests(){
        return $this->hasMany(Maintrequest::class);
    }

    public function bio(){
        return $this->hasMany(Biometric::class);
    }

    public function timesheet()
    {
        return $this->hasMany(Biotimesheet::class);
    }
}
