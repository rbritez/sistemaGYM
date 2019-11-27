<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SectorCorpxEjercicio extends Model
{
    protected $table = 'sectorcxejercicio';
    public $timestamps = false;
    protected $fillable = ['sector_corp_id','ejercicio_id'];

    public function sectorcorp() {
        return $this->belongsTo('App\Sector_Corporal', 'sector_corp_id');
    }
    public function ejercicio() {
        return $this->belongsTo('App\Ejercicio', 'ejercicio_id');
    }
    
}
