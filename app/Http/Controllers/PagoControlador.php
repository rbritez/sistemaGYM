<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pago;
use App\Inscripcion;
use App\Empleado;
use App\Cliente;
use App\Plan;
use App\Plan_Cliente;
use App\NotaCredito;
use App\Saldo;
use PDF;
class PagoControlador extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pagos.index', [
            'pagos' => Pago::all(),
            'planes'=>Plan::all(),
            'inscripciones' => Inscripcion::all(),
            'clientes' => Cliente::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }
    Public function montoDia(Request $request){
        $ingresos = Pago::selectRaw("SUM(monto) as 'ingreso'")->whereRaw('DATE(fecha) = curdate()')->get();
        return $ingresos;
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $nuevoSaldo = 0;
        $saldousado = 0;
        $total = 0;
        if($request->usarSaldo == 'on'){
             $nuevoSaldo = $request->saldo - $request->saldoUsado;
            
             $saldo = Saldo::where('cliente_id',$request->cliente_id)->get();
             $newsaldo = Saldo::find($saldo[0]['id'])->update([
                 'monto_saldo'=>$nuevoSaldo,
             ]);
             $total = $request->montoPlan - $request->saldoUsado;
        }else{
            $total = $request->pago;
            $nuevoSaldo = $request->saldo;
        }
        
        Plan_Cliente::where('cliente_id',$request->cliente_id)->update([
            'estado'=>'0',
        ]);
        $fechaActual = date("Y-m-d");

        Pago::create([
            'cliente_id' => $request->cliente_id,
            'empleado_id' => 2,
            'plan_id' => $request->plan_id,
            'monto' => $request->montoPlan,
            'saldo_usado'=>$request->saldoUsado,
            'saldo_disp'=>$nuevoSaldo,
            'total'=>$total,
        ]);
        // $fechaVencimiento = date('Y-m-d',strtotime($fechaActual."+ $request->cant_meses month" ));
  
        return redirect()->route('pagos.index',[
            'pagos' => Pago::all(),
            'planes'=>Plan::all(),
            'inscripciones' => Inscripcion::all(),
            'clientes' => Cliente::all()
        ]);
    }
    public function pagoPDF($id){
        $pago = Pago::find($id);
        $planCliente = Plan_Cliente::where([ ['cliente_id',$pago->cliente_id],['plan_id',$pago->plan_id]])->orderBy('id','desc')->take(1)->get();
        $notaCredito= NotaCredito::where('pago_id',$pago->id)->get();
        if( isset($notaCredito) && !empty($notaCredito->all() )){
            return redirect()->route('inscripciones.notacreditoPDF',$pago->id);
        }
        $saldo = Saldo::where('cliente_id',$pago->cliente_id)->get();
        $pdf = PDF::loadView('pagos.pagoPDF', ['pago'=>$pago,'ultimoPlan'=>$planCliente,'saldo'=>$saldo[0]]);
        return $pdf->stream('recibo.pdf');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
