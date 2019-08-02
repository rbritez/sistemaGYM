<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estadonutricional extends Model
{
    protected $table = 'estado_nutricional';
    public $timestamps = false;
    protected $fillable = ['descripcion'];


}
