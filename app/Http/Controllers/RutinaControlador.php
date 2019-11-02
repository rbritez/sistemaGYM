<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rutina;
use App\Maquina;

class RutinaControlador extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rutinas = Rutina::all();
        return view('rutinas.index', ['rutinas' => $rutinas]);
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
        Rutina::create([
            'descripcion' => $request->input('descripcion')
        ]);
        return redirect()->route('rutinas.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $rutina = Rutina::find($id);
        return view('rutinas.show', [
            'rutina' => $rutina,
            'maquinas' => Maquina::whereNotIn('id', $rutina->maquinas->map(function ($maquina) {
                return $maquina->id;
            }))->get()
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
        Rutina::find($id)->update([
            'descripcion' => $request->input('descripcion')
        ]);
        return redirect()->route('rutinas.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Rutina::find($id)->delete();
        return redirect()->route('rutinas.index');
    }
}
