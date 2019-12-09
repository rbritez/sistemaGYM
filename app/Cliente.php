<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table = 'clientes';
    public $timestamps = false;
    protected $fillable = ['persona_id','fecha_ingreso','estado'];

    public function persona() {
        return $this->belongsTo('App\Persona', 'persona_id');
    }

    public function inscripcion() {
        return $this->hasOne('App\Inscripcion', 'cliente_id');
    }

    public function pagos() {
        return $this->hasMany('App\Pago', 'cliente_id');
    }
    public function plan_cliente() {
        return $this->hasMany('App\Plan_Cliente', 'cliente_id');
    }
    public function Rutina_Cliente() {
        return $this->hasMany('App\Rutina_Cliente', 'cliente_id');
    }
}
