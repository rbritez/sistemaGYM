@extends('layout')

@section('title', 'Inscripciones')

@section('content')
<h1>Inscripciones</h1>
<hr>
<div>
  <a href="{{ route('inscripciones.create') }}" class="btn btn-primary">Nueva inscripción</a>
</div>
<br>
<table class="table">
  <thead>
    <tr>
      <th>Apellido y Nombre</th>
      <th>Plan</th>
      <th>Rutina</th>
      <th>Ficha Medica</th>
      <th>Acciones</th>
    </tr>
  </thead>
  <tbody>
    @foreach($inscripciones as $ins)
      <tr>
        <td>{{ $ins->cliente->persona->apellido_nombre }}</td>
        <td>{{ $ins->plan->descripcion }} - ${{ $ins->plan->precio }}</td>
        <td>{{ $ins->rutina->descripcion }}</td>
        <td><button  class="btn btn-success" ><a  href="{{ route('inscripciones.show', $ins->id) }}"> <font size="2" color = "black">Ver Ficha </font></a></button></td>
        <td>
          <a href="{{ route('inscripciones.show', $ins->id) }}">Ver más</a>
        </td>
      </tr>
    @endforeach
  </tbody>
</table>
@endsection