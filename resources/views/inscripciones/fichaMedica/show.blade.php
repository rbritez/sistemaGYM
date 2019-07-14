@extends('layout')

@section('title', 'Inscripcion - ')

@section('content')
<h1>asdas</h1>
<hr>
<hr>
<h2>Ficha Medica</h2>
<form action="{{ route('pagos.store') }}" method="post">
  @csrf
  <input type="hidden" name="inscripcion_id" value="{{ $inscripcion->id }}">
  <input type="hidden" name="inscripcion_redirect" value="true">
  <div class="row align-items-end">
    <div class="col-lg">
      <div class="form-group">
        <label>Nuevo Control</label>
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text">$</span>
          </div>
          <input type="number" class="form-control" value="{{ $inscripcion->plan->precio }}" disabled>
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
      <th>Plan</th>
      <th>Monto</th>
      <th>Fecha</th>
      <th>Empleado</th>
    </tr>
  </thead>
  <tbody>
   
  </tbody>
</table>
<hr>
@endsection