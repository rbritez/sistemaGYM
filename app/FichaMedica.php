<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fichamedica extends Model
{
    protected $table = 'ficha_medica';
    public $timestamps = true;
    protected $fillable = ['cliente_id', 'estado_nutricional_id','peso','descripcion','fecha'];

    public function cliente() {
        return $this->belongsTo('App\Cliente', 'cliente_id');
    }
    public function estadoNutricional(){
        return $this->belongsTo('App\Estadonutricional' , 'descripcion');
    }
}
