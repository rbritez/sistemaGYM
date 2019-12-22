<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Persona;
use App\Cliente;
use App\Plan;
use App\Plan_Cliente;
use App\Pago;
use PDF;

class ClientesControlador extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {  
        $clientes = Cliente::all();
        return view('clientes.index', ['clientes'=> $clientes,'planes'=>Plan::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('empleados.create', ['turnos' => Turno::all()]);
    }
    Public  function Ingresos(){
        return view('empleados.ingresos');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $fechaActual = date("Y-m-d");
        $persona = Persona::create([
            'nombre' => $request->input('nombre'),
            'apellido' => $request->input('apellido'),
            'fecha_nac'=>$request->input('fecha_nac'),
            'celular'=>$request->input('celular')
        ]);
        $cliente = Cliente::create([
            'persona_id' => $persona->id,
            'fecha_ingreso'=>$fechaActual,
        ]);
        // CALCULAR FECHA DE VENCIMIENTO
        // $plan = Plan::find($request->plan_id);
        // $fechaVencimiento = date('Y-m-d',strtotime($fechaActual."+ $plan->cant_meses month" ));
        // Plan_Cliente::create([
        //     'cliente_id'=>$cliente->id,
        //     'plan_id'=>$request->plan_id,
        //     'fecha_inicio'=>$fechaActual,
        //     'fecha_fin'=>$fechaVencimiento,
        // ]);
        return redirect()->route('clientes.index');
    }
    public function totalMes(Request $request){
        $clientes = Cliente::selectRaw("DATE_FORMAT(fecha_ingreso,'%M/%Y') as 'fecha',COUNT(id) as 'cantidad', MONTH(fecha_ingreso) as 'fechas' ")
                    ->groupBy('fecha')->orderBy('fecha_ingreso','desc')->take(2)->get();

        return $clientes;
    }
    Public function constantes(Request $request){
        $clientes = Cliente::selectRaw("clientes.id,persona_id,fecha_ingreso, (select count(id) from pagos where pagos.cliente_id = clientes.id) as 'pagos' ")
        ->where('estado','1')->orderby('pagos','desc')->take(5)->get();
        $enviar= array();
        foreach($clientes as $cl){
            $enviar[] = array(
             'cliente_id'=> $cl->id,
             'nombre'=> $cl->persona->nombre,
             'apellido'=>$cl->persona->apellido,
             'fecha_ingreso'=>date("d/m/Y", strtotime($cl->fecha_ingreso)),
             'pagos'=>$cl->pagos,   
            );
        }
        return $enviar;
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function show($id)
    // {
    //     return view('empleados.show', [
    //         'empleado' => Empleado::find($id),
    //         'turnos' => Turno::all(),
    //     ]);
    // }
    
    public function ultimoPlan(Request $request)
    {
        $ultimoPlan = Plan_Cliente::join('planes','planes.id','=','planes_cliente.plan_id')->select('planes_cliente.plan_id','planes.precio')->where('cliente_id','=',$request->id_cliente)->orderBy('fecha_fin','DESC')->limit('1')->get();
        $plan = Plan::find($ultimoPlan[0]->plan_id);
        $array= array();
        foreach($ultimoPlan as $ut){
            $array[]=array(
                "plan_id"=> $ut->plan_id,
                "precio"=> $ut->precio,
                "cant_meses"=>$plan->cant_meses,
            );
        }
        return $array;
    }
    public function precio(Request $request){
        $precio = Plan::find($request->id_plan);
        return $precio;
    }
    public function activosfinplan(Request $request){
        $hoy = date('Y-m-d');
        $clientes = Cliente::where([['estado','=', 1],['fecha_inactivo','<', "$hoy"]])->get();
        $enviar = array();
     
        foreach($clientes as $i) {
            $enviar[]= array(
                'apellido' => $i->persona->apellido,
                'nombre'=> $i->persona->nombre,
                'contacto'=> $i->persona->celular,
                'fin_plan'=>date('d/m/Y',strtotime($i->fecha_inactivo)),
            );
        }
        return $enviar;
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
    Public function inactivosPDF(Request $request, $id){
        $clientes = Cliente::where('estado','0')->get();
        $pdf = PDF::loadView('clientes.inactivosPDF', ['clientes'=>$clientes] );
        return $pdf->stream('clientesInactivos.pdf');
    }
    public function mostrar(Request $request){
        $cliente = Cliente::find($request->id);
        $persona = Persona::find($cliente->persona_id);
        $enviar = [
            'id'=> $cliente->id,
            'nombre'=> $persona->nombre,
            'apellido'=>$persona->apellido,
            'fecha_nac'=>$persona->fecha_nac,
            'celular'=>$persona->celular,
        ];
        return $enviar;
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
        $cliente = Cliente::find($request->id_cliente);
        Persona::find($cliente->persona_id)->update([
            'nombre' => $request->nombre,
            'apellido'=>$request->apellido,
            'fecha_nac'=>$request->fecha_nac,
            'celular'=> $request->celular,
        ]);
        return redirect()->route('clientes.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $Request,$id)
    {
        $empleado = Empleado::find($id);
        if($empleado->estado == '1'){
            Empleado::find($id)->update([
                'estado' => 0,
            ]);
        }else{
            Empleado::find($id)->update([
                'estado' => 1,
            ]);
        }

        return '1';
    
    }
}
