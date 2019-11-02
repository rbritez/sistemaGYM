@extends('layout')

 @section('title', 'Productos - ')
@section('content')
<h1>Proveedores</h1>
<hr>
<br>
<a  class="btn btn-primary btn-block col-sm-2" href="{{ route('proveedores.create')}}">Agregar Proveedor</a>
<br>
<table class="table">
  <thead>
    <tr>
      <th>#</th>
      <th>Nombre</th>
    </tr>
  </thead>
  <tbody>

  @foreach($proveedores as $proveedor)
       <tr>
      <td>{{ $proveedor->nombre}}</td>
      <td> <button type="submit" class="btn btn-danger" form="delete-form-{{ $proveedor->id }}">Eliminar</button></td>
      </tr>
      <form action="{{ route('proveedores.destroy', $proveedor->id) }}" method="POST" id="delete-form-{{ $proveedor->id }}">
            @csrf
            @method('DELETE')
          </form>
    @endforeach
  </tbody>
</table>
<hr>
@endsection
