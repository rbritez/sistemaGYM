@extends('layout')

@section('title', 'Planes')

@section('content')
<h1>Todos los Planes de {{$cliente->persona->apellido}} {{$cliente->persona->nombre}}</h1>
<hr>
<br>
<table id="tablalistado" class="table table-bordered table-hover nowrap">
  <thead align="center">
    <tr>
        <th>Plan</th>
        <th>Fecha de Inicio</th>
        <th>Fecha de Fin </th>
        <th>Estado</th>
    </tr>
  </thead>
  <tbody align="center">
      @foreach ($planes as $item)
        <tr>
            <td>{{$item->plan->descripcion}}</td>
            <td>{{ date("d-m-Y",strtotime($item->fecha_inicio))}}</td>
            <td>{{ date("d-m-Y",strtotime($item->fecha_fin))}}</td>
            @if($item->estado == 1)
            <td><b style="color:aliceblue;background-color:darkgreen;padding:5px 11px;border-radius:5px">Activo</b></td>
            @else
            <b style="color:aliceblue;background-color:darkred;padding:5px 11px;border-radius:5px">Concluido</b>
            @endif
         
        </tr>
         
      @endforeach
    </tbody>
</table>
<a href="{{route('clientes.index')}}" class="btn btn-danger" style="color:whitesmoke"> Volver</a>
@endsection
@section('js')
    <script>
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