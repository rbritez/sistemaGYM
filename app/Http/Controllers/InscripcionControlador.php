<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Inscripcion;
use App\Plan;
use App\Rutina;
use App\Empleado;
use App\Persona;
use App\Cliente;
use App\Pago;
use App\Plan_Cliente;
use App\Rutina_Cliente;

class InscripcionControlador extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('inscripciones.index', ['inscripciones' => Inscripcion::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('inscripciones.create', [
            'planes' => Plan::all(),
            'rutinas' => Rutina::all(),
            'empleados' => Empleado::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $hoy = date('Y-m-d');
        $persona = Persona::create([
            'apellido' => $request->input('apellido'),
            'nombre' => $request->input('nombre'),
            'fecha_nac' => $request->input('fecha_nac'),
            'celular' => $request->input('celular'),
        ]);
        $cliente = Cliente::create([
            'persona_id' => $persona->id,
            'fecha_ingreso'=>$hoy]);
        $inscripcion = Inscripcion::create([
            'cliente_id' => $cliente->id,
            'plan_id' => $request->input('plan_id'),
            'rutina_id' => $request->input('rutina_id'),
            'empleado_id' => '5',
        ]);
        $pago = Pago::create([
            'cliente_id'=>$cliente->id,
            'empleado_id'=>'5',
            'plan_id'=>$request->plan_id,
            'monto'=>$request->input('monto'),
            'fecha'=>$hoy,
        ]);
        return redirect()->route('inscripciones.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('inscripciones.show', [
            'inscripcion' => Inscripcion::find($id),
            'planes' => Plan::all(),
            'rutinas' => Rutina::all(),
            'empleados' => Empleado::all()
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
        $inscripcion = Inscripcion::find($id);
        $inscripcion->update([
            'plan_id' => $request->input('plan_id'),
            'rutina_id' => $request->input('rutina_id'),
        ]);
        $inscripcion->cliente->persona->update([
            'apellido_nombre' => $request->input('apellido_nombre'),
            'dni' => $request->input('dni'),
            'domicilio' => $request->input('domicilio')
        ]);
        return redirect()->route('inscripciones.show', $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Inscripcion::find($id)->delete();
        return redirect()->route('inscripciones.index');
    }
}
