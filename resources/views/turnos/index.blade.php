@extends('layout')

@section('title', 'Turnos')

@section('content')
  <h1>Turnos</h1>
  <table class="table">
    <thead>
      <tr>
        <th>Descripción</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <form action="{{ route('turnos.store') }}" method="POST">
          @csrf
          <td>
            <input type="text" class="form-control" placeholder="Turno" name="descripcion">
          </td>
          <td>
            <button type="submit" class="btn btn-primary">Crear</button>
          </td>
        </form>
      </tr>
      @foreach($turnos as $turno)
        <tr>
          <form action="{{ route('turnos.update', $turno->id) }}" method="POST">
            @csrf
            @method('PUT')
            <td>
              <input type="text" class="form-control" placeholder="Turno" name="descripcion" value="{{ $turno->descripcion }}">
            </td>
            <td>
              <button type="submit" class="btn btn-warning" >Editar</button>
              @if($turno->estado =='1')
              <button type="submit" class="btn btn-danger" form="delete-form-{{ $turno->id }}">Desactivar</button>
              @else
              <button type="submit" class="btn btn-success" style="padding-left:24px;padding-right:24px" form="delete-form-{{ $turno->id }}">Activar</button>
              @endif
              
            </td>
          </form>
          <form action="{{ route('turnos.destroy', $turno->id) }}" method="POST" id="delete-form-{{ $turno->id }}">
            @csrf
            @method('DELETE')
          </form>
        </tr>
      @endforeach
    </tbody>
  </table>
@endsection