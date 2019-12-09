<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Empleado;
use App\Turno;
use App\Persona;
use App\Ingreso;

class EmpleadoControlador extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('empleados.index', ['empleados' => Empleado::all(),'turnos'=>Turno::select('*')->where('estado','=',1)->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    Public function asistencias(){
        $asistencias = Ingreso::select()->whereRaw('YEARWEEK(fecha - INTERVAL 1 DAY) = YEARWEEK(NOW())')->orderby('empleado_id','desc')->get();
        $array = array();
        foreach( $asistencias as $asistencia){
            $array[] = array(
                'id'=> $asistencia->id,
                'empleado_id'=>$asistencia->empleado_id,
                'apellido'=> $asistencia->empleado->persona->apellido,
                'nombre'=> $asistencia->empleado->persona->nombre,
                'fecha'=>$asistencia->fecha,
                'hora'=>$asistencia->hora,
                'turno_id'=>$asistencia->turno_id,
                'turno'=>$asistencia->turno->descripcion,
            );
        };

        return $array;
    }
    public function create()
    {
        return view('empleados.create', ['turnos' => Turno::all()]);
    }
    Public  function Ingresos(){
        return view('empleados.ingresos');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $persona = Persona::create([
            'nombre' => $request->input('nombre'),
            'apellido' => $request->input('apellido'),
            'dni' => $request->input('dni'),
            'domicilio' => $request->input('domicilio')
        ]);
        $empleado = Empleado::create([
            'persona_id' => $persona->id,
        ]);
        return redirect()->route('empleados.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('empleados.show', [
            'empleado' => Empleado::find($id),
            'turnos' => Turno::all(),
        ]);
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
        $empleado = Empleado::find($id);
        Persona::find($empleado->persona_id)->update([
            'nombre' => $request->nombre,
            'apellido'=>$request->apellido,
            'dni'=>$request->dni
        ]);
        return redirect()->route('empleados.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $Request,$id)
    {
        $empleado = Empleado::find($id);
        if($empleado->estado == '1'){
            Empleado::find($id)->update([
                'estado' => 0,
            ]);
        }else{
            Empleado::find($id)->update([
                'estado' => 1,
            ]);
        }

        return '1';
    
    }
}
