@extends('layout')

@section('title', 'Maquinas - '.$maquina->descripcion)

@section('content')
<h1>Maquina: {{ $maquina->descripcion }}</h1>
<hr>
<h3>Rutinas ocupadas</h3>
<hr>
<form action="{{ route('rutina_maquinas.store') }}" method="post">
  @csrf
  <input type="hidden" name="maquina_id" value="{{ $maquina->id }}">
  <input type="hidden" name="redirect" value="maquinas">
  <div class="form-group">
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text">Añadir maquina a la rutina</span>
      </div>
      <select class="form-control" name="rutina_id">
        @foreach($rutinas as $rutina)
          <option value="{{ $rutina->id }}">{{ $rutina->descripcion }}</option>
        @endforeach
      </select>
      <div class="input-group-append">
        <button class="btn btn-primary" type="submit">Añadir</button>
      </div>
    </div>
  </div>
</form>
<table class="table">
  <thead>
    <tr>
      <th>Descripción</th>
      <th>Acciones</th>
    </tr>
  </thead>
  <tbody>
    @foreach($maquina->rutinas as $rutina)
      <tr>
        <td><a href="{{ route('rutinas.show', $rutina->id) }}">{{ $rutina->descripcion }}</a></td>
        <td>
          <form action="{{ route('rutina_maquinas.delete') }}" method="post">
            @csrf
            @method('DELETE')
            <input type="hidden" name="rutina_id" value="{{ $rutina->id }}">
            <input type="hidden" name="maquina_id" value="{{ $maquina->id }}">
            <input type="hidden" name="redirect" value="maquinas">
            <button type="submit" class="btn btn-danger btn-sm">Quitar</button>
          </form>
        </td>
      </tr>
    @endforeach
  </tbody>
</table>
@endsection