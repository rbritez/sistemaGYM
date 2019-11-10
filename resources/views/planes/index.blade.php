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
        <th>Estado</th>
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
            <input type="number" class="form-control" name="cant_meses" value="1" placeholder="Cantidad de Meses Ej: 1,6,12">
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
            <select name="estado" id="" class="form-control">
              <option value="">Seleccionar</option>
              <option value="1">Activo</option>
              <option value="0">Inactivo</option>
            </select>
          </td>
          <td>
            <button type="submit" class="btn btn-primary">Crear</button>
          </td>
        </form>
      </tr>
      <?php 
      $i = 0;
      ?>
      @foreach($planes as $plan)
        <tr>
         
          <form action="{{ route('planes.update', $plan->id) }}" method="POST">
            @csrf
            @method('PUT')
            <td>
              <input type="text" class="form-control" placeholder="plan" name="descripcion" value="{{ $plan->descripcion }}">
            </td>
            <td>
            <input type="number" class="form-control" name="cant_meses" value="{{$plan->cant_meses}}" placeholder="Cantidad de Meses Ej: 1,6,12">
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
            <input type="hidden" id="vEstado<?php echo $i;?>" value="{{$plan->estado}}">
            <input type="hidden" id='i' value="<?php echo $i;?>" >
            <select name="estado" id="estado" class="form-control estado">
                @if ($plan->estado == "1")
                <option value="1" selected>Activo</option>
                <option value="0">Inactivo</option>    
                @else
                <option value="1">Activo</option>
                <option value="0" selected>Inactivo</option>
                @endif
              </select>
            </td>
            <td>
              {{-- <a href="{{ route('planes.show', $plan->id) }}" class="btn btn-primary">Ver</a> --}}
              <button type="submit" class="btn btn-success">Editar</button>
              {{-- <button type="submit" class="btn btn-danger" form="delete-form-{{ $plan->id }}">Eliminar</button> --}}
            </td>
          </form>
          <form action="{{ route('planes.destroy', $plan->id) }}" method="POST" id="delete-form-{{ $plan->id }}">
            @csrf
            @method('DELETE')
          </form>
        </tr>
        <?php $i++ ;?>
      @endforeach
    </tbody>
  </table>
@endsection
@section('js')

@endsection
