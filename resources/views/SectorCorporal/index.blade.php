@extends('layout')

@section('title', 'Sectores Corporales')

@section('content')
<h1>Sectores Corporales</h1>
<hr>
<div>
<button class="btn btn-primary" data-toggle="modal" data-target="#modal_newCliente">Nuevo Sector Corporal</button>
</div>
<br>
<div class="panel-body table-responsive ">
  <table id="tablalistado" class="table table-striped table-hover nowrap" style="width:100%">
    <thead align="center">
      <tr>
          <th>Acciones</th>
          <th>Nombre</th>
          <th>Grafico</th>
          <th>Estado</th>
      </tr>
    </thead>
    <tbody id="tbodysc" align="center">

    </tbody>
  </table>
</div>

{{-- MODAL NUEVO EJERCICIO --}}
<div class="modal fade" id="modal_newCliente"> <!-- modallllllllll-->
    <div class="modal-dialog">
        <div class="modal-content"> <!-- div content --> 
            <div class="modal-warning modal-header " style="background-color:#007BFF">
              <b style="color:white;" id="title_categoria" class="modal-title">NUEVO SECTOR CORPORAL</b>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" style="color:white">&times;</span>
                </button>
                
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        <form  method="POST" name="formulario" id="formulario" action="{{ route('SectorCorporal.store') }}" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <div class="form-group row">

                                <label class="col-sm-4 col-form-label">NOMBRE</label>
                                <div class="col-sm-8">
                                  <input type="text" name="nombre" id="nombre" class="form-control" required>
                                </div>
                            </div>
                            <div>
                              <input accept="img/*" type="file" name="imagen" id="imagen">
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
{{-- MODAL NUEVO EJERCICIO --}}
<div class="modal fade" id="modal_EditSC"> <!-- modallllllllll-->
  <div class="modal-dialog">
      <div class="modal-content"> <!-- div content --> 
          <div class="modal-warning modal-header " style="background-color:#007BFF">
            <b style="color:white;" id="title_categoria" class="modal-title">NUEVO SECTOR CORPORAL</b>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true" style="color:white">&times;</span>
              </button>
              
          </div>
          <div class="modal-body">
              <div class="row">
                  <div class="col-sm-12">
                      <form  method="POST" name="formularioUpdate" id="formularioUpdate" action="{{ route('SectorCorporal.update',1) }}" enctype="multipart/form-data">
                          {{csrf_field()}}
                          @method('PUT')
                          <div class="form-group row">
                              <label class="col-sm-4 col-form-label">NOMBRE</label>
                              <div class="col-sm-8">
                                  <input type="hidden" name="id_sector_corporal" id="id_sector_corporal" class="form-control" required>
                                <input type="text" name="nombre" id="nombre_update" class="form-control" required>
                              </div>
                          </div>
                          <div class="form-group row">
                              <label class="col-sm-4 col-form-label">IMAGEN ACTUAL</label>
                              <div class="col-sm-8">
                                  <img src="{{asset('img/no_disponible.jpg')}}" id="verIMG" alt="" width="100" height="100">
                                  <input type="hidden" name="imgAnterior" id="imgAnterior" value="">
                              </div>
                          </div>
                          <div class="form-group row">
                              <label class="col-sm-4 col-form-label">CAMBIAR</label>
                              <div class="col-sm-8">
                                  <input accept="img/*" style="width:100%" type="file" name="imagen">
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
    function mostrarSC(id){
      console.log(id);
      $.post('{{route("SectorCorporal.mostrar")}}',{'_token': $('meta[name="csrf-token"]').attr('content'),'id': id},function(array){
        $("#id_sector_corporal").val(array.id);
        $("#nombre_update").val(array.nombre);
        
        if(array.imagen){
          $("#imgAnterior").val(array.imagen);
          $('#verIMG').attr('src','../img/'+array.imagen);
        }else{
          $("#imgAnterior").val("");
          $('#verIMG').attr('src','../img/no_disponible.jpg');
        }
        
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
          "ajax": {
              url: "{{route('SectorCorporal.listar')}}",
              headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
              type: "post",
              dataType: "json",
              error: function(e) {
                  console.log(e.responseText)
              }
          },
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
