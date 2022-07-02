<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Competenceassessment extends Model
{
    use HasFactory;

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function hsworkenvironment(){
        return $this->hasMany(Hsworkenvironment::class);
    }
    public function hsrisk(){
        return $this->hasMany(Hsrisk::class);
    }
    public function fatrainings(){
        return $this->hasMany(Fatraining::class);
    }
    public function gastestings(){
        return $this->hasMany(Gastesting::class);
    }
    public function operationhandovers(){
        return $this->hasMany(Operationhandover::class);
    }
    public function forkliftops(){
        return $this->hasMany(Forkliftop::class);
    }
    public function selfloaderops(){
        return $this->hasMany(Selfloaderop::class);
    }
    public function powerdrivenscops(){
        return $this->hasMany(Powerdrivenscop::class);
    }
    public function responseequips(){
        return $this->hasMany(Responseequip::class);
    }
    public function miscinnorespskills(){
        return $this->hasMany(Miscinnorespskill::class);
    }
    public function fateoilskills(){
        return $this->hasMany(Fateoilskill::class);
    }
    public function impactoilpollutions(){
        return $this->hasMany(Impactoilpollution::class);
    }
    public function survmodelvisualizations(){
        return $this->hasMany(Survmodelvisualization::class);
    }
    public function offshoreresponses(){
        return $this->hasMany(Offshoreresponse::class);
    }
    public function dispersants(){
        return $this->hasMany(Dispersant::class);
    }
    public function shorelineresponses(){
        return $this->hasMany(Shorelineresponse::class);
    }
    public function inlandresponses(){
        return $this->hasMany(Inlandresponse::class);
    }
    public function incidentmgts(){
        return $this->hasMany(Incidentmgt::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
