@extends('layout')

@section('title', 'Agregar Control')

@section('content')
<h1>Agregar Revision</h1>
<hr>
<div class="col-sm-4">
  <form action="{{ route('fichamedica.store') }}" method="POST">
    @csrf
    <div class="form-group">
      <label>Fecha</label>
    <input type="text" name="fecha_revision" class="form-control" placeholder="" value="{{ date("m-d-Y") }}" disabled required>
    </div>
    <div class="form-group">
      <label>Peso</label>
      <input type="text" name="dni" class="form-control" placeholder="" required>
    </div>
    <div class="form-group">
        <label>Talla</label>
        <input type="text" name="dni" class="form-control" placeholder="" required>
      </div>
    <div class="form-group">
      <label>Estado Nutricional</label>
      <select name="turno_id" class="form-control">
          <option value=""></option>
      </select>
    </div>
    <hr>
    <button type="submit" class="btn btn-success btn-block">Guardar</button>
  </form>
</div>
@endsection