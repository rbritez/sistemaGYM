@extends('layout')

 @section('title', 'Productos - ')
@section('content')
<h1>Compras</h1>
<hr>
<br>
<a  class="btn btn-primary btn-block col-sm-2" href="{{ route('compras.create')}}">Agregar Compra</a>
<br>
<table class="table">
  <thead>
    <tr>
      <th>#</th>
      <th>Fecha</th>
      <th>Producto</th>
      <th>Proveedor</th>
      <th>Cantidad</th>
      <th>Total</th>
      <th>Acciones</th>
    </tr>
  </thead>
  @foreach($compras as $compra)
      <tr>
      <td>{{ $compra->id}}</td>
      <td>{{ $compra->fecha}}</td>
      <td>{{ $compra->producto->descripcion }}</td>
      <td>{{ $compra->proveedor->nombre }}</td>
      <td>{{ $compra->cantidad }}</td>
      <td>{{ $compra->total }}</td>
     <td> <button type="submit" class="btn btn-danger" form="delete-form-{{ $compra->id }}">Eliminar</button>
      </td>
      </tr>
      <form action="{{ route('compras.destroy', $compra->id) }}" method="POST" id="delete-form-{{ $compra->id }}">
            @csrf
            @method('DELETE')
          </form>
    @endforeach
  </tbody>
</table>
<hr>
@endsection
