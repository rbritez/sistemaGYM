@extends('layout')

@section('title', 'Rutinas')

@section('content')
<h1>Rutinas de {{$cliente->persona->apellido}} {{$cliente->persona->nombre}}:</h1>
<hr>
<button type="button" class="btn btn-danger">Imprimir Lista</button>
<hr>
<table class="table table-hover table-striped">
    <thead>
        <tr>
            <th>Descripcion</th>
            <th>Dificultad</th>
            <th>N° de Dias</th>
            <th>Fecha de Cambio</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($rutinas as $rutina )
        <tr>
            <td>{{$rutina->rutina->descripcion}}</td>
            <td>{{$rutina->rutina->dificultad}}</td>
            <td>{{$rutina->rutina->nro_dias}}</td>
            <td>{{$rutina->fecha_cambio}}</td>
        </tr>
        @endforeach
    </tbody>
</table>
<hr>
<button onclick="volver()" class="btn btn-danger">Volver</button>

@endsection
@section('js')
    <script type="text/javascript">
        function volver(){
            window.history.back();
        }
    </script>
@endsection

