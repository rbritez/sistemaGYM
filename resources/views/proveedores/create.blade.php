@extends('layout')

@section('title', 'Agregar Producto')

@section('content')
<h1>Agregar Proveedor</h1>
<hr>
<div class="col-sm-4">
  <form action="{{ route('proveedores.store') }}" method="POST">
    @csrf
    <div class="form-group">
      <label>Nombre</label>
    <input type="text" name="fecha_revision" class="form-control" placeholder="" value="" required>
    </div>
    <hr>
    <button type="submit" class="btn btn-success btn-block">Guardar</button>
  </form>
<hr>
</div>
@endsection
