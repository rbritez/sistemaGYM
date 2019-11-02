<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fichamedica extends Model
{
    protected $table = 'ficha_medica';
    public $timestamps = false;
    protected $fillable = ['cliente_id','estado_nutricional_id','peso','talla','altura','fecha'];

    public function cliente() {
        return $this->belongsTo('App\Cliente');
    }
    public function estadoNutricional(){
        return $this->belongsTo('App\Estadonutricional');
    }
}
