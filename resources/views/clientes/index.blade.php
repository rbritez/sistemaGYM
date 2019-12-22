@extends('layout')

@section('title', 'Clientes')

@section('content')
<h1>Clientes</h1>
<hr>
<div>
  <button class="btn btn-primary" data-toggle="modal" data-target="#modal_newCliente">Nuevo Cliente</button> 
<a href="{{route('clientes.inactivosPDF',1)}}" target="_blank" ><button class="btn btn-info">Clientes Inactivos</button></a>
</div>
<br>
<div class="table-responsive">
    <table id="tablalistado" class="table table-bordered table-hover nowrap" style="width:100%">
        <thead align="center">
          <tr>
              <th>Acciones</th>
              <th>Apellido y Nombre</th>
              <th>Cumpleaños</th>
              <th>Celular</th>
              <th>Ultimo Plan</th>
              <th>Fin Ultimo Plan</th>
              <th>Fecha de Ingreso</th>
              <th>Estado</th>
          </tr>
        </thead>
        <tbody align="center">
          @foreach($clientes as $cliente)
            <tr>
                  <td>
                      <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modal_updateCliente" onclick="mostrar({{$cliente->id}})">Editar</button>
                      <a class="btn btn-info" href="{{ route('planes.show', $cliente->id) }}">Planes</a>
                      <a href="{{ route('fichamedica.mostrarFichaMedica', $cliente->id)}}" class="btn btn-secondary">Ficha Medica</a>
                  </td>
                  <td>{{ $cliente->persona->apellido }} {{$cliente->persona->nombre}}</td>
                  <td> @if($cliente->persona->fecha_nac) {{date("d-m-Y",strtotime($cliente->persona->fecha_nac))}}@endif</td>
                  <td>{{$cliente->persona->celular}}</td>
                   <td>
                      <?php
                          $val="";
                          foreach($cliente->plan_cliente as $item){$val = $item->plan->descripcion;}
                          echo $val;
                      ?>
                  </td>
                  <td>
                      <?php
                          $val1="";
                          foreach($cliente->plan_cliente as $item){$val1 = $item->fecha_fin;}
                          if($val1<>""){
                              $date =date("d-m-Y",strtotime($val1));
                          }else{
                              $date="";
                          }
                          echo $date;
                      ?>
                     </td>
                  <td>{{ date("d-m-Y",strtotime($cliente->fecha_ingreso))}}</td>
                  @if($cliente->estado == '1')
                  <td><b style="color:aliceblue;background-color:darkgreen;padding:5px 11px;border-radius:5px">Activo</b></td>
                    @else
                    <td><b style="color:aliceblue;background-color: darkred;padding:5px;border-radius:5px">Inactivo</b></td>
                  @endif 
            </tr>
          @endforeach
        </tbody>
      </table>
</div>

{{-- MODAL NUEVO CLIENTE --}}
<div class="modal fade" id="modal_newCliente"> <!-- modallllllllll-->
    <div class="modal-dialog">
        <div class="modal-content"> <!-- div content --> 
            <div class="modal-warning modal-header " style="background-color:#007BFF">
              <b style="color:white;" id="title_categoria" class="modal-title">NUEVO CLIENTE</b>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" style="color:white">&times;</span>
                </button>
                
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        <form  method="POST" action="{{ route('clientes.store') }}">
                            {{csrf_field()}}
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">NOMBRE</label>
                                <div class="col-sm-8">
                                  <input type="text" name="nombre" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">APELLIDO</label>
                                <div class="col-sm-8">
                                    <input type="text" name="apellido" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">FECHA DE CUMPLEAÑOS</label>
                                <div class="col-sm-8">
                                    <input type="date" name="fecha_nac" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">TEL/CEL</label>
                                <div class="col-sm-8">
                                    <input type="text" name="celular" class="form-control">
                                </div>
                            </div>
                            {{-- <div class="form-group row">
                              <label class="col-sm-4 col-form-label" >PLAN CONTRATADO</label>
                              <div class="col-sm-8">
                                    <select name="plan_id" id="" class="form-control" required>
                                        <option value="">Seleccionar...</option>
                                        @foreach ($planes as $plan)
                                    <option value="{{$plan->id}}">{{$plan->descripcion}} - ${{$plan->precio}}</option>
                                        @endforeach
                                    </select>
                              </div>
                            </div> --}}
                    </div>
                </div>
            </div>
            <div class="modal-footer ">
              <div class="col-10 justify-content-md-start">
                  <button type="button" class="btn btn-danger float-left" data-dismiss="modal">Volver</button>
              </div>
                <button type="submit" class="btn btn-primary float-right"> Guardar</button>
            </div>
            </form>
        </div><!-- div content -->
    </div><!-- /.modal-dialog  -->
  </div><!-- /.modal -->

  {{-- MODAL EDITAR CLIENTE --}}
<div class="modal fade" id="modal_updateCliente"> <!-- modallllllllll-->
    <div class="modal-dialog">
        <div class="modal-content"> <!-- div content --> 
            <div class="modal-warning modal-header " style="background-color:#007BFF">
              <b style="color:white;" id="title_categoria" class="modal-title">EDITAR CLIENTE</b>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" style="color:white">&times;</span>
                </button>
                
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        <form  method="POST" action="{{ route('clientes.update', 1) }}">
                            {{csrf_field()}}
                            @method('put')
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">NOMBRE</label>
                                <div class="col-sm-8">
                                  <input type="hidden" name="id_cliente" id="id_cliente">
                                  <input type="text" name="nombre" id="update_nombre" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">APELLIDO</label>
                                <div class="col-sm-8">
                                    <input type="text" name="apellido" id="update_apellido" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">FECHA DE CUMPLEAÑOS</label>
                                <div class="col-sm-8">
                                    <input type="date" name="fecha_nac" id="update_fecha_nac" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">TEL/CEL</label>
                                <div class="col-sm-8">
                                    <input type="text" name="cel" id="update_cel" class="form-control">
                                </div>
                            </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer ">
              <div class="col-10 justify-content-md-start">
                  <button type="button" class="btn btn-danger float-left" data-dismiss="modal">Volver</button>
              </div>
                <button type="submit" class="btn btn-primary float-right"> Guardar</button>
            </div>
            </form>
        </div><!-- div content -->
    </div><!-- /.modal-dialog  -->
  </div><!-- /.modal -->
@endsection
@section('js')
<script >
  var tabla;
  function mostrar(id){
    $.post('{{route("clientes.mostrar")}}',{'_token': $('meta[name="csrf-token"]').attr('content'),'id': id},function(r){
      console.log(r);
      $("#id_cliente").val(r.id);
      $("#update_nombre").val(r.nombre)
      $("#update_apellido").val(r.apellido);
      $("#update_fecha_nac").val(r.fecha_nac);
      $("#update_cel").val(r.celular);
    })
  }
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
