@extends('layout')

@section('title', 'Inscripciones')

@section('content')
<h1>Nueva Inscripción</h1>
<hr>
<form action="{{ route('inscripciones.store') }}" method="POST">
  @csrf
  <div class="row">
    <div class="col-sm-12"><h3>Datos del Cliente</h3></div>
    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
      <div class="form-group">
        <label>Apellido</label>
        <input type="text" name="apellido" class="form-control" placeholder="Perez" required>
      </div>
    </div>
    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
      <div class="form-group">
        <label>Nombre</label>
        <input type="text" name="nombre" class="form-control" placeholder="Juan" required>
      </div>
    </div>
    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
      <div class="form-group">
        <label>Fecha de Cumpleaños</label>
        <input type="date" name="fecha_nac" class="form-control" required>
      </div>
    </div>
    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
        <div class="form-group">
          <label>N° Documento</label>
          <input type="text" name="dni" placeholder="11.222.333" class="form-control" placeholder="">
        </div>
      </div>
      <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
        <div class="form-group">
          <label>Celular</label>
          <input type="text" name="celular" class="form-control" placeholder="3704000000" required>
        </div>
      </div>
      <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
          <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" class="form-control" placeholder="ejemplo@ejemplo.com">
          </div>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
          <div class="form-group">
            <label>Sexo</label>
            <select name="sexo" id="sexo" class="form-control" required>
              <option value="">Seleccionar...</option>
              <option value="h">Hombre</option>
              <option value="m">Mujer</option>
            </select>
          </div>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
          <div class="form-group">
            <label>Barrio</label>
            <input type="text" name="barrio" class="form-control" placeholder="San Martin" >
          </div>
        </div>
          <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
            <div class="form-group">
              <label>Calle</label>
              <input type="text" name="calle" class="form-control" placeholder="España">
            </div>
          </div>
          <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
              <div class="form-group">
                <label>Altura</label>
                <input type="text" name="altura" class="form-control" placeholder="1532">
              </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
              <div class="form-group">
                <label>Nro Dpto</label>
                <input type="text" name="nro_dpto" class="form-control" placeholder="12A">
              </div>
            </div>
              <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                <div class="form-group">
                  <label>Nro Piso</label>
                  <input type="text" name="nro_piso" class="form-control" placeholder="2">
                </div>
              </div>

      <div class="col-sm-12"><h3>Seleccione Rutina y Plan</h3></div>
      <div class="col-sm-4">
        <div class="form-group">
          <label>Rutina</label>
          <select name="rutina_id" class="form-control">
            @foreach($rutinas as $rutina)
          <option value="{{ $rutina->id }}">{{ $rutina->descripcion }}--{{$rutina->dificultad}}</option>
            @endforeach
          </select>
        </div> 
      </div>
      <div class="col-sm-4">
        <div class="form-group">
          <label>Plan</label>
        <select name="plan_id" id="plan_id" class="form-control" onclick="cargarmonto()">
          <option value="">Seleccionar</option>
            @foreach($planes as $plan)
              <option value="{{ $plan->id }}">{{ $plan->descripcion }} - ${{ $plan->precio }}</option>
            @endforeach
          </select>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="form-group">
          <label>&nbsp;</label>
            <div class="input-group">
                <div class="input-group-prepend">
                  <button class="btn btn-info" type="button" disabled>TOTAL: $</button>
                </div>
                <input type="number" name="monto" id="monto" class="form-control" value="">
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
    <div class="col-sm-12">
      <button type="submit" class="btn btn-success btn-block">Guardar</button>
    </div>
  </div>
    <hr>
</form>
@endsection
@section('js')
  <script>
    function cargarmonto(){
    var idplan =  $("#plan_id").val();
      $.post("{{route('clientes.precio')}}",{
      headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
      "_token":$("meta[name='csrf-token']").attr("content"),
      'id_plan': idplan},
      function(r){
        $("#monto").val();
        $("#cant_meses").val();
        $("#monto").val(r.precio);
        $("#cant_meses").val(r.cant_meses);
    })

    }
  </script>
@endsection
    
