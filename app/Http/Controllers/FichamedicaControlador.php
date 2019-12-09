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

class FichamedicaControlador extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //  return view('fichaMedica.show', ['fichaMedica' => FichaMedica::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
  
        return view('fichamedica.create', [
            'estadoNutricional' => EstadoNutricional::all(),

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
        $imc=0;
        $altura= ($request->altura/100)*($request->altura/100);
        $peso = $request->peso+0;
        $imc = $peso / $altura;
        switch ($imc) {
            case $imc >=30.0:
                $estadoNuticional = 4;
                break;
            case $imc >= 25.0:
                $estadoNuticional = 3;
                break;
            case $imc >= 18.5:
                $estadoNuticional = 2;
                break;
            case $imc < 18.5:
            $estadoNuticional = 1;
        };
        //  dd($request->cliente_id);
        $fichamedica = FichaMedica::create([
            'cliente_id'=> $request->input('cliente_id'),
            'fecha' => $request->input('fecha_revision'),
            'peso' => $request->input('peso'),
            'altura' => $request->input('altura'),
            'estado_nutricional_id' => $estadoNuticional,
        ]);
        return redirect()->route('fichamedica.show',$request->cliente_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $postulantes= coursexpostulante::join('courses','courses.id','=','coursexpostulante.course_id')
        // ->join( 'postulante','postulante.id','=','coursexpostulante.postulante_id')
        // ->join('persons','persons.id','=','postulante.person_id')
        // ->select('persons.number_tel','persons.date_birth','postulante.id','persons.name','persons.last_name','persons.dni','postulante.tipo_licencia')->where('coursexpostulante.course_id','=',"$id")->orderBy('persons.last_name','ASC')->get();
        // $inscripcion = Inscripcion::find($id);
        // dd($inscripcion->cliente_id);
        return view('fichamedica.show', [
            'cliente' => Cliente::find($id),
            'fichamedica' => Fichamedica::where('cliente_id',$id)->orderBy('fecha','desc')->get(),
            'fichamedica2'=> Fichamedica::where('cliente_id',$id)->orderBy('fecha','asc')->get(),
            'estadoNutricional' => EstadoNutricional::all()
        ]);
    }
    Public function mostrar(Request $request){
        $fichamedica = Fichamedica::find($request->id);
        return $fichamedica;
    }
    Public function filtrarFecha(Request $request){
        $fecha="";
        $peso="";
        $filtro = Fichamedica::select('peso','fecha')->WhereBetween('fecha',["$request->fechaI","$request->fechaF"])->where('cliente_id',$request->id)->get();
        // foreach ($filtro as $data) {
        //     $fecha = $fecha.'"'.$data->fecha.'",';
        //     $peso = $peso.$data->peso.',';
        // }
        // $peso = substr($peso,0,-1);
        // $fecha= substr($fecha,0,-1);
        // $fecha= substr($fecha,0,-1);
        // $fecha= substr($fecha,1);
        // $array = array(
        //     'peso' => $peso,
        //     'fecha'=> $fecha,
        // );
        return $filtro;
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
        $imc=0;
        $altura= ($request->altura/100)*($request->altura/100);
        $peso = $request->peso+0;
        $imc = $peso / $altura;
        switch ($imc) {
            case $imc >=30.0:
                $estadoNuticional = 4;
                break;
            case $imc >= 25.0:
                $estadoNuticional = 3;
                break;
            case $imc >= 18.5:
                $estadoNuticional = 2;
                break;
            case $imc < 18.5:
            $estadoNuticional = 1;
        };
        $fichamedica = Fichamedica::find($request->fichamedica_id)->update([
            'fecha' => $request->input('fecha_revision'),
            'peso' => $request->input('peso'),
            'altura' => $request->input('altura'),
            'estado_nutricional_id' => $estadoNuticional,
        ]);
        return redirect()->route('fichamedica.show', $request->cliente_id);
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
