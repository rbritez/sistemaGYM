<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Productos;
use App\Proveedores;
use App\Compras;

class ComprasControlador extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         return view('compras.show', ['compras' => Compras::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('compras.create', [
            'proveedores' => Proveedores::all(),
            'productos' => Productos::all()

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
        $producto = Compras::create([
            'cantidad' => $request->input('cantidad'),
            'total' => $request->input('total'),
            'id_proveedor' => $request->input('id_proveedor'),
            'id_producto' => $request->input('id_producto'),
        ]);
        return redirect()->route('compras.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('compras.show', [
            'compras' => Compras::find($id)
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
        Compras::find($id)->delete();
        return redirect()->route('compras.index');
    }
}
