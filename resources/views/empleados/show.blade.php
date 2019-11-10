@extends('layout')

@section('title', 'Empleado - '.$empleado->persona->apellido_nombre )

@section('content')
{{-- <h1>{{ $empleado->persona->apellido_nombre }}</h1>
<hr>
<div class="row">
  <div class="col-lg-4">
    <form action="{{ route('empleados.update', $empleado->id) }}" method="POST">
      @csrf
      @method('PUT')
      <div class="form-group">
        <label>Apellido y Nombre</label>
        <input
          type="text"
          name="apellido_nombre"
          class="form-control"
          placeholder="{{ $empleado->persona->apellido_nombre }}"
          value="{{ $empleado->persona->apellido_nombre }}"
          required
        >
      </div>
      <div class="form-group">
        <label>DNI</label>
        <input
          class="form-control"
          type="text"
          name="dni"
          placeholder="{{ $empleado->persona->dni }}"
          value="{{ $empleado->persona->dni }}"
          required
        >
      </div>
      <div class="form-group">
        <label>Domicilio</label>
        <textarea name="domicilio" class="form-control" required>{{ $empleado->persona->domicilio }}</textarea>
      </div>
      <div class="form-group">
        <label>Turno</label>
        <select name="turno_id" class="form-control">
          {{-- @foreach($turnos as $turno)
            @if($turno->id === $empleado->turno->id)
              <option value="{{ $turno->id }}" selected>{{ $turno->descripcion }}</option>
            @else
              <option value="{{ $turno->id }}">{{ $turno->descripcion }}</option>
            @endif
          @endforeach --}}
        {{-- </select>
      </div>
      <hr>
      <button type="submit" class="btn btn-success btn-block">Guardar</button>
    </form>
  </div>
  <div class="col-lg">
    <h2>Ingresos</h2>
    <hr>
    <form action="{{ route('ingresos.store') }}" method="POST">
      @csrf
      <input type="hidden" name="empleado_id" value="{{ $empleado->id }}">
      <div class="form-group">
        <button type="submit" class="btn btn-primary">Agregar ingreso ahora</button>
      </div>
    </form>
    <table class="table">
      <thead>
        <tr>
          <th>Fecha</th>
          <th>Turno</th>
        </tr>
      </thead>
      <tbody>
        @foreach($empleado->ingresos as $ingreso)
          <tr>
            <td>{{ $ingreso->fecha }}</td>
            {{-- <td>{{ $ingreso->turno->descripcion }}</td> --}}
          {{-- </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div> --}} --}} --}}
@endsection