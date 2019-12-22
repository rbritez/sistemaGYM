@extends('layout')

@section('title', 'Inscripciones')

@section('content')
<h1>Inscripciones</h1>
<hr>
<div>
  <a href="{{ route('inscripciones.create') }}" class="btn btn-primary">Nueva inscripción</a>
<a href="{{route('clientes.index')}}" class="btn btn-primary">Ver Clientes</a>
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
  <tbody style="text-transform:capitalize">
    @foreach($inscripciones as $ins)
      <tr>
      <td>{{ $ins->cliente->persona->apellido }} {{$ins->cliente->persona->nombre}}</td>
        <td>{{ $ins->plan->descripcion }} </td>
        <td>{{ $ins->rutina->descripcion }} <button type="button" class="btn btn-warning float-right" data-toggle="modal" data-target="#modal_updateRutinaInscripcion" onclick="traerinscripcion({{$ins->id}})">Cambiar</button></td>
        <td><a  class="btn btn-success" href="{{ route('fichamedica.mostrarFichaMedica', $ins->cliente->id) }}">Ver Ficha </font></a></td>
        <td>
          <a href="{{ route('inscripciones.show', $ins->id) }}"><button class="btn btn-warning">Editar</button></a>  <a href="{{route('inscripciones.reciboPDF', $ins->id)}}" target="_blank"><button type="button" class="btn btn-danger">Imprimir</button></a>
        </td>
      </tr>
    @endforeach
  </tbody>
</table>
<div class="modal fade" id="modal_updateRutinaInscripcion"> <!-- modallllllllll-->
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
                    <form  method="POST" action="{{ route('inscripciones.updateRutina', 1) }}">
                        {{csrf_field()}}
                        @method('put')
                        <div class="form-group row">
                            <div class="col-sm-8">
                              <input type="hidden" name="id_cliente" id="id_cliente">
                              <input type="hidden" name="id_inscripcion" id="id_inscripcion">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Rutina</label>
                            <div class="col-sm-8">
                                <select name="rutina_id" id="rutina_id" class="form-control">
                                  @foreach ($rutinas as $rutina)
                                <option value="{{$rutina->id}}">{{$rutina->descripcion}}</option>
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
  {{-- -------------------------------------- modale mensaje ------------------------------------------------------------------- --}}
  <button id="mensajebtn" data-toggle="modal" data-target="#mensaje" style="background-color:white;border:none"></button>
  <div class="modal fade" id="mensaje"> <!-- modallllllllll EDITARRR-->
    <div class="modal-dialog modal-sm">
        <div class="modal-content"> <!-- div content --> 
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12" style="text-align:center">
                        Se Creo la Incripcion con Exito!! <br>
                        ¿Imprimir comprobante de Plan?
                    </div>
                </div>
            </div>
            <div class="modal-footer ">
              <div class="col-sm-9">
              <button type="button" class="btn btn-danger float-left" onclick="salir()" data-dismiss="modal">No Imprimir</button>
              </div>
            <a href="{{route('inscripciones.reciboPDF', $inscripcionID)}}" target="_blank"><button type="submit" class="btn btn-primary float-right" onclick="salir()">Imprimir</button></a>
            </div>
        </div><!-- div content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
@endsection
@section('js')
<script >
  var tabla;
  function salir(){
    window.location.href ="{{route('inscripciones.index')}}";
  }
  function validarmensaje(){
        var mensaje = {{$mensaje}};
        console.log(mensaje);
        if(mensaje == 0){
            
        }else{
            $("#mensajebtn").trigger('click');
        }
    }
    validarmensaje();
    function traerinscripcion(idinscripcion){
      console.log(idinscripcion);
      $.post('{{route("inscripciones.traerinscripcion")}}',{'_token': $('meta[name="csrf-token"]').attr('content'),'id': idinscripcion},function(r){
        console.log(r);
        $("#rutina_id").val(r.rutina_id);
        $("#id_cliente").val(r.cliente_id);
        $("#id_inscripcion").val(r.id);
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
  listar()
  </script>
      
@endsection
