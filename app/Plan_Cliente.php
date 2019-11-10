<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Plan_Cliente extends Model
{
    protected $table = 'planes_cliente';
    public $timestamps = false;
    protected $fillable = ['cliente_id','plan_id', 'fecha_inicio','fecha_fin','estado'];

    public function cliente() {
        return $this->belongsTo('App\Cliente', 'cliente_id');
    }
    public function plan() {
        return $this->belongsTo('App\Plan', 'plan_id');
    }
    
}
