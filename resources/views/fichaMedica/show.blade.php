@extends('layout')

@section('title', 'Inscripcion - '.$inscripcion->cliente->persona->apellido_nombre)

@section('content')
<h1>{{ $inscripcion->cliente->persona->apellido_nombre }}</h1>
<hr>

<h2>Ficha Medica</h2>
<form action="{{ route('pagos.store') }}" method="post">
  @csrf
  <input type="hidden" name="inscripcion_id" value="">
  <input type="hidden" name="inscripcion_redirect" value="true">
  <div class="row align-items-end">
    <div class="col-lg">
      <div class="form-group">
        <label>Nuevo Control</label>
        <div class="input-group col-md-6">
          <div class="input-group-prepend">
            <span class="input-group-text" value="{{ $inscripcion->cliente->persona->id }}" >Peso</span>
          </div>
          <input type="number" class="form-control" value="">
        </div>
        
      </div>
    </div>
    <div class="col-lg">
      <div class="form-group">
        <button type="submit" class="btn btn-primary btn-block">Agregar Control</button>
      </div>
    </div>
  </div>
</form>
<table class="table">
  <thead>
    <tr>
      <th>Fecha</th>
      <th>Estado Fisico</th>
      <th>Peso</th>
    </tr>
  </thead>
  <tbody>
  @foreach($inscripcion->cliente->pagos as $pago)
      <tr>
        <td>13-09-2017</td>
        <td>Bueno</td>
        <td>80</td>
      </tr>
    @endforeach
  </tbody>
</table>
<hr>
@endsection