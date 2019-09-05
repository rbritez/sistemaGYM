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
    <tr>
    <td>1</td>
    <td>North Sports</td>
    <td> <button type="submit" class="btn btn-danger" form="">Eliminar</button></td>
    </tr>
    <tr>
    <td>1</td>
    <td>Suplementos del norte</td>
    <td> <button type="submit" class="btn btn-danger" form="">Eliminar</button></td>
    </tr>
  @foreach($proveedores as $proveedor)
     {{--  <tr>
      <td>{{ $ficha->fecha}}</td>
      <td>{{ $ficha->estado_nutricional_id }}</td>
      <td>{{ $ficha->peso }}</td>
        <td>1.80</td>
        <td>65</td>
      </tr> --}}
    @endforeach
  </tbody>
</table>
<hr>
@endsection
