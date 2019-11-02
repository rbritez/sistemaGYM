<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inscripcion extends Model
{
    protected $table = 'inscripciones';
    public $timestamps = false;
    protected $fillable = ['cliente_id', 'empleado_id', 'plan_id', 'rutina_id'];

    public function cliente() {
        return $this->belongsTo('App\Cliente', 'cliente_id');
    }

    public function empleado() {
        return $this->belongsTo('App\Empleado', 'empleado_id');
    }

    public function plan() {
        return $this->belongsTo('App\Plan', 'plan_id');
    }
    
    public function rutina() {
        return $this->belongsTo('App\Rutina', 'rutina_id');
    }
}
