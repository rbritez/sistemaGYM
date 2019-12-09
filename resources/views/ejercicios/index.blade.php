@extends('layout')

@section('title', 'Ejercicios')

@section('content')
<h1>Ejercicios</h1>
<hr>
<div>
<button class="btn btn-primary" data-toggle="modal" data-target="#modal_newCliente">Nuevo Ejercicio</button> <a href="{{route('SectorCorporal.index')}}"><button class="btn btn-info">Sectores Corporales</button></a>
</div>
<br>
<div class="table-responsive nowrap">
  <table id="tablalistado" class="table table-striped table-hover nowrap">
    <thead align="center">
      <tr>
          <th>Acciones</th>
          <th>Descripción</th>
          <th>Maquina Utilizada</th>
          <th>Sector Corporal</th>
          <th>Estado</th>
      </tr>
    </thead>
    <tbody align="center">
      @foreach($ejercicios as $ejercicio)
        <tr>
              <td>
                  <button class="btn btn-warning" onclick="mostrar({{$ejercicio->id}})" data-toggle="modal" data-target="#modal_updateCliente">Editar</button> 
                  @if($ejercicio->estado == '1')
                  <a href="{{route('ejercicios.destroy',$ejercicio->id)}}"><button type="button" class="btn btn-danger">Deshabilitar</button></a>
                @else
                  <a href="{{route('ejercicios.destroy',$ejercicio->id)}}"><button type="button" class="btn btn-success">Habilitar</button></a>
                @endif
              </td>
              <td>{{ $ejercicio->descripcion }}</td>
              <td>{{ $ejercicio->maquina['descripcion']}}</td>
              <td>{{$ejercicio->sectorcorp->nombre}}</td>
              @if($ejercicio->estado == '1')
              <td><b style="color:aliceblue;background-color:darkgreen;padding:5px 11px;border-radius:5px">Activo</b></td>
                @else
                <td><b style="color:aliceblue;background-color: darkred;padding:5px;border-radius:5px">Inactivo</b></td>
              @endif 
        </tr>
      @endforeach
    </tbody>
  </table>
</div>

{{-- MODAL NUEVO EJERCICIO --}}
<div class="modal fade" id="modal_newCliente"> <!-- modallllllllll-->
    <div class="modal-dialog">
        <div class="modal-content"> <!-- div content --> 
            <div class="modal-warning modal-header " style="background-color:#007BFF">
              <b style="color:white;" id="title_categoria" class="modal-title">NUEVO EJERCICIO</b>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" style="color:white">&times;</span>
                </button>
                
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        <form  method="POST" name="formulario" id="formulario" action="{{ route('ejercicios.store') }}">
                            {{csrf_field()}}
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">DESCRIPCION</label>
                                <div class="col-sm-8">
                                  <input type="text" name="nombre" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">MAQUINA</label>
                                <div class="col-sm-8">
                                    <select name="maquina_id" id="maquina_id" class="form-control">
                                        <option value="">Seleccionar...</option>
                                        @foreach ($maquinas as $maquina)
                                            <option value="{{$maquina->id}}">{{$maquina->descripcion}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">SECTOR CORPORAL</label>
                                    <div class="col-sm-8">
                                        <select class="form-control" name="sector_corp" id="sector_corp" required>
                                            <option value="">Seleccionar...</option>
                                            @foreach ($sectores as $sector)
                                        <option value="{{$sector->id}}">{{$sector->nombre}}</option>
                                            @endforeach
                                        </select>
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

  {{-- MODAL EDITAR EJERCICIO --}}
<div class="modal fade" id="modal_updateCliente"> <!-- modallllllllll-->
  <div class="modal-dialog">
      <div class="modal-content"> <!-- div content --> 
          <div class="modal-warning modal-header " style="background-color:#007BFF">
            <b style="color:white;" id="title_categoria" class="modal-title">EDITAR EJERCICIO</b>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true" style="color:white">&times;</span>
              </button>
              
          </div>
          <div class="modal-body">
              <div class="row">
                  <div class="col-sm-12">
                  <form  method="POST" name="formularioUpdate" id="formularioUpdate" action="{{route('ejercicios.update',1)}}">
                          {{csrf_field()}}
                          @method('PUT')
                          <div class="form-group row">
                              <label class="col-sm-4 col-form-label">DESCRIPCION</label>
                              <div class="col-sm-8">
                                  <input type="hidden" name="id_ejercicio" id="id_ejercicio_update" value="">
                                <input type="text" name="nombre" id="nombre_update" class="form-control" required>
                              </div>
                          </div>
                          <div class="form-group row">
                              <label class="col-sm-4 col-form-label">MAQUINA</label>
                              <div class="col-sm-8">
                                  <select name="maquina_id" id="maquina_id_update" class="form-control">
                                      <option value="">Seleccionar...</option>
                                      @foreach ($maquinasTotal as $maquina)
                                          <option value="{{$maquina->id}}">{{$maquina->descripcion}}</option>
                                      @endforeach
                                  </select>
                              </div>
                          </div>
                          <div class="form-group row">
                                  <label class="col-sm-4 col-form-label">SECTOR CORPORAL</label>
                                  <div class="col-sm-8">
                                      <select class="form-control" name="sector_corp" id="sector_corp_update" required>
                                          <option value="">Seleccionar...</option>
                                          @foreach ($sectores as $sector)
                                      <option value="{{$sector->id}}">{{$sector->nombre}}</option>
                                          @endforeach
                                      </select>
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

  function init(){
    listar();

  }
    function mostrar(idejercicio){
      $.post('{{route("ejercicios.mostrarr")}}',{'_token': $('meta[name="csrf-token"]').attr('content'),'id': idejercicio},function(array){
        $("#id_ejercicio_update").val(array.id);
        var $id = idejercicio
        $("#nombre_update").val(array.descripcion);
        $("#maquina_id_update").val(array.maquina_id);
        $("#sector_corp_update").val(array.sector_corp_id);
        console.log(array);
      });
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
                  [0, "asc"]
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
  init();
  </script>
      
@endsection
