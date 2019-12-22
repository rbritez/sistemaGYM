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
        <input type="text" name="apellido" class="form-control" placeholder="Perez" value="{{$inscripcion->cliente->persona->apellido}}" required>
        </div>
      </div>
      <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
        <div class="form-group">
          <label>Nombre</label>
          <input type="text" name="nombre" class="form-control" placeholder="Juan" value="{{$inscripcion->cliente->persona->nombre}}" required>
        </div>
      </div>
      <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
        <div class="form-group">
          <label>Fecha de Cumpleaños</label>
          <input type="date" name="fecha_nac" class="form-control" placeholder="" value="{{$inscripcion->cliente->persona->fecha_nac}}" required>
        </div>
      </div>
        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
          <div class="form-group">
            <label>Celular</label>
            <input type="text" name="celular" class="form-control" placeholder="3704000000" value="{{$inscripcion->cliente->persona->celular}}" required>
          </div>
        </div>
  
        <div class="col-sm-12"><h3>Seleccione Rutina y Plan</h3></div>
        <div class="col-lg-3 col-md-6 col-sm-6">
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
        <div class="col-lg-3 col-md-6 col-sm-6">
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
            <label id="labelsaldoS">¿Usar Saldo?   <input class="checkbox-inline" style="position:relative;top:4px;width:18px; height:18px;" type="checkbox" name="usarSaldo" id="usarSaldo"> </label>
            <label id="labelsaldoH" style="display:none">¡Tu saldo para tu Proximo Plan ha Aumentado!</label> 
              <div class="input-group">
                  <div class="input-group-prepend">
                    <button class="btn btn-info" type="button" disabled>TOTAL: $</button>
                  </div>
                  <input type="number" name="monto" id="monto" class="form-control" value="">
                  <input type="hidden" name="" id="precio_Primer_plan">
                  <input type="hidden" name="" id="precio_plan">
                  <input type="hidden" name="cant_meses" id="cant_meses" value="">
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
      };
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
      })
      }
      function cambiarmonto(){
        var check = $("#usarSaldo");
        var saldo = parseFloat($("#monto_saldo").val());
        var saldoInicial =parseFloat($("#monto_saldo_inicial").val());
        var montoPlan = parseFloat($("#precio_plan").val());
        var montoPrimerPlan = parseFloat($("#precio_Primer_plan").val());
        var nuevomontoPlan = montoPlan-montoPrimerPlan;
        if (check.prop('checked')) {
          $("#monto_saldo").removeAttr('readonly');
            $("#monto").val(nuevomontoPlan - saldo);
        } else {
          $("#monto").val(nuevomontoPlan);
          $("#monto_saldo").val(saldoInicial).attr("readonly",true);
        }
      }
      
      function cargarmonto(){
        var montoPlanAnterior =parseFloat($("#precio_Primer_plan").val());
        var montosaldoinicial = parseFloat($("#monto_saldo_inicial").val());
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
            }else if(montoPlanAnterior > r.precio){
              $("#labelsaldoS").hide();
              $("#labelsaldoH").html("<div style='font-size:11px;'>Tu saldo Aumento para tu Proximo Plan<div>");
              
              $("#labelsaldoH").show();
              nuevosaldo = montosaldoinicial+ (montoPlanAnterior - r.precio);
              $("#monto_saldo").val(nuevosaldo);
              $("#monto").val('0');
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