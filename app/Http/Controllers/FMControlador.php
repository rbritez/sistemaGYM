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
use App\Estadonutricional;

class FMControlador extends Controller
{

    Public function mostrar(Request $request){
        $fichamedica = Fichamedica::find($request->id);
        return $fichamedica;
    }
    Public function filtrarFecha(Request $request){
        $filtro = Fichamedica::select('peso','fecha')->WhereBetween('fecha',["$request->fechaI","$request->fechaF"])->where('cliente_id',$request->id)->get();
        return $filtro;
    }


    public function store(Request $request)
    {   
        $peso = $request->peso;
        $altura = ($request->altura/100)*($request->altura/100);
        $estadoN = $peso/$altura;
        $IMC="";
        switch ($estadoN) {
            case $estadoN<18.5:
            //peso bajo
            $IMC=1;
                break;
            case $estadoN<24.99:
            //peso normal
            $IMC=2;
                break;
            case $estadoN<29.9:
            //sobrepeso
            $IMC=3;
                break;
            default:
            //obesidad
            $IMC=4;
        }      
        $fichamedica = FichaMedica::create([
            'cliente_id'=> $request->input('cliente_id'),
            'fecha' => $request->input('fecha_revision'),
            'peso' => $request->input('peso'),
            'altura' => $request->input('altura'),
            'estado_nutricional_id' => $IMC,
        ]);
        return redirect()->route('fichamedica.mostrarFichaMedica',$request->cliente_id);
    }


    public function mostrarFichaMedica($id)
    {
        return view('fichamedica.mostrarFichaMedica', [
            'cliente' => Cliente::find($id),
            'fichamedica' => Fichamedica::where('cliente_id','=', "$id")->orderBy('fecha','desc')->get(),
            'fichamedica2' => Fichamedica::where('cliente_id','=', "$id")->get(),
           
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
 
        $peso = $request->peso;
        $altura = ($request->altura/100)*($request->altura/100);
        $estadoN = $peso/$altura;
        $IMC="";
        switch ($estadoN) {
            case $estadoN<18.5:
            //peso bajo
            $IMC=1;
                break;
            case $estadoN<24.99:
            //peso normal
            $IMC=2;
                break;
            case $estadoN<29.9:
            //sobrepeso
            $IMC=3;
                break;
            default:
            //obesidad
            $IMC=4;
        }      
        $fichamedica = FichaMedica::find($request->cliente_id)->update([
            'cliente_id'=> $request->input('cliente_id'),
            'fecha' => $request->input('fecha_revision'),
            'peso' => $request->input('peso'),
            'altura' => $request->input('altura'),
            'estado_nutricional_id' => $IMC,
        ]);
        return redirect()->route('fichamedica.mostrarFichaMedica',$request->cliente_id);
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
