@extends('layout')

@section('title', 'Rutinas')

@section('content')
  <h1>Rutinas</h1>
  <hr>
  <button class="btn btn-primary" id="btnmostrarform" onclick="mostrarform(1)"> Nueva Rutina Estandar</button>

  <div id="formularioRutina" style="display:none">
    <form name="formulario" id="formulario" method="POST">
    <div class="row">
      <div class="col-md-4 col-sm-12">
        @csrf
          <div class="form-group">
            <input type="hidden" name="rutina_id" id="rutina_id" value="">
              <label >NOMBRE</label>
              <div class="">
                  <input type="text" name="nombre_rutina" class="form-control" id="nombre_rutina"  value=""  required>
              </div>
            </div>
      </div>
      <div class="col-md-4 col-sm-12">
          <div class="form-group">
              <label>DIFICULTAD</label>
              <div class="">
                  <select name="dificultad" id="dificultad" class="form-control" required>
                  <option value="">Seleccionar...</option>
                  <option value="principiante">PRINCIPIANTE</option>
                  <option value="amateur">AMATEUR</option>
                  <option value="profesional">PROFESIONAL</option>
                  </select>
              </div>
          </div>
      </div>  
        
            <div class="form-group col-md-4 col-sm-12">
                <label>N° DE DIAS SEMANALES</label>
                <div class="">
                    <select name="nro_dias" id="nro_dias" class="form-control"  required>
                      <option value="">Seleccionar...</option>
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                      <option value="5">5</option>
                      <option value="6">6</option>
                      <option value="7">7</option>
                    </select>
                </div>
            </div>
            <div id="tabledias"  class="col-md-12">
             
            </div>
      </div>
      <button type="button" class="btn btn-danger" onclick="mostrarform(0)">VOLVER</button>
      <button type="submit" class="btn btn-primary float-right">GUARDAR</button>
    </form>
    <br>
  </div>{{-- fin formulario rutina --}}

    <div id="pantallaPrincipal">
        <hr>
        <div class="flex-nowrap table-nowrap table-responsive-lg table-responsive nowrap">
          <table id="rutinass" class=" table-hover table-striped nowrap flex-nowrap flex-lg-nowrap" align="center">
              <thead align="center">
                <tr>
              <th>Acciones</th>
              <th>Descripción</th>
              <th>Dificultad</th>
              <th>Cantidad de Dias</th>
              <th>Estado</th>
                </tr>
              </thead>
              <tbody style="text-transform: capitalize" align="center">
                <tr>
                  <td></td>
                  <td></td>
                  <td></td>
                </tr>
              </tbody>
          </table>
        </div>
      
    </div>   {{-- fin pantalla principal --}}

</div>

