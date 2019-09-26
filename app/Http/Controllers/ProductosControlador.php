<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Productos;
use App\Proveedores;
use App\Categorias;

class ProductosControlador extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         return view('productos.show', ['productos' => Productos::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('productos.create', [
            'proveedores' => Proveedores::all(),
            'categorias' => Categorias::all()

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
        $producto = Productos::create([
            'descripcion' => $request->input('descripcion'),
            'precio' => $request->input('precio'),
            'proveedor_id' => $request->input('proveedor_id'),
            'categoria_id' => $request->input('categoria_id'),
        ]);
        return redirect()->route('productos.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('productos.show', [
            'productos' => Productos::all()
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
