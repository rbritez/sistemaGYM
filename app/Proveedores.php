<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proveedores extends Model
{
    protected $table = 'proveedores';
    public $timestamps = false;
    protected $fillable = ['id', 'nombre'];
    
    public function producto() {
        return $this->hasMany('App\Productos');
    }
}
