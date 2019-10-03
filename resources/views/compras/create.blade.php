@extends('layout')

@section('title', 'Agregar Producto')

@section('content')
<h1>Agregar Compra</h1>
<hr>
<div class="col-sm-4">
  <form action="{{ route('compras.store') }}" method="POST">
    @csrf
    <div class="form-group">
      <label>Productos</label>
      <select name="id_producto" class="form-control">
      <option value="">seleccione</option>
      @foreach($productos as $producto)
            <option value="{{ $producto->id }}">{{ $producto->descripcion }}</option>
          @endforeach
      </select>
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
      <label>Cantidad</label>
    <input type="text" name="cantidad" class="form-control" placeholder="" value="" required>
    </div>
    <div class="form-group">
      <label>Total</label>
      <input type="number" name="total" class="form-control" placeholder="" required>
    </div>
    <hr>
    <button type="submit" class="btn btn-success btn-block">Guardar</button>
  </form>
<hr>
</div>
@endsection
