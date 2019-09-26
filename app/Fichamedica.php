<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fichamedica extends Model
{
    protected $table = 'ficha_medica';
    public $timestamps = true;
    protected $fillable = ['cliente_id', 'descripcion','peso','descripcion','fecha'];

    public function cliente() {
        return $this->belongsTo('App\Cliente', 'cliente_id');
    }
    public function estadoNutricional(){
        return $this->belongsTo('App\Estadonutricional' , 'descripcion');
    }
}
