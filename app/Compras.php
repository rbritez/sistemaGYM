<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Compras extends Model
{
    protected $table = 'compras';
    public $timestamps = false;
    protected $fillable = ['id', 'fecha','cantidad','total','id_proveedor','id_producto'];

    public function Proveedor() {
        return $this->belongsTo('App\Proveedores', 'id_proveedor');
    }
    public function Producto() {
        return $this->belongsTo('App\Productos', 'id_producto');
    }
}
