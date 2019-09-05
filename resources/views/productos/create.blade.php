@extends('layout')

@section('title', 'Agregar Producto')

@section('content')
<h1>Agregar Producto</h1>
<hr>
<div class="col-sm-4">
  <form action="{{ route('productos.store') }}" method="POST">
    @csrf
    <div class="form-group">
      <label>Descripcion</label>
    <input type="text" name="fecha_revision" class="form-control" placeholder="" value="" required>
    </div>
    <div class="form-group">
      <label>Precio</label>
      <input type="number" name="dni" class="form-control" placeholder="" required>
    </div>
    <div class="form-group">
            <label>Proveedor</label>
            <select name="turno_id" class="form-control">
                <option value=""></option>
            </select>
          </div>
    <div class="form-group">
      <label>Categoria</label>
      <select name="turno_id" class="form-control">
          <option value=""></option>
      </select>
    </div>
    <hr>
    <button type="submit" class="btn btn-success btn-block">Guardar</button>
  </form>
<hr>
</div>
@endsection
