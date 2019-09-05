<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  <title>Gimnasio - @yield('title')</title>
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <a href="http://localhost/gimnasio2/public"><span class="navbar-brand mb-0 h1">Gimnasio</span></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav">
        <a class="nav-item nav-link" href="{{ route('inscripciones.index') }}">Inscripciones</a>
        <a class="nav-item nav-link" href="{{ route('pagos.index') }}">Pagos</a>
        <a class="nav-item nav-link" href="{{ route('planes.index') }}">Planes</a>
        <a class="nav-item nav-link" href="{{ route('rutinas.index') }}">Rutinas</a>
        <a class="nav-item nav-link" href="{{ route('maquinas.index') }}">Maquinas</a>
        <a class="nav-item nav-link" href="{{ route('empleados.index') }}">Empleados</a>
        <a class="nav-item nav-link" href="{{ route('productos.index') }}">Productos</a>
        <a class="nav-item nav-link" href="{{ route('empleados.index') }}">Venta</a>
        <a class="nav-item nav-link" href="{{ route('empleados.index') }}">Compras</a>
        <a class="nav-item nav-link" href="{{ route('empleados.index') }}">Proveedores</a>

      </div>
    </div>
  </nav>
  <div class="container" style="padding-top: 16px;">
    @yield('content')
  </div>
</body>
</html>
