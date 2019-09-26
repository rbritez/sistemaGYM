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
    <input type="text" name="descripcion" class="form-control" placeholder="" value="" required>
    </div>
    <div class="form-group">
      <label>Precio</label>
      <input type="number" name="precio" class="form-control" placeholder="" required>
    </div>
    <div class="form-group">
            <label>Proveedor</label>
            <select name="id_proveedor" class="form-control">
            @foreach($proveedores as $proveedor)
            <option value="{{ $proveedor->id }}">{{ $proveedor->nombre }}</option>
          @endforeach
            </select>
          </div>
    <div class="form-group">
      <label>Categoria</label>
      <select name="id_categoria" class="form-control">
      @foreach($categorias as $categoria)
            <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
          @endforeach
      </select>
    </div>
    <hr>
    <button type="submit" class="btn btn-success btn-block">Guardar</button>
  </form>
<hr>
</div>
@endsection
