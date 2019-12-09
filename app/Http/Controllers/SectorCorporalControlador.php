<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Sector_Corporal;

class SectorCorporalControlador extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         return view('SectorCorporal.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    Public function listar(){
        $respuesta= Sector_Corporal::all();
        $array=array();                                
        foreach($respuesta as $reg){
            $array[] = array(
                '0'=>'<button type="button" class="btn btn-warning" onclick="mostrarSC('.$reg->id.')" data-toggle="modal" data-target="#modal_EditSC">Editar</button>',
                '1'=>$reg->nombre,
                '2'=>($reg->imagen) ? '<img src="../img/'.$reg->imagen.'" width="70" height="70">' : 'No hay Imagen para mostrar',
                '3'=>($reg->estado == 1) ?'<b style="color:aliceblue;background-color:darkgreen;padding:5px 11px;border-radius:5px">Activo</b>':'<b style="color:aliceblue;background-color: darkred;padding:5px;border-radius:5px">Inactivo</b>',
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
    Public function mostrar(Request $request){
        $sc = Sector_Corporal::find($request->id);
        return $sc;
    }
    public function create()
    {
        // return view('proveedores.create', [

        // ]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->file('imagen')){
            $file = $request->file('imagen');
            $name = 'gym_'.time().'.'.$file->getClientOriginalExtension();
            $path = public_path().'/img/';
            $file->move($path,$name);

            $ejercicio = Sector_Corporal::create([
                'nombre' => $request->input('nombre'),
                'imagen' => $name,
             ]);
           }else{
            $ejercicio = Sector_Corporal::create([
                'nombre' => $request->input('nombre'),
                'imagen' => '',
             ]);
           }
         
         return redirect()->route('SectorCorporal.index');
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
        // $ejercicio = Ejercicio::find($request->id);
        // return $ejercicio;
    }
     public function update(Request $request, $id)
    {
        $guardarIMG = '';
        if(!empty($request->imgAnterior)){ //si no esta vacio
            $guardarIMG = $request->imgAnterior;
        }
        if($request->file('imagen')){
            $file = $request->file('imagen');
            $guardarIMG = 'gym_'.time().'.'.$file->getClientOriginalExtension();
            $path = public_path().'/img/';
            $file->move($path,$guardarIMG);
            $eliminarIMG = public_path().'/img/';
            File::delete($request->imgAnterior);
        }
        $sc = Sector_Corporal::find($request->id_sector_corporal)->update([
            'nombre'=> $request->nombre,
            'imagen'=> $guardarIMG,
        ]);
        // Ejercicio::find($request->id_ejercicio)->update([
        //     'descripcion'=> $request->nombre,
        //     'maquina_id'=>$request->maquina_id,
        //     'sector_corp_id'=> $request->sector_corp,
        // ]);
        return redirect()->route('SectorCorporal.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   
        // $ejercicio= ejercicio::find($id);
        // if ($ejercicio->estado == 1) {
        //     ejercicio::find($id)->update([
        //         'estado' => '0',
        //     ]);
        // }else{
        //     ejercicio::find($id)->update([
        //         'estado' => '1',
        //     ]);
        // }
        // return redirect()->route('ejercicios.index');
    }
}
