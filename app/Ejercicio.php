<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ejercicio extends Model
{
    protected $table = 'ejercicio';
    public $timestamps = false;
    protected $fillable = ['descripcion','maquina_id','estado'];

    public function sectorcorpxejercicio() {
        return $this->hasMany('App\SectorCorpxEjercicio', 'ejercicio_id');
    }
    Public function maquina(){
        return $this->belongsTo('App\Maquina','maquina_id');
    }
}