<div class="modal fade" id="modal_ver_ejercicios"> <!-- modallllllllll-->
  <div class="modal-dialog" >
      <div class="modal-content"> <!-- div content --> 
          <div class="modal-warning modal-header " style="background-color:#007BFF">
            <b style="color:white;" id="title_ejercicio" class="modal-title">EJERCICIOS DE RUTINA </b>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true" style="color:white">&times;</span>
              </button>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-md-12 col-sm-12 ">
                <div id="listadoEjerciciosRutina">

                </div>
              </div><!-- col-md-12 -->
            </div> <!-- row -->
          </div>
          <div class="modal-footer ">
            <div class="col-lg-6">
                <button type="button" class="btn btn-danger float-left" data-dismiss="modal" onclick="limpiarejercicios()">Volver</button>
            </div>
            <div class="col-lg-6"></div>              
          </div>
      </div><!-- div content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

  <div class="modal fade" id="modal_nuevo_ejercicio"> <!-- modallllllllll-->
    <div class="modal-dialog modal-lg" style="width:65% !important;">
        <div class="modal-content"> <!-- div content --> 
            <div class="modal-warning modal-header " style="background-color:#007BFF">
              <b style="color:white;" id="title_ejercicio" class="modal-title">SELECCIONAR PARTE A EJERCITAR</b>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" style="color:white">&times;</span>
                </button>
                
            </div>
            <div class="modal-body">
                      <div id="principal-modal">
                          <form action="" method="get">
                              <div class="row">
                                  <div class="col-md-3 col-lg-3 col- col-sm-3 col-xs-3">
                                    <input type="hidden" id="diaSeleciconado" value="">
                                    <button type="button" class="btn btn-default btn-block" style="color:white; font-size:12px; margin:7px;padding:2px 15px" onclick="listarEjercicios(1)"
                                        <p><img src="{{asset('img/abdominales.png')}}"  class="rounded-circle"  width="80" height="70" alt=""></p>
                                        <b>ABDOMINALES</b>
                                    </button>
                                  </div>
                                  <div class="col-md-3 col-lg-3 col- col-sm-3 col-xs-3">
                                    <button type="button" class="btn btn-default btn-block" style="color:white; font-size:12px; margin:7px;padding:2px 15px" onclick="listarEjercicios(6)">
                                        <p><img src="{{asset('img/pechos.png')}}" class="rounded-circle" width="80" height="70" alt=""></p>
                                        <b>PECHO</b>
                                    </button>
                                  </div>
                                  <div class="col-md-3 col-lg-3 col- col-sm-3 col-xs-3">
                                      <button type="button" class="btn btn-default btn-block" style="color:white; font-size:12px; margin:7px;padding:2px 15px" onclick="listarEjercicios(2)">
                                          <p><img src="{{asset('img/espalda.png')}}" class="rounded-circle" width="80" height="70" alt=""></p>
                                          <b>ESPALDA</b>
                                      </button>
                                  </div>
                                  <div class="col-md-3 col-lg-3 col- col-sm-3 col-xs-3">
                                      <button type="button" class="btn btn-default btn-block" style="color:white; font-size:12px; margin:7px;padding:2px 19px" onclick="listarEjercicios(5)">
                                          <p><img src="{{asset('img/piernas.png')}}" class="rounded-circle" width="80" height="70" alt=""></p>
                                          <b>PIERNAS</b>
                                      </button>
                                  </div>
                                  <div class="col-md-3 col-lg-3 col- col-sm-3 col-xs-3">
                                      <button type="button" class="btn btn-default btn-block" style="color:white; font-size:12px; margin:7px;padding:2px 15px" onclick="listarEjercicios(3)">
                                          <p><img src="{{asset('img/biceps.png')}}" class="rounded-circle" width="80" height="70" alt=""></p>
                                          <b>BICEPS</b>
                                      </button>
                                  </div>
                                  <div class="col-md-3 col-lg-3 col- col-sm-3 col-xs-3">
                                      <button type="button" class="btn btn-default btn-block" style="color:white; font-size:12px; margin:7px;padding:2px 15px" onclick="listarEjercicios(3)">
                                          <p><img src="{{asset('img/triceps.png')}}" class="rounded-circle" width="80" height="70" alt=""></p>
                                          <b>TRICEPS</b>
                                      </button>
                                  </div>
                                  <div class="col-md-3 col-lg-3 col- col-sm-3 col-xs-3">
                                      <button type="button" class="btn btn-default btn-block" style="color:white; font-size:12px; margin:7px;padding:2px 15px" onclick="listarEjercicios(7)">
                                          <p><img src="{{asset('img/pantorrillas.png')}}" class="rounded-circle" width="80" height="70" alt=""></p>
                                          <b>PANTORRILLAS</b>
                                      </button>
                                  </div>
                                  <div class="col-md-3 col-lg-3 col- col-sm-3 col-xs-3">
                                      <button type="button" class="btn btn-default btn-block" style="color:white; font-size:12px; margin:7px;padding:2px 15px" onclick="listarEjercicios(8)">
                                          <p><img src="{{asset('img/hombros.png')}}" class="rounded-circle" width="80" height="70" alt=""></p>
                                          <b>HOMBROS</b>
                                      </button>
                                  </div>
                                  <div class="col-md-3 col-lg-3 col- col-sm-3 col-xs-3">
                                    <button type="button" class="btn btn-default btn-block" style="color:white; font-size:12px; margin:7px;padding:2px 15px" onclick="listarEjercicios(9)">
                                      <p> <img src="{{asset('img/gluteos.jpg')}}" alt=""  class="rounded-circle" width="80" height="70" ></p>
                                        <b>GLUTEOS</b>
                                    </button>
                                  </div>
                                  <div class="col-md-3 col-lg-3 col- col-sm-3 col-xs-3">
                                    <button type="button" class="btn btn-default btn-block" style="color:white; font-size:12px; margin:7px;padding:2px 18px" onclick="listarEjercicios(10)">
                                        <p><img src="{{asset('img/antebrazos.png')}}" alt=""  class="rounded-circle" width="80" height="70" ></p>
                                        <b>ANTEBRAZOS</b>
                                    </button>
                                  </div>
                                  <div class="col-md-3 col-lg-3 col- col-sm-3 col-xs-3">
                                    <button type="button" class="btn btn-default btn-block" style="color:white; font-size:12px; margin:7px;padding:2px 15px" onclick="listarEjercicios(11)">
                                        <p><img src="{{asset('img/todo.png')}}" alt="" class="rounded-circle" width="80" height="70" ></p>
                                        <b>TODOS</b>
                                    </button>
                                  </div>
                                </div>  
                              </form>
                      </div> <!-- principal modal -->
                          <div  id="table-ejercicios-mostrar" style="display:none;">
                            <div class="row">
                              <div class="col-md-12 col-sm-12  table-responsive">
                                  <table class="nowrap table-bordered table-striped" id="table-ejercicios" >
                                      <thead>
                                        <tr>
                                            <th>ACCION</th>
                                            <th>EJERCICIOS</th>
                                            <th>MAQUINA UTILIZADA</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                      </tbody>
                                    </table>
                                    <button type="button" id="btn-volver-ejercicio" onclick="mostrarformejercicios(0)" class="btn btn-default">Volver</button>
                              </div><!-- col-md-12 -->
                            </div> <!-- row -->
                          </div> <!--  table-ejercicios-mostrar-->
            </div>
            <div class="modal-footer ">
              <div class="col-lg-6">
                  <button type="button" class="btn btn-danger float-left" data-dismiss="modal" onclick="mostrarformejercicios(0)">Cancelar</button>
              </div>
              <div class="col-lg-6">
                {{-- <button type="submit" class="btn btn-primary float-right"> Guardar</button> --}}
              </div>
                
            </div>
            </form>
        </div><!-- div content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
