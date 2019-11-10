<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ingreso extends Model
{
    protected $table = 'ingresos';
    public $timestamps = false;
    protected $fillable = ['empleado_id', 'turno_id','fecha','hora'];

    public function empleado() {
        return $this->belongsTo('App\Empleado', 'empleado_id');
    }

    public function turno() {
        return $this->belongsTo('App\Turno', 'turno_id');
    }
}

