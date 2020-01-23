<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NotaCredito extends Model
{
    protected $table = 'notas_credito';
    public $timestamps = false;
    protected $fillable = ['id', 'pago_id','planclienteANT_id','monto_pANT','planACT_id','monto_pACT','monto','saldo_usado','saldo_disp','fecha'];

    public function pago() {
        return $this->belongsTo('App\Pago', 'pago_id');
    }
    public function planclienteANT() {
        return $this->belongsTo('App\Plan_Cliente', 'planclienteANT_id');
    }
    public function planclienteACT() {
        return $this->belongsTo('App\Plan_Cliente', 'planACT_id');
    }
}
