<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rutina_Cliente extends Model
{
    protected $table = 'rutina_cliente';
    public $timestamps = false;
    protected $fillable = ['cliente_id','rutina_id','fecha_cambio'];

    public function cliente() {
        return $this->BelongsTo('App\Cliente', 'cliente_id');
    }
    public function rutina() {
        return $this->BelongsTo('App\Rutina', 'rutina_id');
    }

}
