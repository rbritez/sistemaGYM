<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Productos extends Model
{
    protected $table = 'productos';
    public $timestamps = false;
    protected $fillable = ['id', 'descripcion','precio'];

}
