<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Persona;
use App\Cliente;
use App\Plan;
use App\Plan_Cliente;
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
        ]);
        $cliente = Cliente::create([
            'persona_id' => $persona->id,
            'fecha_ingreso'=>$fechaActual,
        ]);
        // CALCULAR FECHA DE VENCIMIENTO
        $plan = Plan::find($request->plan_id);
        $fechaVencimiento = date('Y-m-d',strtotime($fechaActual."+ $plan->cant_meses month" ));
        Plan_Cliente::create([
            'cliente_id'=>$cliente->id,
            'plan_id'=>$request->plan_id,
            'fecha_inicio'=>$fechaActual,
            'fecha_fin'=>$fechaVencimiento,
        ]);
        return redirect()->route('clientes.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('empleados.show', [
            'empleado' => Empleado::find($id),
            'turnos' => Turno::all(),
        ]);
    }
    
    public function ultimoPlan(Request $request)
    {
        $ultimoPlan = Plan_Cliente::join('planes','planes.id','=','planes_cliente.plan_id')->select('planes_cliente.plan_id','planes.precio')->where('cliente_id','=',$request->id_cliente)->orderBy('fecha_fin','DESC')->limit('1')->get();
        return $ultimoPlan;
    }
    public function precio(Request $request){
        $precio = Plan::find($request->id_plan);
        return $precio;
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
        $empleado = Empleado::find($id);
        Persona::find($empleado->persona_id)->update([
            'nombre' => $request->nombre,
            'apellido'=>$request->apellido,
            'dni'=>$request->dni
        ]);
        return redirect()->route('empleados.index');
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
