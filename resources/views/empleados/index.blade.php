@extends('layout')

@section('title', 'Empleados')

@section('content')
<h1>Empleados</h1>
<hr>
<div>
  <a href="{{ route('empleados.create') }}" class="btn btn-primary">Crear</a>
  <a href="{{ route('turnos.index') }}" class="btn btn-primary">Ver turnos</a>
</div>
<br>
<table class="table">
  <thead>
    <tr>
      <th>Apellido y Nombre</th>
      <th>DNI</th>
      <th>Domicilio</th>
      <th>Turno</th>
      <th>Acciones</th>
    </tr>
  </thead>
  <tbody>
    @foreach($empleados as $empleado)
      <tr>
        <td>{{ $empleado->persona->apellido_nombre }}</td>
        <td>{{ $empleado->persona->dni }}</td>
        <td>{{ $empleado->persona->domicilio }}</td>
        <td>{{ $empleado->turno->descripcion }}</td>
        <td>
          <a href="{{ route('empleados.show', $empleado->id) }}">Ver más</a>
        </td>
      </tr>
    @endforeach
  </tbody>
</table>
@endsection