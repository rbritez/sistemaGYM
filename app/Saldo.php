<?php
    namespace App;

    use Illuminate\Database\Eloquent\Model;
    
    class Saldo extends Model
    {
        protected $table = 'saldos';
        public $timestamps = false;
        protected $fillable = ['id', 'cliente_id','monto_saldo'];
    
        public function cliente() {
            return $this->belongsTo('App\Cliente', 'cliente_id');
        }
    
    }
    
