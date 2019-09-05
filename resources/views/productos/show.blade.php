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
  <tbody>
    <tr>
    <td>1</td>
    <td>Remera Deportiva</td>
    <td>$450</td>
    <td>North sports</td>
    <td>Prendas</td>
    <td>  <button type="submit" class="btn btn-danger" form="">Eliminar</button></td>

    </tr>

    <tr>
        <td>1</td>
        <td>Calza Deportiva</td>
        <td>$650</td>
        <td>North sports</td>
        <td>Prendas</td>
    <td>  <button type="submit" class="btn btn-danger" form="">Eliminar</button></td>

    </tr>

    <tr>
        <td>1</td>
        <td>Vitamina</td>
        <td>$950</td>
        <td>suplementos del norte</td>
        <td>Suplementos</td>
        <td>  <button type="submit" class="btn btn-danger" form="">Eliminar</button></td>

    </tr>
  @foreach($productos as $producto)
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
