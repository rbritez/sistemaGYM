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
    <input type="datetime" name="fecha_revision" class="form-control" placeholder=""  required>
    </div>
    <div class="form-group">
      <label>Peso</label>
      <input type="number" name="peso" class="form-control" placeholder="" required>
    </div>
    <div class="form-group">
        <label>Talla</label>
        <input type="text" name="talla" class="form-control" placeholder="" required>
      </div>
    <div class="form-group">
      <label>Indice m/corporal</label>
      <select name="estado_nutricional_id" class="form-control">
        @foreach($estadoNutricional as $estado)
            <option value={{ $estado->id }}>{{ $estado->descripcion }}</option>
        @endforeach      
      </select>
    </div>
    <hr>
    <button type="submit" class="btn btn-success btn-block">Guardar</button>
  </form>
<hr>
</div>
@endsection
