<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pago;
use App\Inscripcion;
use App\Empleado;

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
            'inscripciones' => Inscripcion::all(),
            'empleados' => Empleado::all()
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $inscripcion = Inscripcion::find($request->input('inscripcion_id'));
        Pago::create([
            'cliente_id' => $inscripcion->cliente->id,
            'empleado_id' => $request->input('empleado_id'),
            'plan_id' => $inscripcion->plan->id,
            'monto' => $inscripcion->plan->precio,
        ]);
        if ($request->input('inscripcion_redirect')) {
            return redirect()->route('inscripciones.show', $inscripcion->id);
        }
        return redirect()->route('pagos.index');
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
