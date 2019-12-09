<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sector_Corporal extends Model
{
    protected $table = 'sector_corp';
    public $timestamps = false;
    protected $fillable = ['nombre','imagen','estado'];


    public function sectorcorpxejercicio() {
        return $this->hasMany('App\SectorCorpxEjercicio', 'sector_corp_id');
    }
    Public function ejercicio(){
        return $this->hasmany('App\Ejercicio','sector_corp_id');
    }
}
