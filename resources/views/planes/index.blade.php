@extends('layout')

@section('title', 'Planes')

@section('content')
  <h1>Planes</h1>
  <table class="table">
    <thead>
      <tr>
        <th>Descripción</th>
        <th>Duración de Meses</th>
        <th>Precio</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <form action="{{ route('planes.store') }}" method="POST">
          @csrf
          <td>
            <input type="text" class="form-control" placeholder="Plan" name="descripcion" required>
          </td>
          <td>
            <input type="number" class="form-control" name="duracion" value="1" placeholder="Cantidad de Meses Ej: 1,6,12">
          </td>
          <td>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">$</span>
                </div>
                <input type="number" class="form-control" placeholder="100.00" name="precio" required>
              </div>
          </td>
          <td>
            <button type="submit" class="btn btn-success">Crear</button>
          </td>
        </form>
      </tr>
      @foreach($planes as $plan)
        <tr>
          <form action="{{ route('planes.update', $plan->id) }}" method="POST">
            @csrf
            @method('PUT')
            <td>
              <input type="text" class="form-control" placeholder="plan" name="descripcion" value="{{ $plan->descripcion }}">
            </td>
            <td>
              <input type="number" class="form-control" name="duracion" value="1" placeholder="Cantidad de Meses Ej: 1,6,12">
            </td>
            <td>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">$</span>
                </div>
                <input type="number" class="form-control" placeholder="100.00" name="precio" value="{{ $plan->precio }}">
              </div>
            </td>
            <td>
              {{-- <a href="{{ route('planes.show', $plan->id) }}" class="btn btn-primary">Ver</a> --}}
              <button type="submit" class="btn btn-success">Editar</button>
              <button type="submit" class="btn btn-danger" form="delete-form-{{ $plan->id }}">Eliminar</button>
            </td>
          </form>
          <form action="{{ route('planes.destroy', $plan->id) }}" method="POST" id="delete-form-{{ $plan->id }}">
            @csrf
            @method('DELETE')
          </form>
        </tr>
      @endforeach
    </tbody>
  </table>
@endsection