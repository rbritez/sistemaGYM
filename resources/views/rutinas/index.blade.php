@extends('layout')

@section('title', 'Rutinas')

@section('content')
  <h1>Rutinas</h1>
  <table class="table">
    <thead>
      <tr>
        <th>Descripción</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <form action="{{ route('rutinas.store') }}" method="POST">
          @csrf
          <td>
            <input type="text" class="form-control" placeholder="Rutina" name="descripcion">
          </td>
          <td>
            <button type="submit" class="btn btn-success">Crear</button>
          </td>
        </form>
      </tr>
      @foreach($rutinas as $rutina)
        <tr>
          <form action="{{ route('rutinas.update', $rutina->id) }}" method="POST">
            @csrf
            @method('PUT')
            <td>
              <input type="text" class="form-control" placeholder="Rutina" name="descripcion" value="{{ $rutina->descripcion }}">
            </td>
            <td>
              <a href="{{ route('rutinas.show', $rutina->id) }}" class="btn btn-primary">Ver maquinas</a>
              <button type="submit" class="btn btn-success">Editar</button>
              <button type="submit" class="btn btn-danger" form="delete-form-{{ $rutina->id }}">Eliminar</button>
            </td>
          </form>
          <form action="{{ route('rutinas.destroy', $rutina->id) }}" method="POST" id="delete-form-{{ $rutina->id }}">
            @csrf
            @method('DELETE')
          </form>
        </tr>
      @endforeach
    </tbody>
  </table>
@endsection