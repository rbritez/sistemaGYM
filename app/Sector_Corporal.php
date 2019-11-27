<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sector_Corporal extends Model
{
    protected $table = 'sector_corp';
    public $timestamps = false;
    protected $fillable = ['nombre','estado'];


    public function sectorcorpxejercicio() {
        return $this->hasMany('App\SectorCorpxEjercicio', 'sector_corp_id');
    }
}
