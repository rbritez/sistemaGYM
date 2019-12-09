<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ingreso;
use App\Empleado;
use App\Persona;
use App\Turno;

class IngresoControlador extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function filtro(Request $request)
    {
        $result ='La fecha inicial es '. $request->fecha_inicial. ' y la fecha final es '. $request->fecha_final;
        $FI = $request->fecha_inicial;
        $FF = $request->fecha_fiinal;
        $ingresoEmpleado = Ingreso::select('*')->whereBetween('fecha_hora',[$FI,$FF])->orwhere('empleado_id','=',$request->idempleado)->get();
        return  $ingresoEmpleado;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        Ingreso::create([
            'empleado_id' => $request->empleado_id,
            'turno_id' => $request->turno_id,
            'fecha'=>$request->fecha,
            'hora'=>$request->hora,
        ]);
        return redirect()->route('empleados.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$id)
    {
        $turnos = Turno::all();
        if($request->fechaInicial <> "" ){
            $FI = $request->fechaInicial;
            $FF = $request->fechaFiinal;
            // dd($request->all());
            $ingresoEmpleado1 = Ingreso::select('*')->whereBetween('ingresos.fecha',["$request->fechaInicial","$request->fechaFinal"])->Where('empleado_id','=',$id)->orderBy('fecha','desc')->get();
            $empleado = Empleado::find($id);
            return view('ingresos.show', ['empleado'=> $empleado ,'ingresos' => $ingresoEmpleado1 ,'turnos'=>$turnos,'FechaInicial'=>$request->fechaInicial,'fechaFinal'=>$request->fechaFinal] );
        }else{
            $ingresoEmpleado = Ingreso::select('*')->where('empleado_id','=',$id)->orderBy('fecha','desc')->get();
            $empleado = Empleado::find($id);
            return view('ingresos.show', ['empleado'=> $empleado ,'ingresos' => $ingresoEmpleado,'turnos'=>$turnos ] );
        }
    
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
        Ingreso::find($request->id_ingreso)->update([
            'fecha' => $request->fecha,
            'hora'=>$request->hora,
            'turno_id'=>$request->turno_id
        ]);
        return redirect()->route('ingresos.show',$request->empleado_id);
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
