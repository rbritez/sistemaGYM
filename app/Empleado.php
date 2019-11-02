<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    protected $table = 'empleados';
    public $timestamps = false;
    protected $fillable = ['persona_id', 'turno_id'];

    public function persona() {
        return $this->belongsTo('App\Persona', 'persona_id');
    }

    public function turno() {
        return $this->belongsTo('App\Turno', 'turno_id');
    }

    public function ingresos() {
        return $this->hasMany('App\Ingreso', 'empleado_id');
    }

    public function pagos() {
        return $this->hasMany('App\Pago', 'empleado_id');
    }

    public function inscripciones() {
        return $this->hasMany('App\Inscripcion', 'empleado_id');
    }
}
