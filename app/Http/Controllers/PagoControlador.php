<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pago;
use App\Inscripcion;
use App\Empleado;
use App\Cliente;
use App\Plan;
use App\Plan_Cliente;
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
       
        $fechaActual = date("Y-m-d");
        Pago::create([
            'cliente_id' => $request->cliente_id,
            'empleado_id' => 2,
            'plan_id' => $request->plan_id,
            'monto' => $request->pago,
        ]);
        // $fechaVencimiento = date('Y-m-d',strtotime($fechaActual."+ $request->cant_meses month" ));
        // Plan_Cliente::create([
        //     'cliente_id'=>$request->cliente_id,
        //     'plan_id'=>$request->plan_id,
        //     'fecha_inicio'=>$fechaActual,
        //     'fecha_fin'=>$fechaVencimiento,
        // ]);
        return redirect()->route('pagos.index',[
            'pagos' => Pago::all(),
            'planes'=>Plan::all(),
            'inscripciones' => Inscripcion::all(),
            'clientes' => Cliente::all()
        ]);
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
