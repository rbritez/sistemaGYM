@extends('layout')

@section('title', 'Crear empleado')

@section('content')
<h1>Crear empleado</h1>
<hr>
<div class="col-sm-4">
  <form action="{{ route('empleados.store') }}" method="POST">
    @csrf
    <div class="form-group">
      <label>Apellido y Nombre</label>
      <input type="text" name="apellido_nombre" class="form-control" placeholder="Perez, Juan" required>
    </div>
    <div class="form-group">
      <label>DNI</label>
      <input type="text" name="dni" class="form-control" placeholder="45678123" required>
    </div>
    <div class="form-group">
      <label>Domicilio</label>
      <textarea name="domicilio" class="form-control" required></textarea>
    </div>
    <div class="form-group">
      <label>Turno</label>
      <select name="turno_id" class="form-control">
        @foreach($turnos as $turno)
          <?php var_dump($turnos)?>
        @endforeach
      </select>
    </div>
    <hr>
    <button type="submit" class="btn btn-success btn-block">Guardar</button>
  </form>
</div>
@endsection