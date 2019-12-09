<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Ejercicio;
use App\Maquina;
use App\Sector_Corporal;

class EjerciciosControlador extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         return view('ejercicios.index', ['ejercicios' => Ejercicio::all(), 'maquinas'=> Maquina::where('estado','disponible')->get(),'maquinasTotal'=>Maquina::all(),'sectores'=>Sector_Corporal::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('proveedores.create', [

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
       
        $ejercicio = Ejercicio::create([
            'descripcion' => $request->input('nombre'),
            'maquina_id'=>$request->maquina_id,
            'sector_corp_id' =>$request->sector_corp,

        ]);
        return redirect()->route('ejercicios.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    Public function mostrarr(Request $request){
        $ejercicio = Ejercicio::find($request->id);
        return $ejercicio;
    }
     public function update(Request $request, $id)
    {
        Ejercicio::find($request->id_ejercicio)->update([
            'descripcion'=> $request->nombre,
            'maquina_id'=>$request->maquina_id,
            'sector_corp_id'=> $request->sector_corp,
        ]);
        return redirect()->route('ejercicios.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   
        $ejercicio= ejercicio::find($id);
        if ($ejercicio->estado == 1) {
            ejercicio::find($id)->update([
                'estado' => '0',
            ]);
        }else{
            ejercicio::find($id)->update([
                'estado' => '1',
            ]);
        }
        return redirect()->route('ejercicios.index');
    }
}
