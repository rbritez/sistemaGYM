@extends('layout')

@section('title', 'Productos - '.$inscripcion->cliente->persona->apellido_nombre)

@section('content')
<h1>{{ $inscripcion->cliente->persona->apellido_nombre }}</h1>
<hr>

<h2>Ficha Medica</h2>
<br>
<a  class="btn btn-primary btn-block col-sm-2" href="{{ route('fichamedica.create')}}">Agregar Revisión</a>
<br>
<table class="table">
  <thead>
    <tr>
      <th>Fecha</th>
      <th>Indice m/Corporal</th>
      <th>Peso</th>
      <th>Altura</th>
      <th>talla</th>
    </tr>
  </thead>
  <tbody>
  @foreach($fichamedica as $ficha)
      <tr>
      <td>{{ $ficha->fecha}}</td>
      <td>{{ $ficha->estado_nutricional_id }}</td>
      <td>{{ $ficha->peso }}</td>
        <td>1.80</td>
        <td>65</td>
      </tr>
    @endforeach
  </tbody>
</table>
<hr>
@endsection
