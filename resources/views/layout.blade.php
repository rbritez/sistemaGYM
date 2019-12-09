<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" lang="es">
  <meta name="viewport" lang="es" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{csrf_token()}}">
  <meta http-equiv="X-UA-Compatible" lang="es" content="ie=edge">
  {{-- bootstraop 4.0.0 --}}
  <link rel="stylesheet" href={{asset("bootstrap/css/bootstrap.min.css")}}>
    <!-- DATATABLES-->
    <link rel="stylesheet" type="text/css" href={{asset("datatables/jquery.dataTables.min.css")}}>
    <link rel="stylesheet" type="text/css" href={{asset("datatables/buttons.dataTables.min.css")}}>
    <link rel="stylesheet" type="text/css" href={{asset("datatables/responsive.dataTables.min.css")}}>
  <title>Gimnasio - @yield('title')</title>
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <a href="{{route('principal.index')}}"><span class="navbar-brand mb-0 h1">Gimnasio</span></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav">
        <a class="nav-item nav-link" href="{{ route('inscripciones.index') }}">Inscripciones</a>
        <a class="nav-item nav-link" href="{{route('clientes.index')}}">Clientes</a>
        <a class="nav-item nav-link" href="{{ route('pagos.index') }}">Pagos</a>
        <a class="nav-item nav-link" href="{{ route('planes.index') }}">Planes</a>
        <a class="nav-item nav-link" href="{{ route('rutinas.index') }}">Rutinas</a>
        <a class="nav-item nav-link" href="{{ route('ejercicios.index') }}">Ejercicios</a>
        <a class="nav-item nav-link" href="{{ route('maquinas.index') }}">Maquinas</a>
        <a class="nav-item nav-link" href="{{ route('empleados.index') }}">Empleados</a>
        <a class="nav-item nav-link" href="{{ route('productos.index') }}">Productos</a>
        <a class="nav-item nav-link" href="{{ route('proveedores.index') }}">Proveedores</a>
        <a class="nav-item nav-link" href="{{ route('compras.index') }}">Compras</a>

      </div>
    </div>
  </nav>
  <div class="container" style="padding-top: 16px;">
    @yield('content')
  </div>
</body>
{{-- jquery --}}
<script src={{asset("js/jquery-3.4.1.min.js")}}></script>
{{-- boostrap 4.0.0 --}}
<script src={{asset("bootstrap/js/bootstrap.min.js")}}></script>
 <!-- DATATABLE --->
 <script src={{asset("datatables/jquery.dataTables.min.js")}}></script>
 <script src={{asset("datatables/dataTables.buttons.min.js")}}></script>
 <script src={{asset("datatables/buttons.html5.min.js")}}></script>
 <script src={{asset("datatables/buttons.colVis.min.js")}}></script>
 <script src={{asset("datatables/jszip.min.js")}}></script>
 <script src={{asset("datatables/pdfmake.min.js")}}></script>
 <script src={{asset("datatables/vfs_fonts.js")}}></script>

{{-- charts --}}
<script src="{{asset("Chart-2.9.3/Chart.min.js")}}"></script>
<script src="{{asset("Chart-2.9.3/Chart.bundle.min.js")}}"></script>
{{-- <script src="{{asset("Chart-2.9.3/utils.js")}}"></script> --}}
 @yield('js')
</html>
