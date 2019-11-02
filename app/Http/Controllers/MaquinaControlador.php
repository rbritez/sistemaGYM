<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Maquina;
use App\Rutina;

class MaquinaControlador extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('maquinas.index', [
            'maquinas' => Maquina::all(),
            'estados' => [['disponible', 'Disponible'], ['deposito', 'En el deposito'], ['reparacion', 'Reparación'],['no disponible','No Disponible']]
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
        Maquina::create([
            'descripcion' => $request->input('descripcion'),
            'estado' => $request->input('estado'),
        ]);
        return redirect()->route('maquinas.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $maquina = Maquina::find($id);
        return view('maquinas.show', [
            'maquina' => $maquina,
            'rutinas' => Rutina::whereNotIn('id', $maquina->rutinas->map(function ($rutina) {
                return $rutina->id;
            }))->get(),
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
        Maquina::find($id)->update([
            'descripcion' => $request->input('descripcion'),
            'estado' => $request->input('estado'),
        ]);
        return redirect()->route('maquinas.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Maquina::find($id)->delete();
        return redirect()->route('maquinas.index');
    }
}
