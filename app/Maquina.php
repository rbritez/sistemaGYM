<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Maquina extends Model
{
    protected $table = 'maquinas';
    public $timestamps = false;
    protected $fillable = ['descripcion', 'estado'];

    public function rutinas() {
        return $this->belongsToMany('App\Rutina', 'rutina_maquinas', 'maquina_id', 'rutina_id');
    }
    Public function ejercicio(){
        return $this->hasMany('App\Ejercicio','maquina_id');
    }
}
