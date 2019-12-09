<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rutina extends Model
{
    protected $table = 'rutinas';
    public $timestamps = false;
    protected $fillable = ['descripcion','dificultad','nro_dias','estado'];

    public function maquinas() {
        return $this->belongsToMany('App\Maquina', 'rutina_maquinas', 'rutina_id', 'maquina_id');
    }

    public function inscripciones() {
        return $this->hasMany('App\Inscripcion', 'rutina_id');
    }
    public function rutinaxdias() {
        return $this->hasMany('App\rutinaxdias', 'rutina_id');
    }
    public function rutina_cliente() {
        return $this->hasMany('App\Rutina_Cliente', 'rutina_id');
    }
}