@endsection
@section('js')
    <script >
    function init(){
      $("#formulario").on("submit", function(e) {
        guardaryeditar(e);
      })
      listarrutina();
      $("#nro_dias").change(agregardias);
    }
    function verejercicios(id){
      $.post('{{route("rutinas.traerdias")}}',{'_token': $('meta[name="csrf-token"]').attr('content'),'id': id},function(r){
        console.log(r);
        for (let index = 0; index < r.length; index++) {
          $("#listadoEjerciciosRutina").append('<div id="mostrardias"style="background-color:lightskyblue;color:white;border-radius:7px;padding:10px 10px 13px 10px;">'+
                                                  '<b>Dia '+ r[index].dia+'</b>'+
                                                '</div>'+
                                              '<div id="mdiaejercicio" >'+
                                                '<table class="table" align="center">'+
                                                  '<thead align="center">'+
                                                    '<th>Ejercicio</th>'+
                                                    '<th>Series/Repeticiones</th>'+
                                                  '</thead>'+
                                                '<tbody id="filtroejeDia'+r[index].dia+'" align="center">'+
                                                '</tbody>'+
                                               '</table>'+
                                              '</div>');
          $.post('{{route("rutinas.traerejerciciosfiltro")}}',{'_token': $('meta[name="csrf-token"]').attr('content'),'nro_dia': r[index].dia,'idrutina':id},function(rr){
    
              for (let res = 0; res < r.length; res++) {
                $("#filtroejeDia"+r[index].dia).append('<tr><td>'+rr[res].descripcion+'</td><td>'+rr[res].series+'/'+rr[res].repeticiones+'</td><tr>');
                
              }  
            
          });
        }
      })
    }
    function limpiarejercicios(){
      $("#listadoEjerciciosRutina").html('');
    }
    function mostrarform(flag){
      if(flag == 1){
        $("#pantallaPrincipal").hide();
        $("#btnmostrarform").hide();
        $("#formularioRutina").show();
        // $("#nombre_rutina").prop('required', true);
        // $("#dificultad").prop('required', true);
        // $("#nro_dias").prop('required', true);
      }else{
        // $("#nombre_rutina").prop('required', false);
        // $("#dificultad").prop('required', false);
        // $("#nro_dias").prop('required', false);
        $("#pantallaPrincipal").show();
        $("#btnmostrarform").show();
        $("#formularioRutina").hide();
        limpiar();
      }
    }
    function limpiar(){
      $("#nro_dias").val("");
      $("#dificultad").val("");
      $("#nombre_rutina").val("");
      $("#tabledias").html('');
      $("#rutina_id").val("");
    }
    var cant=0;
    function agregardias(){
      if($("#diaas").length){
              //si ya existen dias agregar dias nuevos
              cant = parseInt($("#nro_dias").val()) + 1;
              for (let index = 1; index < cant; index++) {
                if($('#dia'+[index]).length){
                    }else{
                      $("#tabledias").append('<div class="diaas"><div id="dia'+[index]+'" style="background-color:lightskyblue;color:white;border-radius:7px;padding:10px 10px 13px 10px;" class=" form-group col-md-12 cantdia">'+
                      '<b style="font-size:25px">DIA '+[index]+'</b> <button type="button" class="btn btn-primary float-right" data-toggle="modal" onclick="selectdia('+[index]+')" data-target="#modal_nuevo_ejercicio">Agregar Ejercicio</button>'+
                      '</div><input type="hidden" name="dia[]" value="'+[index]+'">'+
                        '<table class="table" id="tableejercicio'+[index]+'">'+
                          '<thead>'+
                            '<th>EJERCICIOS DEL DIA '+[index]+'</th>'+
                            '<th>CANTIDAD DE SERIES</th>'+
                            '<th>CANTIDAD DE REPETICIONES</th>'+
                            '<th>ACCION</th>'+
                          '</thead>'+
                          '<tbody id="tablebody'+[index]+'">'+
                          '</tbody>'+
                        '</table>'+
                      '</div>');
                    }
              }//fin del for            
                    //eliminar dias de mas
                    var noSelect = parseInt($("#nro_dias").val());
                    for (let index = 7; index > noSelect; index--) {
                          //si hay mas dias de los seleccionados , se eliminan de mayor a menor
                          if($('#dia'+[index]).length){
                              $("#dia"+[index]).remove();
                              $("#tableejercicio"+[index]).remove();
                          }
                    }//fin del for
      }else{
          //si no existen dias , crear por primera vez
          cant = parseInt($("#nro_dias").val()) + 1;
          for (let index = 1; index < cant; index++) {
            $("#tabledias").append('<div id="diaas"><div id="dia'+[index]+'" style="background-color:lightskyblue;color:white;border-radius:7px;padding:10px 10px 13px 10px;" class=" form-group col-md-12 cantdia">'+
              '<b style="font-size:25px">DIA '+[index]+'</b> <button type="button" class="btn btn-primary float-right" data-toggle="modal" onclick="selectdia('+[index]+')" data-target="#modal_nuevo_ejercicio">Agregar Ejercicio</button>'+
              '</div> <input type="hidden" name="dia[]" value="'+[index]+'">'+
              '<table class="table" id="tableejercicio'+[index]+'">'+
                '<thead>'+
                  '<th>EJERCICIOS DEL DIA '+[index]+'</th>'+
                  '<th>CANTIDAD DE SERIES</th>'+
                  '<th>CANTIDAD DE REPETICIONES</th>'+
                  '<th>ACCION</th>'+
                '</thead>'+
                '<tbody id="tablebody'+[index]+'">'+
                  
                '</tbody>'+
              '</table>'+
              '</div>');
            }//fin del for
      }

    }
    function listarEjercicios(idsectorcorp){
      console.log(idsectorcorp);
      var dia = $("#diaSeleciconado").val();

      tabla = $('#table-ejercicios').dataTable({ //mediante la propiedad datatable enviamos valores
  
        "responsive": {
            "details": true,
        },
        "aProcessing": true, //Activamos el prcesamiento del datatable
        "aServerSide": true, //Paginacion y filtrado realizado por el servidor
        dom: 'Bfrtip', //Definimos los elementos del control de tabla
        buttons: [], //botones para exportar 

        "ajax": {
            url: "{{route('rutina.filtrarejercicio')}}",
            type: "post",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data:{'sector_corp_id': idsectorcorp, 'dia' : dia},
            dataType: "json",
            error: function(e) {
                console.log(e.responseText)
            }
        },
        "bDestroy": true,
        "iDisplayLength": 5, //paginacion cada 5 registros
        "order": [
                [0, "desc"]
            ] //orden de listado , columna 0, el id de categoria

      }).dataTable();
      mostrarformejercicios(1);
    }
    function selectdia(nro_dia){
      console.log('dia nro: '+nro_dia);
      $("#diaSeleciconado").val(nro_dia);
    }
    function mostrarformejercicios(flag){
      if(flag ==1){
        $("#title_ejercicio").text('SELECCIONAR EJERCICIOS');
        $("#principal-modal").hide();
        $("#table-ejercicios-mostrar").show();
        $("#btn-volver-ejercicio").show();
      }else{
        $("#title_ejercicio").text('SELECCIONAR PARTE A EJERCITAR');
        $("#principal-modal").show();
        $("#table-ejercicios-mostrar").hide();
        $("#btn-volver-ejercicio").hide();
      }
    }
    function agregarejercicio(dia,idejercicio,descripcion){
      console.log('dia seleccionado : '+dia+', idejercicio: ' +idejercicio+', descripcion: '+descripcion);
      $("#tablebody"+dia).append('<tr id="tr'+dia+''+idejercicio+'"><td><input type="hidden" name="ejercicio_id'+dia+'[]" value="'+idejercicio+'">'+descripcion+'</td>'+
      '<td ><input class="form-control" name="serie'+dia+'[]" type="number" min="1" max="50" required></td>'+
      '<td ><input class="form-control" name="repeticion'+dia+'[]" type="number" min="1" max="250" required></td>'+
      '<td><button type="button" class="btn btn-danger" onclick="eliminarejercicio('+dia+''+idejercicio+')">Quitar</button></td></tr>');
    }
    function eliminarejercicio(idtr){
      $("#tr"+idtr).remove();
    }
    //funcion para guardar y editar
    function guardaryeditar(e) {
      e.preventDefault(); //No se activara la accion predeterminada del evento
      var formData = new FormData($("#formulario")[0]); //obtengo los datos del fomulario
      $.ajax({
          url: "{{route('rutinas.store')}}",
          type: "POST",
          data: formData,
          contentType: false,
          processData: false,
          //si se ejecuta de manera correcta ,pasa a la siguiente instancia
          success: function(datos) {

              if (datos == 1) {
                alert('Se guardaron los datos con exito!');
              }else if(datos == 2){
                alert('Se Actualizaron los datos con exito!');
              }else if (datos == 0) {
                alert('Resultado Inconcluso', 'Hubo un error al guardar');
              } 
              $('#rutinass').dataTable().api().ajax.reload();
              limpiar();
              mostrarform(0);
          }
      });
    }
    function cambiarestado(idrutina){
      $.post('{{route("rutinas.cambiarestado")}}',{'_token': $('meta[name="csrf-token"]').attr('content'),'id': idrutina},function(r){
        console.log(r);
        alert('Actualizado con Exito!');
        $('#rutinass').dataTable().api().ajax.reload();
      })
    }
    function listarrutina(){
      tabla = $('#rutinass').dataTable({ //mediante la propiedad datatable enviamos valores
        
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
                    url: "{{route('rutina.listarrutina')}}",
                    type: "get",
                    dataType: "json",
                    error: function(e) {
                        console.log(e.responseText)
                    }
                },
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

    function mostrarEdit(idrutina){      
      mostrarform(1);
      $.post('{{route("rutinas.editRutina")}}',{'_token': $('meta[name="csrf-token"]').attr('content'),'idrutina': idrutina},function(r){
        // console.log(r);
        $("#nombre_rutina").val(r.descripcion);
        $("#dificultad").val(r.dificultad);
        $("#nro_dias").val(r.nro_dias);
        $("#rutina_id").val(r.id);

        agregardias();
        $.post('{{route("rutinas.editEjercicios")}}',{'_token': $('meta[name="csrf-token"]').attr('content'),'idrutina': idrutina},function(r){
          // console.log(r);
          for (let i = 0; i < r.length; i++) {
                $("#tablebody"+r[i].dia).append('<tr id="tr'+r[i].dia+''+r[i].ejercicio_id+'"><td><input type="hidden" name="ejercicio_id'+r[i].dia+'[]" value="'+r[i].ejercicio_id+'">'+r[i].descripcion+'</td>'+
                '<td ><input class="form-control" name="serie'+r[i].dia+'[]" type="number" min="1" max="50" value="'+r[i].series+'" required></td>'+
                '<td ><input class="form-control" name="repeticion'+r[i].dia+'[]" type="number" min="1" max="250" value="'+r[i].repeticiones+'" required></td>'+
                '<td><button type="button" class="btn btn-danger" onclick="eliminarejercicio('+r[i].dia+''+r[i].ejercicio_id+')">Quitar</button></td></tr>');
          }
          //fin for
        })
      
      })
    }
    init();
    </script>
@endsection


{{--   <h1>Rutinas</h1>
  <table class="table">
    <thead>
      <tr>
        <th>Descripción</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <form action="{{ route('rutinas.store') }}" method="POST">
          @csrf
          <td>
            <input type="text" class="form-control" placeholder="Rutina" name="descripcion">
          </td>
          <td>
            <button type="submit" class="btn btn-success">Crear</button>
          </td>
        </form>
      </tr>
      @foreach($rutinas as $rutina)
        <tr>
          <form action="{{ route('rutinas.update', $rutina->id) }}" method="POST">
            @csrf
            @method('PUT')
            <td>
              <input type="text" class="form-control" placeholder="Rutina" name="descripcion" value="{{ $rutina->descripcion }}">
            </td>
            <td>
              <a href="{{ route('rutinas.show', $rutina->id) }}" class="btn btn-primary">Ver maquinas</a>
              <button type="submit" class="btn btn-success">Editar</button>
              <button type="submit" class="btn btn-danger" form="delete-form-{{ $rutina->id }}">Eliminar</button>
            </td>
          </form>
          <form action="{{ route('rutinas.destroy', $rutina->id) }}" method="POST" id="delete-form-{{ $rutina->id }}">
            @csrf
            @method('DELETE')
          </form>
        </tr>
      @endforeach
    </tbody>
  </table> --}}