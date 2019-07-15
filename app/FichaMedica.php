<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fichamedica extends Model
{
    protected $table = 'ficha_medica';
    public $timestamps = false;
    protected $fillable = ['cliente_id', 'estado_fisico', 'peso'];

    public function cliente() {
        return $this->belongsTo('App\Cliente', 'cliente_id');
    }
}
