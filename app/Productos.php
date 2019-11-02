<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Productos extends Model
{
    protected $table = 'productos';
    public $timestamps = false;
    protected $fillable = ['id', 'descripcion','precio_venta','id_proveedor','id_categoria'];

    public function Proveedor() {
        return $this->belongsTo('App\Proveedores');
    }
    public function Categoria() {
        return $this->belongsTo('App\Categorias');
    }
}
