<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class diaxejercicios extends Model
{
    protected $table = 'diasxejercicio';
    public $timestamps = false;
    protected $fillable = ['dia_id','ejercicio_id','series','repeticiones'];

    Public function rutinaxdias(){
        return $this->belongsTo('App\rutinaxdias','dia_id');
    }
    Public function ejercicio(){
        return $this->hasmany('App\Ejercicio','ejercicio_id');
    }
}
