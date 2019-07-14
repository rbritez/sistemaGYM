@extends('layout')

@section('title', 'Maquinas')

@section('content')
  <h1>Maquinas</h1>
  <table class="table">
    <thead>
      <tr>
        <th>Descripción</th>
        <th>Estado</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <form action="{{ route('maquinas.store') }}" method="POST">
          @csrf
          <td>
            <input type="text" class="form-control" placeholder="Maquina" name="descripcion">
          </td>
          <td>
            <select class="form-control" name="estado">
              @foreach($estados as $estado)
                <option value="{{ $estado[0] }}">{{ $estado[1] }}</option>
              @endforeach
            </select>
          </td>
          <td>
            <button type="submit" class="btn btn-success">Crear</button>
          </td>
        </form>
      </tr>
      @foreach($maquinas as $maquina)
        <tr>
          <form action="{{ route('maquinas.update', $maquina->id) }}" method="POST">
            @csrf
            @method('PUT')
            <td>
              <input type="text" class="form-control" placeholder="Maquina" name="descripcion" value="{{ $maquina->descripcion }}">
            </td>
            <td>
              <select class="form-control" name="estado">
                @foreach($estados as $estado)
                  @if($estado[0] === $maquina->estado)
                    <option value="{{ $estado[0] }}" selected>{{ $estado[1] }}</option>
                  @else
                    <option value="{{ $estado[0] }}">{{ $estado[1] }}</option>
                  @endif
                @endforeach
              </select>
            </td>
            <td>
              <a href="{{ route('maquinas.show', $maquina->id) }}" class="btn btn-primary">Ver rutinas</a>
              <button type="submit" class="btn btn-success">Editar</button>
              <button type="submit" class="btn btn-danger" form="delete-form-{{ $maquina->id }}">Eliminar</button>
            </td>
          </form>
          <form action="{{ route('maquinas.destroy', $maquina->id) }}" method="POST" id="delete-form-{{ $maquina->id }}">
            @csrf
            @method('DELETE')
          </form>
        </tr>
      @endforeach
    </tbody>
  </table>
@endsection