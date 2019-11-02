@extends('layout')

@section('title', 'Rutinas - '.$rutina->descripcion)

@section('content')
<h1>Rutina: {{ $rutina->descripcion }}</h1>
<hr>
<h3>Maquinas usadas</h2>
<hr>
<form action="{{ route('rutina_maquinas.store') }}" method="post">
  @csrf
  <input type="hidden" name="rutina_id" value="{{ $rutina->id }}">
  <input type="hidden" name="redirect" value="rutinas">
  <div class="form-group">
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text">Añadir maquina a la rutina</span>
      </div>
      <select class="form-control" name="maquina_id">
        @foreach($maquinas as $maquina)
          <option value="{{ $maquina->id }}">{{ $maquina->descripcion }} ({{ $maquina->estado }})</option>
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
      <td>Descripción</td>
      <td>Estado</td>
      <td>Acciones</td>
    </tr>
  </thead>
  <tbody>
    @foreach($rutina->maquinas as $maquina)
      <tr>
        <td>{{ $maquina->descripcion }}</td>
        <td>{{ $maquina->estado }}</td>
        <td>
          <form action="{{ route('rutina_maquinas.delete') }}" method="post">
            @csrf
            @method('DELETE')
            <input type="hidden" name="rutina_id" value="{{ $rutina->id }}">
            <input type="hidden" name="maquina_id" value="{{ $maquina->id }}">
            <input type="hidden" name="redirect" value="rutinas">
            <button type="submit" class="btn btn-danger btn-sm">Quitar</button>
          </form>
        </td>
      </tr>
    @endforeach
  </tbody>
</table>
@endsection