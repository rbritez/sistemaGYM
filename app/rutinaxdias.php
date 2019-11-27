<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class rutinaxdias extends Model
{
    protected $table = 'rutinaxdias';
    public $timestamps = false;
    protected $fillable = ['rutina_id','dia'];

    Public function rutina(){
        return $this->belongsTo('App\Rutina','rutina_id');
    }
    Public function diaxejercicios(){
        return $this->hasmany('App\diaxejercicios','dia_id');
    }
}
