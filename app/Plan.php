<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    protected $table = 'planes';
    public $timestamps = false;
    protected $fillable = ['descripcion', 'precio'];

    public function inscripciones() {
        return $this->hasMany('App\Inscripcion', 'plan_id');
    }

    public function pagos() {
        return $this->hasMany('App\Pago', 'plan_id');
    
    }
}
