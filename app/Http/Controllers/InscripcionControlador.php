<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Inscripcion;
use App\Plan;
use App\Rutina;
use App\Empleado;
use App\Persona;
use App\Cliente;
use App\Pago;
use App\Plan_Cliente;
use App\Rutina_Cliente;
use App\Saldo;
use App\NotaCredito;
use PDF;

class InscripcionControlador extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $mensaje = 0;
        $inscripcionID = 0;
        if ($request->mensaje) {
            $mensaje = $request->mensaje;
            $inscripcionID = $request->ID;
        }else{
            $mensaje = 0;
            $inscripcionID = 0;
        }

        return view('inscripciones.index', ['inscripciones' => Inscripcion::all(),'rutinas'=> Rutina::all(),'mensaje'=>$mensaje,'inscripcionID'=>$inscripcionID]);
    }
 public function traerinscripcion(Request $request){
    $inscripcion = Inscripcion::find($request->id);
    return $inscripcion;
    
 }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('inscripciones.create', [
            'planes' => Plan::all(),
            'rutinas' => Rutina::all(),
            'empleados' => Empleado::all()
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
        $mensaje = 1;

        $hoy = date('Y-m-d');
        $fechaActual = date("Y-m-d");
        $persona = Persona::create([
            'apellido' => $request->input('apellido'),
            'nombre' => $request->input('nombre'),
            'dni'=>$request->dni,
            'fecha_nac' => $request->input('fecha_nac'),
            'celular' => $request->input('celular'),
            'email'=>$request->email,
            'sexo'=>$request->sexo,
            'barrio'=>$request->barrio,
            'calle'=>$request->calle,
            'altura'=>$request->altura,
            'nro_dpto'=>$request->nro_dpto,
            'nro_piso'=>$request->nro_piso,
        ]);
        $cliente = Cliente::create([
            'persona_id' => $persona->id,
            'fecha_ingreso'=>$hoy]);
        $inscripcion = Inscripcion::create([
            'cliente_id' => $cliente->id,
            'plan_id' => $request->input('plan_id'),
            'rutina_id' => $request->input('rutina_id'),
            'empleado_id' => '5',
        ]);
        $pago = Pago::create([
            'cliente_id'=>$cliente->id,
            'empleado_id'=>'5',
            'plan_id'=>$request->plan_id,
            'monto'=>$request->input('monto'),
            'fecha'=>$hoy,
        ]);

        // $fechaVencimiento = date('Y-m-d',strtotime($fechaActual."+ $request->cant_meses month" ));
        // Plan_Cliente::create([
        //     'cliente_id'=>$cliente->id,
        //     'plan_id'=>$request->plan_id,
        //     'fecha_inicio'=>$fechaActual,
        //     'fecha_fin'=>$fechaVencimiento,
        // ]);
        return redirect()->route('inscripciones.index',['ID'=>$inscripcion->id, 'mensaje'=>$mensaje]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $mensaje="0";
        $pagoid="0";
        if($request->mensaje){
            $mensaje = $request->mensaje;
            $pagoid = $request->pagoid;
        }
        
        $inscripcion = Inscripcion::find($id);
        return view('inscripciones.show', [
            'inscripcion' => $inscripcion,
            'planes' => Plan::all(),
            'rutinas' => Rutina::all(),
            'empleados' => Empleado::all(),
            'saldo'=>Saldo::where('cliente_id',$inscripcion->cliente_id)->get(),
            'pagoid'=>$pagoid,
            'mensaje'=>$mensaje,
        ]);
    }
    public function reciboPDF($id){
        $inscripcion = Inscripcion::find($id);
        $pagoCliente = Pago::where('cliente_id',$inscripcion->cliente_id)->orderBy('id','desc')->take(1)->get();
        $notaCredito= NotaCredito::where('pago_id',$pagoCliente[0]['id'])->get();
            if( isset($notaCredito) && !empty($notaCredito->all() )){
                return redirect()->route('inscripciones.notacreditoPDF',$pagoCliente[0]['id']);
            }

        $ultimoPlan= Plan_Cliente::whereRaw('cliente_id = '.$inscripcion->cliente_id.' AND plan_id = '.$inscripcion->plan_id)->orderBy('fecha_fin','desc')->take(1)->get();

        $monto = Pago::whereRaw('cliente_id = '.$inscripcion->cliente_id.' AND plan_id = '. $inscripcion->plan_id .' AND DATE(fecha) = "'.$ultimoPlan['0']['fecha_inicio'].'"')->get();
        $pdf = PDF::loadView('inscripciones.reciboPDF', ['inscripcion'=>$inscripcion,'ultimoPlan'=>$ultimoPlan,'monto'=>$monto]);
        return $pdf->stream('recibo.pdf');
    }
    public function notacreditoPDF($id){
        $pago = Pago::find($id);
        $notacredito = NotaCredito::where('pago_id',$id)->get();
        $planACT = Plan::find($pago->plan_id);
        $saldo = Saldo::where('cliente_id',$pago->cliente_id)->get();
        $planClienteANT = Plan_Cliente::find($notacredito[0]['planlienteANT_id']);
        // $planANT = 
        $pdf = PDF::loadView('inscripciones.notacreditoPDF', ['pago'=>$pago,'notaCredito'=>$notacredito[0],'saldo'=>$saldo[0],'planActual'=>$planACT,'planclienteANT'=>$planClienteANT]);
        return $pdf->stream('notaCredito.pdf');
    }
    public function updateRutina(Request $request,$id){

        $hoy = date('Y-m-d');
        $cambio = Inscripcion::find($request->id_inscripcion);
        if($cambio->rutina_id == $request->rutina_id){

        }else{
            Rutina_cliente::create([
                'cliente_id'=> $request->id_cliente,
                'rutina_id' => $request->input('rutina_id'),
                'fecha_cambio' => $hoy,
            ]); 
            $cambio=Inscripcion::find($request->id_inscripcion)->update([
                'rutina_id'=> $request->rutina_id,
            ]);
        }
        return redirect()->route('inscripciones.index');
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
        

        $mensaje=1;
        $fechaActual = date("Y-m-d");
        $inscripcion = Inscripcion::find($id);


        if($inscripcion->plan_id == $request->plan_id){
            //MODIFICAMOS LOS DATOS DEL CLIENTE
            $inscripcion->cliente->persona->update([
                'apellido' => $request->input('apellido'),
                'nombre' => $request->input('nombre'),
                'dni'=>$request->dni,
                'fecha_nac' => $request->input('fecha_nac'),
                'celular' => $request->input('celular'),
                'email'=>$request->email,
                'sexo'=>$request->sexo,
                'barrio'=>$request->barrio,
                'calle'=>$request->calle,
                'altura'=>$request->altura,
                'nro_dpto'=>$request->nro_dpto,
                'nro_piso'=>$request->nro_piso,
            ]);
            //MODIFICAMOS LA RUTINA
            if($inscripcion->rutina_id == $request->rutina_id){

            }else{
                Rutina_cliente::create([
                    'cliente_id'=> $inscripcion->id_cliente,
                    'rutina_id' => $request->input('rutina_id'),
                    'fecha_cambio' => $fechaActual,
                ]); 
                $inscripcion->update([
                    // 'plan_id' => $request->input('plan_id'),
                    'rutina_id' => $request->input('rutina_id'),
                ]);
            }
            return redirect()->route('inscripciones.index');
        }else{
                //MODIFICAMOS EL SALDO
                if($request->usarSaldo =="on"){
                    // dd($request->usarSaldo);
                    $saldo = Saldo::where('cliente_id',$inscripcion->cliente_id)->get();
                    $nuevoSaldo = $saldo[0]['monto_saldo'] - $request->monto_saldo;
                    
                    $newsaldo = Saldo::find($saldo[0]['id'])->update([
                        'monto_saldo'=>$nuevoSaldo,
                    ]);
                }
            //anulamos el pago
            $pagoANT = Pago::where([['cliente_id',$inscripcion->cliente_id],['plan_id',$inscripcion->plan_id]])->orderBy('id','desc')->take(1)->get();
            // $pagoAnular = Pago::find($pagoANT[0]['id'])->update([
            //     'estado'=> '0',
            // ]);
            //anulamos el plan
            $planANT = Plan_Cliente::where([['cliente_id',$inscripcion->cliente_id],['plan_id',$inscripcion->plan_id]])->orderBy('id','desc')->take(1)->get();
            $pagoAnular = Plan_Cliente::find($planANT[0]['id'])->update([
                'estado'=> '0',
            ]);
            //EDITAMOS LOS DATOS DEL CLIENTE
            $inscripcion->cliente->persona->update([
                'apellido' => $request->input('apellido'),
                'nombre' => $request->input('nombre'),
                'fecha_nac' => $request->input('fecha_nac'),
                'celular' => $request->input('celular'),
                //'email'=>$request->email,
                // 'dni'=>$request->dni,
                // 'sexo'=>$request->sexo,
                // 'barrio'=>$request->barrio,
                // 'calle'=>$request->calle,
                // 'altura'=>$request->altura,
                // 'nro_dpto'=>$request->nro_dpto,
                // 'nro_piso'=>$request->nro_piso,
            ]);
            //creamos un nuevo pago,
            $pago = Pago::create([
                'cliente_id'=>$inscripcion->cliente_id,
                'empleado_id'=>'5',
                'plan_id'=>$request->plan_id,
                'monto'=>$request->input('monto'),
                'fecha'=>$fechaActual,
            ]);
            //CREAMOS LA NOTA DE CREDTIO
            $planACT = Plan_Cliente::where([['cliente_id',$inscripcion->cliente_id],['plan_id',$inscripcion->plan_id]])->orderBy('id','desc')->take(1)->get();
            $montoActual = Plan::find($request->plan_id);
            $notaCredito = NotaCredito::create([
                'pago_id'=>$pago->id,
                'planclienteANT_id'=>$planANT[0]['id'],
                'monto_pANT'=>$pagoANT[0]['monto'],
                'planACT_id'=>$planACT[0]['id'],
                'monto_pACT'=>$montoActual->precio,
                'monto'=>$request->monto,
                'fecha'=>$fechaActual,
            ]);
            //EDITAMOS LA RUTINA DEL PLAN00
            if($inscripcion->rutina_id == $request->rutina_id){

            }else{
                Rutina_cliente::create([
                    'cliente_id'=> $inscripcion->id_cliente,
                    'rutina_id' => $request->input('rutina_id'),
                    'fecha_cambio' => $fechaActual,
                ]); 
                $inscripcion->update([
                    // 'plan_id' => $request->input('plan_id'),
                    'rutina_id' => $request->input('rutina_id'),
                ]);
            }

            return redirect()->route('inscripciones.show', ['id'=>$inscripcion->id,'pagoid'=>$pago->id, 'mensaje'=>$mensaje]);
        }

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
