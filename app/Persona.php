<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    protected $table = 'personas';
    public $timestamps = false;
    protected $fillable = ['nombre','apellido', 'dni', 'domicilio','fecha_nac','celular','email','sexo','barrio','calle','altura','nro_dpto','nro_piso'];

    public function empleado() {
        return $this->hasOne('App\Empleado', 'persona_id');
    }

    public function cliente() {
        return $this->hasOne('App\Cliente', 'persona_id');
    }
}
