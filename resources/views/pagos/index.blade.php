@extends('layout')

@section('title', 'Pagos')

@section('content')
<h1>Pagos</h1>
<hr>
<form action="{{ route('pagos.store') }}" method="post">
  @csrf
  <div class="form-group">
    <div class="row">
      <div class="col-lg">
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text">Empleado</span>
          </div>
          <select class="form-control" name="empleado_id">
            @foreach($empleados as $empleado)
              <option value="{{ $empleado->id }}">{{ $empleado->persona->apellido_nombre }}</option>
            @endforeach
          </select>
        </div>
      </div>
      <div class="col-lg-8">
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text">Cobrar a</span>
          </div>
          <select class="form-control" name="inscripcion_id">
            @foreach($inscripciones as $inscripcion)
              <option value="{{ $inscripcion->id }}">{{ $inscripcion->cliente->persona->apellido_nombre }} - {{ $inscripcion->plan->descripcion }} (${{ $inscripcion->plan->precio }})</option>
            @endforeach
          </select>
          <div class="input-group-append">
            <button class="btn btn-primary" type="submit">Cobrar</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</form>
<table class="table">
  <thead>
    <tr>
      <th>#</th>
      <th>Cliente</th>
      <th>Plan</th>
      <th>Monto</th>
      <th>Fecha</th>
      <th>Empleado</th>
    </tr>
  </thead>
  <tbody>
    @foreach($pagos as $pago)
      <tr>
        <td>{{ $pago->id }}</td>
        <td><a href="{{ route('inscripciones.show', $pago->cliente->inscripcion->id) }}">{{ $pago->cliente->persona->apellido_nombre }}</a></td>
        <td>{{ $pago->plan->descripcion }}</td>
        <td>${{ $pago->monto }}</td>
        <td>{{ $pago->fecha }}</td>
        <td>{{ $pago->empleado->persona->apellido_nombre }}</td>
      </tr>
    @endforeach
  </tbody>
</table>
@endsection