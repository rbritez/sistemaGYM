@extends('layout')

@section('title', 'Inscripcion - '.$inscripcion->cliente->persona->apellido_nombre)

@section('content')
<h1>{{ $inscripcion->cliente->persona->apellido_nombre }}</h1>
<hr>
<form action="{{ route('inscripciones.update', $inscripcion->id) }}" method="POST" id="actualizar">
  @csrf
  @method('PUT')
  <div class="row">
    <div class="col-lg-4">
      <div class="form-group">
        <label>Apellido y Nombre</label>
        <input
          type="text"
          name="apellido_nombre"
          class="form-control"
          placeholder="{{ $inscripcion->cliente->persona->apellido_nombre }}"
          value="{{ $inscripcion->cliente->persona->apellido_nombre }}"
          required
        >
      </div>
      <div class="form-group">
        <label>DNI</label>
        <input
          type="text"
          name="dni"
          class="form-control"
          placeholder="{{ $inscripcion->cliente->persona->dni }}"
          value="{{ $inscripcion->cliente->persona->dni }}"
          required
        >
      </div>
      <div class="form-group">
        <label>Domicilio</label>
        <textarea
          name="domicilio"
          class="form-control"
          placeholder="{{ $inscripcion->cliente->persona->domicilio }}"
          required
        >{{ $inscripcion->cliente->persona->domicilio }}</textarea>
      </div>
    </div>
    <div class="col-lg-4">
      <div class="form-group">
        <label>Plan</label>
        <select name="plan_id" class="form-control">
          @foreach($planes as $plan)
            @if($plan->id === $inscripcion->plan_id)
              <option value="{{ $plan->id }}" selected>{{ $plan->descripcion }} - ${{ $plan->precio }}</option>
            @else
              <option value="{{ $plan->id }}">{{ $plan->descripcion }} - ${{ $plan->precio }}</option>
            @endif
          @endforeach
        </select>
      </div>
      <div class="form-group">
        <label>Rutina</label>
        <select name="rutina_id" class="form-control">
          @foreach($rutinas as $rutina)
            @if($rutina->id === $inscripcion->rutina_id)
              <option value="{{ $rutina->id }}" selected>{{ $rutina->descripcion }}</option>
            @else
              <option value="{{ $rutina->id }}">{{ $rutina->descripcion }}</option>
            @endif
          @endforeach
        </select>
      </div>
      <div class="form-group">
        <label>Inscripto por</label>
        <input type="text" class="form-control" disabled value="{{ $inscripcion->empleado->persona->apellido_nombre }}">
      </div>
      <div class="form-group">
        <input type="text" class="form-control" disabled value="{{ $inscripcion->fecha }}">
      </div>
    </div>
    <div class="col-lg-4">
      <input type="submit" class="btn btn-success btn-block" form="actualizar" value="Actualizar"/>
    </div>
  </div>
</form>
<hr>
<h2>Pagos</h2>
<form action="{{ route('pagos.store') }}" method="post">
  @csrf
  <input type="hidden" name="inscripcion_id" value="{{ $inscripcion->id }}">
  <input type="hidden" name="inscripcion_redirect" value="true">
  <div class="row align-items-end">
    <div class="col-lg">
      <div class="form-group">
        <label>Nuevo pago</label>
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text">$</span>
          </div>
          <input type="number" class="form-control" value="{{ $inscripcion->plan->precio }}" disabled>
        </div>
      </div>
    </div>
    <div class="col-lg">
      <div class="form-group">
        <label>Empleado</label>
        <select name="empleado_id" class="form-control">
          @foreach($empleados as $empleado)
            <option value="{{ $empleado->id }}">{{ $empleado->persona->apellido_nombre }}</option>
          @endforeach
        </select>
      </div>
    </div>
    <div class="col-lg">
      <div class="form-group">
        <button type="submit" class="btn btn-primary btn-block">Agregar pago</button>
      </div>
    </div>
  </div>
</form>
<table class="table">
  <thead>
    <tr>
      <th>Plan</th>
      <th>Monto</th>
      <th>Fecha</th>
      <th>Empleado</th>
    </tr>
  </thead>
  <tbody>
    @foreach($inscripcion->cliente->pagos as $pago)
      <tr>
        <td>{{ $pago->plan->descripcion }}</td>
        <td>{{ $pago->monto }}</td>
        <td>{{ $pago->fecha }}</td>
        <td>{{ $pago->empleado->persona->apellido_nombre }}</td>
      </tr>
    @endforeach
  </tbody>
</table>
<hr>
@endsection