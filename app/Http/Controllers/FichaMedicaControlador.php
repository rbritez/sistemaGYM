<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Inscripcion;
use App\Plan;
use App\Rutina;
use App\Empleado;
use App\Persona;
use App\Cliente;
use App\Fichamedica;

class FichamedicaControlador extends Controller
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
        $persona = Persona::create([
            'apellido_nombre' => $request->input('apellido_nombre'),
            'dni' => $request->input('dni'),
            'domicilio' => $request->input('domicilio')
        ]);
        $cliente = Cliente::create(['persona_id' => $persona->id]);
        $inscripcion = Inscripcion::create([
            'cliente_id' => $cliente->id,
            'plan_id' => $request->input('plan_id'),
            'rutina_id' => $request->input('rutina_id'),
            'empleado_id' => $request->input('empleado_id'),
        ]);
        return redirect()->route('inscripciones.show', $inscripcion->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('fichamedica.show', [
            'inscripcion' => Inscripcion::find($id),
            'planes' => Plan::all(),
            'rutinas' => Rutina::all(),
            'empleados' => Empleado::all(),
            'fichamedica' => Fichamedica::find($id)
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
