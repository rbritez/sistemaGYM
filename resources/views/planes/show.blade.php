@extends('layout')

@section('title', 'Planes')

@section('content')
<h1>Información de {{$cliente->persona->apellido}} {{$cliente->persona->nombre}}  @if($cliente->estado == 1)
    <td><b style="color:aliceblue;background-color:darkgreen;padding:5px 11px;border-radius:5px">Activo</b></td>
    @else
    <td><b style="color:aliceblue;background-color:darkred;padding:5px 11px;border-radius:5px">Inactivo</b></td>
    @endif</h1>
<hr>
<br>
<div class="row">
  <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
        <div class="row">
            <div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
                <div style="font-size:23px;"><span style="font-weight:bold;">Contacto:</span> 
                  <table>
                      <tbody>
                        <tr>
                          <td><img src="{{asset('img/cell_phone.svg')}}" width="30" height="30" ></td>
                          <td>:{{$cliente->persona->celular}}</td>
                        </tr>
                        <tr>
                          <td><img src="{{asset('img/email.svg')}}" width="20" height="20" ></td>
                          <td>:{{$cliente->persona->email}}</td>
                        </tr>
                      </tbody>
                  </table>
                </div>
            </div>
            
            <div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
                <div>
                  <span style="font-weight:bold;font-size:23px;">Fecha de Nacimiento:</span><br>
                <span style="font-size:20px;"><img src="{{asset('img/calendar.svg')}}" width="20" height="20"> : @if ($cliente->persona->fecha_nac){{date('d/m/Y',strtotime($cliente->persona->fecha_nac)) }}@endif 
                  <?php 
                  if($cliente->persona->fecha_nac){
                    $cumple = new DateTime($cliente->persona->fecha_nac);
                    $hoy = new DateTime();
                    $a = $hoy->diff($cumple);
                    echo ', EDAD:'.$a->y.' años';
                  }
                  
                  ?>
                  </span>
                </div>
                <div style="font-size:23px;"><span style="font-weight:bold;">Direccion:</span><br>
                  <span style="font-weight:bold;"><img src="{{asset("img/house.png")}}" width="20" height="20"> </span> :<small style="text-transform:capitalize">  @if($cliente->persona->barrio) Barrio @endif{{ $cliente->persona->barrio }}@if($cliente->persona->calle), @endif{{ $cliente->persona->calle }} {{ $cliente->persona->altura }} @if($cliente->persona->nro_dpto) N° DPTO: @endif {{ $cliente->persona->nro_dpto }}@if($cliente->persona->nro_piso), N° PISO: @endif{{ $cliente->persona->nro_piso }} </small>
                    </div>
            </div>
            <div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
                <div style="font-size:23px;">
                  <span style="font-weight:bold;">Fecha de Ingreso:</span> {{date("d/m/Y",strtotime($cliente->fecha_ingreso))}} <br>
                  @if ($cliente->estado == 0)
                  <div style="font-size:23px;"><span style="font-weight:bold;">Inactivo desde:</span> {{date('d/m/Y',strtotime($cliente->fecha_inactivo))}}</div>    
                  @endif
                </div>
            </div>
                <div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
                  <div style="font-size:23px;"><span style="font-weight:bold;">Saldo Disponible:</span> ${{$saldo->monto_saldo}}</div>
                </div>
               
        </div>
    <hr>

  </div>
  
      <div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
          <h3>Planes Adquiridos</h3> <hr>
          <div class="table-responsive">
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
                      <td><b style="color:aliceblue;background-color:darkred;padding:5px 11px;border-radius:5px">Concluido</b></td>
                      @endif
                   
                  </tr>
                   
                @endforeach
              </tbody>
            </table>
        </div >
  </div>

  <div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
    <h3>Rutinas Adquiridas</h3><hr>
    <div class="table-responsive">
      <table id="tablalistadoRutinas" class="table table-bordered table-hover nowrap">
        <thead>
          <tr>
            <th>Descripcion</th>
            <th>Dificultad</th>
            <th>Nro Dias</th>
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
    </div>
  </div>

</div>


<br>

<a href="{{route('clientes.index')}}" class="btn btn-danger" style="color:whitesmoke"> Volver</a>
<br>
<hr>
@endsection
@section('js')
    <script>
    var tabla;
    var tabla11;
    
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
                  [3, "asc"]
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
  function listarRutinas() {
      tabla11 = $('#tablalistadoRutinas').dataTable({ //mediante la propiedad datatable enviamos valores
  
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
  listarRutinas();
  listar()
    </script>
@endsection