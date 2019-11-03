@extends('layout')

@section('title', 'Inscripciones')

@section('content')
<h1>Inscripciones</h1>
<hr>
<div>
  <a href="{{ route('inscripciones.create') }}" class="btn btn-primary">Nueva inscripción</a>
</div>
<br>
<table id="tablalistado" class="table table-bordered table-hover nowrap">
  <thead>
    <tr>
      <th>Apellido y Nombre</th>
      <th>Plan</th>
      <th>Rutina</th>
      <th>Ficha Medica</th>
      <th>Acciones</th>
    </tr>
  </thead>
  <tbody>
    @foreach($inscripciones as $ins)
      <tr>
      <td>{{ $ins->cliente->persona->apellido_nombre }} {{$ins->id}}</td>
        <td>{{ $ins->plan->descripcion }} - ${{ $ins->plan->precio }}</td>
        <td>{{ $ins->rutina->descripcion }}</td>
        <td><a  class="btn btn-success" href="{{ route('fichamedica.show', $ins->id) }}">Ver Ficha </font></a></td>
        <td>
          <a href="{{ route('inscripciones.show', $ins->id) }}">Ver más</a>
        </td>
      </tr>
    @endforeach
  </tbody>
</table>
@endsection
@section('js')
<script >
  var tabla;
  
    function listar() {
      tabla = $('#tablalistado').dataTable({ //mediante la propiedad datatable enviamos valores
  
          "responsive": {
              "details": true,
          },
          "aProcessing": true, //Activamos el prcesamiento del datatable
          "aServerSide": true, //Paginacion y filtrado realizado por el servidor
          dom: 'Bfrtip', //Definimos los elementos del control de tabla
          buttons: [ //botones para exportar 
              'copyHtml5',
              'excelHtml5',
              'pdf'
          ],
          // "ajax": {
          //     // url: '../ajax/categoria.php?op=listar',
          //     type: "get",
          //     dataType: "json",
          //     error: function(e) {
          //         console.log(e.responseText)
          //     }
          // },
          "bDestroy": true,
          "iDisplayLength": 5, //paginacion cada 5 registros
          "order": [
                  [0, "desc"]
              ] //orden de listado , columna 0, el id de categoria
  
      }).dataTable();
      $(".dt-button.buttons-copy.buttons-html5").attr('id', 'botonCopia');
      $("#botonCopia").html('<span><i class="fa fa-copy"></i> Copia</span>');
      $(".dt-button.buttons-excel.buttons-html5").attr('id', 'botonExcel');
      $("#botonExcel").html('<span><i class="fa fa-file-excel-o"></i> Excel</span>');
      $("#botonExcel").css('color', 'white');
      $("#botonExcel").css('background', 'green');
      $(".dt-button.buttons-pdf.buttons-html5").attr('id', 'botonPdf');
      $("#botonPdf").html('<span><i class="fa fa-file-pdf-o"></i> PDF</span>');
      $("#botonPdf").css('color', 'white');
      $("#botonPdf").css('background', '#D33724');
  }
  listar()
  </script>
      
@endsection
