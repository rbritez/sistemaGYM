<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table = 'clientes';
    public $timestamps = false;
    protected $fillable = ['persona_id'];

    public function persona() {
        return $this->belongsTo('App\Persona', 'persona_id');
    }

    public function inscripcion() {
        return $this->hasOne('App\Inscripcion', 'cliente_id');
    }

    public function pagos() {
        return $this->hasMany('App\Pago', 'cliente_id');
    }
}
