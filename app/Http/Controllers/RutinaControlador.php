<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rutina;
use App\Maquina;
use App\SectorCorpxEjercicio;
use App\rutinaxdias;
use App\diaxejercicios;
use App\Sector_Corporal;
use App\Cliente;
use App\Rutina_Cliente;
use PDF;
// use Barryvdh\DomPDF\Facade as PDF;
// use Dompdf\Dompdf;


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
        return view('rutinas.index', ['rutinas' => $rutinas, 'SC' => Sector_Corporal::all() ]);
    }
        
    Public function listarrutina(){
        
        // $rutinas = Rutina::all();
        // $array=array();
        // foreach($rutinass as $reg){
        //     $array[] = array(
        //         // '0'=>'<button class="btn btn-success" onclick="agregarejercicio('.$request->dia.',\''.$reg->ejercicio_id.'\',\''.$reg->descripcion.'\')">Agregar</button>',
        //         '0'=>'<button class="btn btn-primary"></button>',
        //         '1'=>'1',
        //         '2'=>'2',
        //     );
        // // }
        // $results = array(
        //     "sEcho" =>1, //Informacion para el data table
        //     "iTotalRecords"=>count($array), //enviamos el total de registros al data table
        //     "iTotalDisplayRecords"=>count($array), //enviamos el toal de registros a visualizar
        //     "aaData"=>$array //aca se encuentra almacenado todos los registros
        // );
        // $enviar = json_encode($results);//devolvemos 
        // return $enviar;
    }
    Public function editRutina(Request $request){
        $rutina = Rutina::find($request->idrutina);
        return $rutina;
    }
    Public function editEjercicios(Request $request){
        $result = diaxejercicios::leftjoin('rutinaxdias','rutinaxdias.id','=','diasxejercicio.dia_id')
                                ->leftjoin('ejercicio','ejercicio.id','=','diasxejercicio.ejercicio_id')
                                ->select('diasxejercicio.id AS id_dxe','rutinaxdias.id AS rxd_id','diasxejercicio.ejercicio_id','ejercicio.descripcion','rutinaxdias.dia','diasxejercicio.series','diasxejercicio.repeticiones')
                                ->where('rutinaxdias.rutina_id','=',$request->idrutina)->get();
        return $result;
    }
    public function filtrarejercicio(Request $request){
        $idsectorcorp = $request->sector_corp_id;
        $respuesta = SectorCorpxEjercicio::join('ejercicio','ejercicio.id','=','sectorcxejercicio.ejercicio_id')->leftjoin('maquinas','maquinas.id','=','ejercicio.maquina_id')
                                        ->select('sectorcxejercicio.ejercicio_id','ejercicio.descripcion','maquinas.descripcion AS maquina')
                                        ->where('sectorcxejercicio.sector_corp_id','=',"$idsectorcorp")->get();
        $array=array();                                
        foreach($respuesta as $reg){
            $array[] = array(
                '0'=>'<button class="btn btn-success" onclick="agregarejercicio('.$request->dia.',\''.$reg->ejercicio_id.'\',\''.$reg->descripcion.'\')">Agregar</button>',
                '1'=>$reg->descripcion,
                '2'=>$reg->maquina,
            );
        }
        $results = array(
            "sEcho" =>1, //Informacion para el data table
            "iTotalRecords"=>count($array), //enviamos el total de registros al data table
            "iTotalDisplayRecords"=>count($array), //enviamos el toal de registros a visualizar
            "aaData"=>$array //aca se encuentra almacenado todos los registros
        );
        $enviar = json_encode($results);//devolvemos 
        return $enviar;
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    Public function traerejerciciosfiltro(Request $request){

        if($request->idrutina){
            $diaxrutina = rutinaxdias::select('*')->where([ ['dia','=',$request->nro_dia],['rutina_id','=',$request->idrutina] ])->get();
            $ejercicios = diaxejercicios::join('ejercicio','ejercicio.id','=','diasxejercicio.ejercicio_id')->select('*')->where('dia_id','=',$diaxrutina[0]['id'])->get();
        }else{
            $ejercicios = diaxejercicios::join('ejercicio','ejercicio.id','=','diasxejercicio.ejercicio_id')->select('*')->where('dia_id','=',$request->id)->get();
        }
      
        return $ejercicios;
    }
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
        if( isset($request->rutina_id) && !empty($request->rutina_id)){
                //editamos la rutina
                $rutina = rutina::find($request->rutina_id)->update([
                    'descripcion'=>$request->nombre_rutina,
                    'dificultad'=>$request->dificultad,
                    'nro_dias'=>$request->nro_dias,
                ]);

                $dias = rutinaxdias::select('*')->where('rutina_id','=',$request->rutina_id)->get();
                    if(isset($dias[0]) && !empty($dias[0])){
                        //existen dias de la rutina
                        foreach($dias as $dia){
                            //eliminamos los ejercicios para cargar los nuevos
                            $dia->id;
                            diaxejercicios::where('dia_id','=',$dia->id)->delete(); //eliminamos diasxejercicio
                            rutinaxdias::find($dia->id)->delete(); //eliminamos rutinaxdias
                        }
                    }
                        //creamos el bucle para guardar los dias en rutinaxdias    
                        foreach($request->dia as $diaa){
                            $ejercicio_id = "ejercicio_id".$diaa;
                            $serie = "serie".$diaa;
                            $repeticion = "repeticion".$diaa;
                            //guardamos los dias pertenecientes a una rutina
                            $diaa1 = rutinaxdias::create([
                                'rutina_id'=>$request->rutina_id,
                                'dia'=> $diaa,
                            ]);
                            $val=0; //variable para guardar las series y repeticiones
                            //creamos un bucle para guardar los ejercicios pertenecientes a ese dia de esa rutina
                            foreach($request->$ejercicio_id as $ejercicio){
                                $ejercicioxdia= diaxejercicios::create([
                                                'dia_id'=>$diaa1->id,
                                                'ejercicio_id'=>$ejercicio,
                                                'series'=>$request->$serie[$val],
                                                'repeticiones'=>$request->$repeticion[$val],
                                                ]);

                                $val = $val + 1;
                            }
                        }
            return 2;
        }else{
                    //creamos la rutina
                $rutina = Rutina::create([
                    'descripcion'=>$request->nombre_rutina,
                    'dificultad'=>$request->dificultad,
                    'nro_dias'=>$request->nro_dias,
                ]);
                //creamos el bucle para guardar los dias en rutinaxdias    
                foreach($request->dia as $diaa){
                    $ejercicio_id = "ejercicio_id".$diaa;
                    $serie = "serie".$diaa;
                    $repeticion = "repeticion".$diaa;
                    //guardamos los dias pertenecientes a una rutina
                    $diaa1 = rutinaxdias::create([
                        'rutina_id'=>$rutina->id,
                        'dia'=> $diaa,
                    ]);
                    $val=0; //variable para guardar las series y repeticiones
                    //creamos un bucle para guardar los ejercicios pertenecientes a ese dia de esa rutina
                    foreach($request->$ejercicio_id as $ejercicio){
                        $ejercicioxdia= diaxejercicios::create([
                                        'dia_id'=>$diaa1->id,
                                        'ejercicio_id'=>$ejercicio,
                                        'series'=>$request->$serie[$val],
                                        'repeticiones'=>$request->$repeticion[$val],
                                        ]);

                        $val = $val + 1;
                    }
                }
            return 1 ;
        }
       
    }
    public function rutinaCliente($id){

        $cliente = Cliente::find($id);
        $rutinas = Rutina_Cliente::where('cliente_id',$id)->get();

        return view('rutinas.rutinaCliente',['cliente'=>$cliente,'rutinas'=>$rutinas]);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function traerdias(Request $request){

        $dias = rutinaxdias::select('*')->where('rutina_id','=',$request->id)->get();
        return $dias;
    }
    public function show($id)
    {
        // $rutina = Rutina::find($id);
        // return view('rutinas.show', [
        //     'rutina' => $rutina,
        //     'maquinas' => Maquina::whereNotIn('id', $rutina->maquinas->map(function ($maquina) {
        //         return $maquina->id;
        //     }))->get()
        // ]);
        $rutinass = Rutina::all();
        $array=array();
        foreach($rutinass as $reg){
            $array[] = array(
                // '0'=>'<button class="btn btn-success" onclick="agregarejercicio('.$request->dia.',\''.$reg->ejercicio_id.'\',\''.$reg->descripcion.'\')">Agregar</button>',
                '0'=>'<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal_ver_ejercicios" onclick="verejercicios('.$reg->id.')">Ver Ejercicios</button> '.' <button type="button" style="color:white" class="btn btn btn-warning" onclick="mostrarEdit('.$reg->id.')">Editar</button>'.' <a target="_blank" href="rutinas/rutinaPDF/'.$reg->id.'"><button type="button" class="btn btn btn-danger">Imprimir</button></a>',
                '1'=>$reg->descripcion,
                '2'=>$reg->dificultad,
                '3'=>$reg->nro_dias,
                '4'=>($reg->estado) ? '<span class="btn btn-success" onclick="cambiarestado('.$reg->id.');">activo</span>' : '<span class="btn btn-danger"  onclick="cambiarestado('.$reg->id.');">Inactivo</span>' 
            );
        }
    $results = array(
        "sEcho" =>1, //Informacion para el data table
        "iTotalRecords"=>count($array), //enviamos el total de registros al data table
        "iTotalDisplayRecords"=>count($array), //enviamos el toal de registros a visualizar
        "aaData"=>$array //aca se encuentra almacenado todos los registros
    );
    $enviar = json_encode($results);//devolvemos 
    return $enviar;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    Public function cambiarestado(Request $request){
        $rutina = rutina::find($request->id);
        if($rutina->estado == 1){
            rutina::find($request->id)->update([
                'estado'=> 0,
            ]);
            return 1;
        }else{
            rutina::find($request->id)->update([
                'estado'=> 1,
            ]);
            return 1;
        }
        
    }
    public function edit($id)
    {
        //
    }
    Public function rutinaPDF($id){
        $ejercicios = array();
        $dias = rutinaxdias::select('*')->where('rutina_id','=',$id)->get();
        foreach($dias as $dia){
            $ejj= diaxejercicios::join('ejercicio','ejercicio.id','=','diasxejercicio.ejercicio_id')->select('*')->where('dia_id','=',$dia->id)->get();
            foreach($ejj as $ej ){
                $ejercicios[] = array(
                    'id_dia'=> $ej->dia_id,
                    'descripcion'=>$ej->descripcion,
                    'series'=>$ej->series,
                    'repeticiones'=>$ej->repeticiones,
                );
            }

         }
         
        $pdf = PDF::loadView('rutinas.rutinaPDF', ['dias'=>$dias,'ejercicios'=>$ejercicios] );
        return $pdf->stream('rutina.pdf');
        // $pdf = new Dompdf();
        // $pdf->set_option("isPhpEnabled", true);
        // $pdf = \App::make('dompdf.wrapper');
        //  $pdf = PDF::loadView('courses.pdf.list',['data_ass'=>$data_ass,'postulantes'=>$postulantes, 'id'=>$id,'course'=>$course,'nro'=>$nro,'nro_p'=>$nro_p]);
        // return  $pdf->stream('list.pdf');
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
