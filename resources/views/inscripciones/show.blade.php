@extends('layout')

@section('title', 'Inscripcion - '.$inscripcion->cliente->persona->apellido_nombre)

@section('content')
<h1>{{ $inscripcion->cliente->persona->apellido}} {{$inscripcion->cliente->persona->nombre }}</h1>
<hr>
<form action="{{ route('inscripciones.update', $inscripcion->id) }}" method="POST" id="actualizar">
  @csrf
  @method('PUT')
    <div class="row">
      <div class="col-sm-12"><h3>Datos del Cliente</h3></div>

        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
            <div class="form-group">
              <label>Apellido</label>
              <input type="text" name="apellido" class="form-control" value="{{$inscripcion->cliente->persona->apellido}}" required>
            </div>
          </div>
          <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
            <div class="form-group">
              <label>Nombre</label>
              <input type="text" name="nombre" class="form-control" value="{{$inscripcion->cliente->persona->nombre}}" required>
            </div>
          </div>
          <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
            <div class="form-group">
              <label>Fecha de Cumpleaños</label>
              <input type="date" name="fecha_nac" class="form-control" value="{{$inscripcion->cliente->persona->fecha_nac}}" required>
            </div>
          </div>
          <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
              <div class="form-group">
                <label>N° Documento</label>
                <input type="text" name="dni" placeholder="11.222.333" class="form-control"  value="{{$inscripcion->cliente->persona->dni}}" placeholder="">
              </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
              <div class="form-group">
                <label>Celular</label>
                <input type="text" name="celular" class="form-control"  value="{{$inscripcion->cliente->persona->celular}}" required>
              </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                <div class="form-group">
                  <label>Email</label>
                  <input type="email" name="email" class="form-control"  value="{{$inscripcion->cliente->persona->email}}" placeholder="ejemplo@ejemplo.com">
                </div>
              </div>
              <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                <div class="form-group">
                  <label>Sexo</label>
                  <select name="sexo" id="sexo" class="form-control">
                    @if ($inscripcion->cliente->persona->sexo == 'h')
                    <option value="h" selected>Hombre</option>    
                    <option value="m">Mujer</option>
                    @else
                    <option value="h">Hombre</option>    
                    <option value="m" selected>Mujer</option>
                    @endif
                  </select>
                </div>
              </div>
              <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                <div class="form-group">
                  <label>Barrio</label>
                  <input type="text" name="barrio" class="form-control" placeholder="San Martin"  value="{{$inscripcion->cliente->persona->barrio}}">
                </div>
              </div>
                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                  <div class="form-group">
                    <label>Calle</label>
                    <input type="text" name="calle" class="form-control" placeholder="España"  value="{{$inscripcion->cliente->persona->calle}}">
                  </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                    <div class="form-group">
                      <label>Altura</label>
                      <input type="text" name="altura" class="form-control"  value="{{$inscripcion->cliente->persona->altura}}" placeholder="1532">
                    </div>
                  </div>
                  <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                    <div class="form-group">
                      <label>Nro Dpto</label>
                      <input type="text" name="nro_dpto" class="form-control" placeholder="12A"  value="{{$inscripcion->cliente->persona->nro_dpto}}">
                    </div>
                  </div>
                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                      <div class="form-group">
                        <label>Nro Piso</label>
                        <input type="text" name="nro_piso" class="form-control" placeholder="2" value="{{$inscripcion->cliente->persona->nro_piso}}">
                      </div>
                    </div>
  
        <div class="col-sm-12"><h3>Seleccione Rutina y Plan</h3></div>
        <div class="col-lg-6 col-md-6 col-sm-6">
          <div class="form-group">
            <label>Rutina</label>
            <select name="rutina_id" class="form-control" value="{{$inscripcion->rutina_id}}">
              @foreach($rutinas as $rutina)
                @if ($inscripcion->rutina_id == $rutina->id)
                  <option value="{{$rutina->id}}" selected>{{$rutina->descripcion}}--{{$rutina->dificultad}}</option>
                @else
                <option value="{{ $rutina->id }}">{{ $rutina->descripcion }}--{{$rutina->dificultad}}</option> 
                @endif
            
              @endforeach
            </select>
          </div> 
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6">
          <div class="form-group">
            <label>Plan</label>
          <select name="plan_id" id="plan_id" class="form-control" onclick="cargarmonto()">
            <option value="">Seleccionar</option>
              @foreach($planes as $plan)
                @if ($inscripcion->plan_id == $plan->id)
                  <option value="{{$plan->id}}" selected>{{$plan->descripcion}} - ${{$plan->precio}}</option>
                @else
                  <option value="{{ $plan->id }}">{{ $plan->descripcion }} - ${{ $plan->precio }}</option>
                @endif
              @endforeach
            </select>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="form-group">
            <label>Saldo</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <button class="btn btn-success" type="button" id="textoSaldo" disabled>DISPONIBLE: $</button>
                  {{-- <button class="btn btn-info" type="button" id="textoSaldo" disabled>DEBE: $</button> --}}
                </div>
                  @if (isset($saldo[0]) && !empty($saldo[0]))
                    <input type="number" name="monto_saldo" id="monto_saldo" class="form-control" min="0"  max="{{$saldo[0]['monto_saldo']}}" value="{{$saldo[0]['monto_saldo']}}" readonly> 
                    <input type="hidden" id="monto_saldo_inicial" class="form-control" value="{{$saldo[0]['monto_saldo']}}">    
                  @else
              <input type="number" name="monto_saldo" id="monto_saldo" class="form-control" value="0" readonly>
                  @endif   
              </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="form-group">
            <label id="labelsaldoS">¿Usar Saldo?   <input class="checkbox-inline" style="position:relative;top:4px;width:18px; height:18px;" type="checkbox" name="usarSaldo" id="usarSaldo" readonly> </label>
            <label id="labelsaldoH" style="display:none">¡Tu saldo para tu Proximo Plan ha Aumentado!</label> 
              <div class="input-group">
                  <div class="input-group-prepend">
                    <button class="btn btn-success" " type="button" disabled>USAR: $</button>
                  </div>
                  <input type="number" id="saldoUsado" name="saldoUsado" class="form-control" min="0" value="0" readonly>
                  <input type="hidden" name="" id="precio_Primer_plan">
                  <input type="hidden" name="montoPlan" id="precio_plan">
                  <input type="hidden" name="cant_meses" id="cant_meses" value="">
                  <input type="hidden" name="planAnterior" id="planAnterior" value="">
                </div>
          </div>
        </div>  
        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="form-group">
            <label id="labelsaldoS">&nbsp; </label>
              <div class="input-group">
                  <div class="input-group-prepend">
                    <button class="btn btn-info" type="button" disabled>TOTAL: $</button>
                  </div>
                  <input type="number" name="monto" id="monto" class="form-control" value="">
                </div>
          </div>
        </div>  
        {{-- <div class="form-group">
          <label>Empleado</label>
          <select name="empleado_id" class="form-control">
            @foreach($empleados as $empleado)
              <option value="{{ $empleado->id }}">{{ $empleado->persona->apellido_nombre }}</option>
            @endforeach
          </select>
        </div> --}}
        <div class="col-sm-6">
          <button type="button" class="btn btn-danger btn-block"  onclick="listener()">Volver</button>
        </div>
        <div class="col-sm-6">
        <button type="submit" class="btn btn-success btn-block">Guardar</button>
      </div>
    </div>
      <hr>
  </form>
   {{-- -------------------------------------- modale mensaje ------------------------------------------------------------------- --}}
   <button id="mensajebtn" data-toggle="modal" data-target="#mensaje" style="background-color:white;border:none"></button>
   <div class="modal fade" id="mensaje"> <!-- modallllllllll EDITARRR-->
     <div class="modal-dialog modal-sm">
         <div class="modal-content"> <!-- div content --> 
             <div class="modal-body">
                 <div class="row">
                     <div class="col-sm-12" style="text-align:center">
                         Se Cambio de Plan con Exito!! <br>
                         ¿Imprimir la Nota de Credito?
                     </div>
                 </div>
             </div>
             <div class="modal-footer ">
               <div class="col-sm-9">
               <button type="button" class="btn btn-danger float-left" data-dismiss="modal" onclick="salir()">No Imprimir</button>
               </div>
             <a href="{{route('inscripciones.notacreditoPDF', $pagoid)}}" target="_blank"><button type="submit" class="btn btn-primary float-right" onclick="salir()">Imprimir</button></a>
             </div>
         </div><!-- div content -->
     </div><!-- /.modal-dialog -->
   </div><!-- /.modal -->
  @endsection
  @section('js')
    <script>
      function init(){
        primerPlan();
        cargarmonto();
        $("#usarSaldo").change(cambiarmonto);
        $("#monto_saldo").change(cambiarvalor);
        // $("#monto").change(nuevototal);
      }
      function salir(){
        window.location.href ="{{route('inscripciones.index')}}";
      }
      function validarmensaje(){
        var mensaje = {{$mensaje}};
        console.log(mensaje);
        if(mensaje == 0){
            
        }else{
            $("#mensajebtn").trigger('click');
        }
    }
    validarmensaje();
      function listener(){
        window.history.back();
      }
      function cambiarvalor(){
        cambiarmonto();
      }
      function primerPlan(){
      var idplan =  $("#plan_id").val();
        $.post("{{route('clientes.precio')}}",{
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        "_token":$("meta[name='csrf-token']").attr("content"),
        'id_plan': idplan},
        function(rr){
          $("#precio_Primer_plan").val(rr.precio);
          $("#planAnterior").val(idplan);
      })
      }
      function cambiarmonto(){
        var check = $("#usarSaldo"); //input check
        var saldo = parseFloat($("#monto_saldo").val()); //monto del saldo
        var saldoInicial =parseFloat($("#monto_saldo_inicial").val()); //saldo inicial
        var montoPlan = parseFloat($("#precio_plan").val());
        var montoPrimerPlan = parseFloat($("#precio_Primer_plan").val());
        var nuevomontoPlan = montoPlan-montoPrimerPlan;
        if (check.prop('checked')) {
          var montoaPagar = parseFloat($("#monto").val());
          if(saldo >= montoaPagar){
            $("#saldoUsado").prop('max',montoaPagar);
          }else{
            $("#saldoUsado").prop('max',saldo);
          }
          $("#saldoUsado").removeAttr('readonly');
          

        } else {
          var montoaPagar = parseFloat($("#monto").val());
          $("#monto").val(montoaPagar);
          $("#saldoUsado").val(0).attr("readonly",true);

        }
      }
      
      function cargarmonto(){
        var montoPlanAnterior =parseFloat($("#precio_Primer_plan").val());
        var montosaldoinicial = parseFloat($("#monto_saldo_inicial").val());
        var check = $("#usarSaldo");
      var idplan =  $("#plan_id").val();
        $.post("{{route('clientes.precio')}}",{
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        "_token":$("meta[name='csrf-token']").attr("content"),
        'id_plan': idplan},
        function(r){
          $("#monto").val();
          $("#cant_meses").val();
            if(montoPlanAnterior < r.precio){
              $("#labelsaldoS").show();
              $("#labelsaldoH").hide();
              $("#monto_saldo").val(montosaldoinicial);
              $("#monto").val(r.precio - montoPlanAnterior);
              if (check.prop('checked')) { cambiarmonto()}
            }else if(montoPlanAnterior > r.precio){
              $("#labelsaldoS").hide();
              $("#labelsaldoH").html("<div style='font-size:11px;'>Tu saldo Aumento para tu Proximo Plan<div>");
              $("#labelsaldoH").show();
              $("#monto").val('0');
              nuevosaldo = montosaldoinicial+ (montoPlanAnterior - r.precio);
              $("#monto_saldo").val(nuevosaldo);

            }else{
              $("#monto_saldo").val(montosaldoinicial);
              $("#labelsaldoS").hide();
              $("#labelsaldoH").text("No puedes usar tu Saldo");
              $("#labelsaldoH").show();
              $("#monto").val(parseFloat(r.precio));
            }          
            $("#precio_plan").val(parseFloat(r.precio));
            $("#cant_meses").val(r.cant_meses);
      });
      }

      init();
    </script>
  @endsection