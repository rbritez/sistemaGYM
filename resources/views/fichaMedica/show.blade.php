@extends('layout')

@section('title', 'Inscripcion - '.$inscripcion->cliente->persona->apellido_nombre)

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
      <th>Estado Nutricional</th>
      <th>Peso</th>
      <th>Altura</th>
      <th>talla</th>
    </tr>
  </thead>
  <tbody>
  @foreach($inscripcion->cliente->pagos as $pago)
      <tr>
        <td>13-09-2017</td>
        <td>Bueno</td>
        <td>80</td>
        <td>1.80</td>
        <td>65</td>
      </tr>
    @endforeach
  </tbody>
</table>
<hr>
@endsection