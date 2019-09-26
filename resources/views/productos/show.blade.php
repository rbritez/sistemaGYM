@extends('layout')

 @section('title', 'Productos - ')
@section('content')
<h1>Productos</h1>
<hr>
<br>
<a  class="btn btn-primary btn-block col-sm-2" href="{{ route('productos.create')}}">Agregar Productos</a>
<br>
<table class="table">
  <thead>
    <tr>
      <th>#</th>
      <th>Descripcion</th>
      <th>Precio</th>
      <th>Proveedor</th>
      <th>Categoria</th>
      <th>Acciones</th>
    </tr>
  </thead>
  @foreach($productos as $producto)
      <tr>
      <td>{{ $producto->id}}</td>
      <td>{{ $producto->descripcion}}</td>
      <td>{{ $producto->precio }}</td>
      <td>{{ $producto->id_proveedor }}</td>
      <td>{{ $producto->id_categoria }}</td>
      <td>  <button type="submit" class="btn btn-danger" form="">Eliminar</button></td>
      </tr>
    @endforeach
  </tbody>
</table>
<hr>
@endsection
