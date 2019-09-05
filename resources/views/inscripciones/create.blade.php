@extends('layout')

@section('title', 'Inscripciones')

@section('content')
<h1>Nueva Inscripción</h1>
<hr>
<form action="{{ route('inscripciones.store') }}" method="POST">
  @csrf
  <div class="row">
    <div class="col-sm-4">
      <div class="form-group">
        <label>Apellido y Nombre</label>
        <input type="text" name="apellido_nombre" class="form-control" placeholder="Perez, Juan" required>
      </div>
      <div class="form-group">
        <label>DNI</label>
        <input type="text" name="dni" class="form-control" placeholder="45678123" required>
      </div>
      <div class="form-group">
        <label>Calle</label>
        <input name="calle" class="form-control" required>
      </div>
      <div class="form-group">
            <label>Numero</label>
            <input name="numero" class="form-control" required>
     </div>
    <div class="form-group">
        <label>Localidad</label>
        <input name="localidad" class="form-control" required>
        </div>
    </div>
    <div class="col-sm-4">
      <div class="form-group">
        <label>Plan</label>
        <select name="plan_id" class="form-control">
          @foreach($planes as $plan)
            <option value="{{ $plan->id }}">{{ $plan->descripcion }} - ${{ $plan->precio }}</option>
          @endforeach
        </select>
      </div>
      <div class="form-group">
        <label>Rutina</label>
        <select name="rutina_id" class="form-control">
          @foreach($rutinas as $rutina)
            <option value="{{ $rutina->id }}">{{ $rutina->descripcion }}</option>
          @endforeach
        </select>
      </div>
      <div class="form-group">
        <label>Empleado</label>
        <select name="empleado_id" class="form-control">
          @foreach($empleados as $empleado)
            <option value="{{ $empleado->id }}">{{ $empleado->persona->apellido_nombre }}</option>
          @endforeach
        </select>
      </div>
    </div>
    <div class="col-sm">
      <button type="submit" class="btn btn-success btn-block">Guardar</button>
    </div>
  </div>
  <hr>
</form>
@endsection
