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
        // dd($request->all());
        $fichamedica = FichaMedica::create([
            'cliente_id'=> $request->input('cliente_id'),
            'fecha' => $request->input('fecha_revision'),
            'peso' => $request->input('peso'),
            'talla' => $request->input('talla'),
            'altura' => $request->input('altura'),
            'estado_nutricional_id' => $request->input('estado_nutricional_id'),
        ]);
        $inscripcion = Inscripcion::find($request->id_inscripcion);
        return redirect()->route('fichamedica.show',$inscripcion->id);
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
        $inscripcion = Inscripcion::find($id);
        // dd($inscripcion->cliente_id);
        return view('fichamedica.show', [
            'inscripcion' => Inscripcion::find($id),
            'fichamedica' => Fichamedica::where('cliente_id','=', "$inscripcion->cliente_id")->get(),
            'estadoNutricional' => EstadoNutricional::all()
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
