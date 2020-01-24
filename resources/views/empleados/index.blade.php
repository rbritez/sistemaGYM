@extends('layout')

@section('title', 'Empleados')

@section('content')
<body onLoad="setInterval('dateTimeLocal()',30000);">
    <h1>Empleados</h1>
    <hr>
    <div>
      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal_editEmpleadoo">Crear Empleado</button>
      <a href="{{ route('turnos.index') }}" class="btn btn-primary">Ver turnos</a>
      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal_newIngreso" onclick="turnoauto()">Nuevo Ingreso</button>
    </div>
    <br>
    <div class="table-responsive">
    <table class="table table-bordered table-hover nowrap" id="tablalistado">
      <thead>
        <tr>
            <th>Acciones</th>
          <th>Apellido y Nombre</th>
          <th>DNI</th>
          <th>Domicilio</th>
          <th>Estado</th>
        </tr>
      </thead>
      <tbody>
        @foreach($empleados as $empleado)
          <tr>
            <td>
                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modal_editEmpleado{{$empleado->id}}">Editar</button>
                @if($empleado->estado == '1')
                  <button type="button" class="btn btn-danger" onclick='cambiarestado({{$empleado->id}})'>Deshabilitar</button>
                @else
                  <button type="button" class="btn btn-success" onclick="cambiarestado({{$empleado->id}})">Habilitar</button>
                @endif
                <button type="button" class="btn btn-default"><a href="{{ route('ingresos.show', $empleado->id) }}">Ingresos</a></button>
            </td>
            <td style="text-transform:capitalize">{{$empleado->persona->apellido}} {{ $empleado->persona->nombre }}</td>
            <td>{{ $empleado->persona->dni }}</td>
          <td> @if($empleado->persona->barrio)Barrio {{ $empleado->persona->barrio }} ,@endif @if($empleado->persona->calle)Calle: {{$empleado->persona->calle}},@endif @if($empleado->persona->altura)Nro {{$empleado->persona->altura}},@endif</td>
            @if($empleado->estado == '1')
            <td><b style="color:aliceblue;background-color:darkgreen;padding:5px 11px;border-radius:5px">Activo</b></td>
              @else
              <td><b style="color:aliceblue;background-color: darkred;padding:5px;border-radius:5px">Inactivo</b></td>
            @endif 
          </tr>
        @endforeach
      </tbody>
    </table>
    </div>
    
    <div class="modal fade" id="modal_newIngreso"> <!-- modallllllllll-->
      <div class="modal-dialog">
          <div class="modal-content"> <!-- div content --> 
              <div class="modal-warning modal-header " style="background-color:#007BFF">
                <b style="color:white;" id="title_categoria" class="modal-title">NUEVO INGRESO</b>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true" style="color:white">&times;</span>
                  </button>
                  
              </div>
              <div class="modal-body">
                  <div class="row">
                      <div class="col-sm-12">
                          <form  method="POST" action="{{ route('ingresos.store') }}" method="post">
                              <div class="form-group row">
                                      {{csrf_field()}}
                                      {{-- <input type="hidden" name="id_inscripcion" id="id_inscripcion" value="{{ $inscripcion->id }}" >
                                      <input type="hidden" name="cliente_id" id="cliente_id" value="{{ $inscripcion->cliente->id }}" >  --}}
                               </div>
                              <div class="form-group row">
                                <label class="col-sm-4 col-form-label">EMPLEADO</label>
                                <div class="col-sm-8">
                                <select name="empleado_id" class="form-control" required>
                                  <option value="">Seleccionar...</option>
                                  @foreach ($empleados as $empleado)
                                <option style="text-transform:capitalize" value={{$empleado->id}}>{{$empleado->persona->apellido}} {{$empleado->persona->nombre}}</option>
                                  @endforeach
                                </select>
                                </div>
                              </div>
                              <div class="form-group row">
                                  <label class="col-sm-4 col-form-label">TURNO</label>
                                  <div class="col-sm-8">
                                    <select name="turno_id" class="form-control" id="turnonew" required>
                                      <option value="">Seleccionar...</option>
                                      @foreach ($turnos as $turno)
                                    <option value={{$turno->id}}>{{$turno->descripcion}}</option>
                                      @endforeach
                                    </select>
                                  </div>
                              </div>
                              <div class="form-group row">
                                <label class="col-sm-4 col-form-label" >FECHA</label>
                                <div class="col-sm-8">
                                    <input type="date" name="fecha" class="form-control" id="Ddate" required readonly>
                                </div>
                              </div>
                              <div class="form-group row">
                                  <label class="col-sm-4 col-form-label" >HORA</label>
                                  <div class="col-sm-8">
                                      <input type="time" name="hora" class="form-control" id="DTime" required readonly>
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
    
    {{-- MODAL NUEVO EMPLEADO --}}
    <div class="modal fade" id="modal_editEmpleadoo"> <!-- modallllllllll-->
      <div class="modal-dialog modal-lg">
          <div class="modal-content"> <!-- div content --> 
              <div class="modal-warning modal-header " style="background-color:#007BFF">
                <b style="color:white;" id="title_categoria" class="modal-title">NUEVO EMPLEADO</b>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true" style="color:white">&times;</span>
                  </button>
                  
              </div>
              <div class="modal-body">
                  <div class="row">
                      <div class="col-sm-12">
                          <form  method="POST" action="{{ route('empleados.store') }}" method="post">
                              <div class="form-group row">
                                      {{csrf_field()}}
                                      {{-- <input type="hidden" name="id_inscripcion" id="id_inscripcion" value="{{ $inscripcion->id }}" >
                                      <input type="hidden" name="cliente_id" id="cliente_id" value="{{ $inscripcion->cliente->id }}" >  --}}
                               </div>
                              <div class="form-group row">
                                  <div class="col-sm-6">
                                <label class=" col-form-label">NOMBRE</label>
                                <input type="text" name="nombre" class="form-control" required>
                                </div>
                         
                                  <div class="col-sm-6">  
                                    <label class=" col-form-label">APELLIDO</label>
                                    <input type="text" name="apellido"  class="form-control" required>
                                  </div>
                                  <div class="col-sm-6">
                                    <label class="col-form-label">DNI</label>
                                    <input type="text" name="dni" class="form-control"  required>
                                </div>
                                <div class="col-sm-6">
                                  <label  class="col-form-label">Celular</label>
                                  <input type="text" name="celular" class="form-control" placeholder="3704000000" required>
                                </div>
                                <div class="col-sm-6">
                                    <label class="col-form-label">Email</label>
                                    <input type="email" name="email" class="form-control" placeholder="ejemplo@ejemplo.com">
                                </div>
                                <div class="col-sm-6">
                                  <label class="col-form-label">Sexo</label>
                                  <select name="sexo" id="sexo" class="form-control" required>
                                    <option value="">Seleccionar...</option>
                                    <option value="h">Hombre</option>
                                    <option value="m">Mujer</option>
                                  </select>
                                </div>
                                <div class="col-sm-6">
                                  <label class="col-form-label">Barrio</label>
                                  <input type="text" name="barrio" class="form-control" placeholder="San Martin" >
                                </div>
                                <div class="col-sm-6">
                                  <label class="col-form-label">Calle</label>
                                  <input type="text" name="calle" class="form-control" placeholder="España">
                                </div>
                                  <div class="col-md-4">
                                      <div class="form-group">
                                        <label>Altura</label>
                                        <input type="text" name="altura" class="form-control" placeholder="1532">
                                      </div>
                                    </div>
                                    <div class="col-md-4">
                                      <div class="form-group">
                                        <label>Nro Dpto</label>
                                        <input type="text" name="nro_dpto" class="form-control" placeholder="12A">
                                      </div>
                                    </div>
                                      <div class="col-md-4">
                                        <div class="form-group">
                                          <label>Nro Piso</label>
                                          <input type="text" name="nro_piso" class="form-control" placeholder="2">
                                        </div>
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
    
    
    
    
    @foreach ($empleados as $empleado)
    
    <div class="modal fade" id="modal_editEmpleado{{$empleado->id}}"> <!-- modallllllllll-->
      <div class="modal-dialog">
          <div class="modal-content"> <!-- div content --> 
              <div class="modal-warning modal-header " style="background-color:#007BFF">
                <b style="color:white;" id="title_categoria" class="modal-title">EDITAR EMPLEADO</b>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true" style="color:white">&times;</span>
                  </button>
                  
              </div>
              <div class="modal-body">
                  <div class="row">
                      <div class="col-sm-12">
                          <form  method="POST" action={{route('empleados.update',$empleado->id)}} enctype="multipart/form-data">
                              <div class="form-group row">
                                      {{csrf_field()}}
                                      {{method_field('PUT')}}
                                      @method('PUT')
                                      <input type="hidden" value={{$empleado->id}} name="id">
                                      {{-- <input type="hidden" name="id_inscripcion" id="id_inscripcion" value="{{ $inscripcion->id }}" >
                                      <input type="hidden" name="cliente_id" id="cliente_id" value="{{ $inscripcion->cliente->id }}" > --}}
                              </div>
                              <div class="form-group row">
                                  <div class="col-sm-6">
                                <label class=" col-form-label">NOMBRE</label>
                                <input type="text" name="nombre" class="form-control" value="{{$empleado->persona->nombre}}" required>
                                </div>
                         
                                  <div class="col-sm-6">  
                                    <label class=" col-form-label">APELLIDO</label>
                                    <input type="text" name="apellido"  class="form-control" value="{{$empleado->persona->apellido}}" required>
                                  </div>
                                  <div class="col-sm-6">
                                    <label class="col-form-label">DNI</label>
                                    <input type="text" name="dni" class="form-control" value="{{$empleado->persona->dni}}"  required>
                                </div>
                                <div class="col-sm-6">
                                  <label  class="col-form-label">Celular</label>
                                  <input type="text" name="celular" class="form-control" value="{{$empleado->persona->celular}}" placeholder="3704000000" required>
                                </div>
                                <div class="col-sm-6">
                                    <label class="col-form-label">Email</label>
                                    <input type="email" name="email" class="form-control" value="{{$empleado->persona->email}}" placeholder="ejemplo@ejemplo.com">
                                </div>
                                <div class="col-sm-6">
                                  <label class="col-form-label">Sexo</label>
                                  <select name="sexo" id="sexo" class="form-control" required>
                                    @if($empleado->persona->sexo =='m'){
                                      <option value="m" selected>Mujer</option>
                                      <option value="h">Hombre</option>
                                    @else
                                    <option value="m">Mujer</option>
                                    <option value="h" selected>Hombre</option>
                                    @endif
                                    
                                    
                                  </select>
                                </div>
                                <div class="col-sm-6">
                                  <label class="col-form-label">Barrio</label>
                                  <input type="text" name="barrio" class="form-control" value="{{$empleado->persona->barrio}}" placeholder="San Martin" >
                                </div>
                                <div class="col-sm-6">
                                  <label class="col-form-label">Calle</label>
                                  <input type="text" name="calle" class="form-control" value="{{$empleado->persona->calle}}" placeholder="España">
                                </div>
                                  <div class="col-md-4">
                                      <div class="form-group">
                                        <label>Altura</label>
                                        <input type="text" name="altura" class="form-control" value="{{$empleado->persona->altura}}" placeholder="1532">
                                      </div>
                                    </div>
                                    <div class="col-md-4">
                                      <div class="form-group">
                                        <label>Nro Dpto</label>
                                        <input type="text" name="nro_dpto" class="form-control" value="{{$empleado->persona->nro_dpto}}" placeholder="12A">
                                      </div>
                                    </div>
                                      <div class="col-md-4">
                                        <div class="form-group">
                                          <label>Nro Piso</label>
                                          <input type="text" name="nro_piso" class="form-control" value="{{$empleado->persona->nro_piso}}" placeholder="2">
                                        </div>
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
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->


@endforeach
</body>
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
        //     // url: "http://localhost/gimnasiooctubre/public/index.php/empleados,
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
function turnoauto(){
  var date = new Date();
  var hora = date.getHours();
 
  if(hora <14){
    $("#turnonew").val(7);
  }else if( hora < 19){
    $("#turnonew").val(8);
  }else{
    $("#turnonew").val(9);
  }
}
function cambiarestado(idd){
  $.ajax({
    headers: {'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')},
    // url: "{{route('empleadodestroy', $empleado->id)}}",
    url: "http://localhost/gimnasiooctubre/public/index.php/empleados/destroy/"+ idd,
    type:'POST',
    data: {'key': 'value',"_token": "{{ csrf_token() }}",empleado_id : idd},
    dataType: "text",
    contentType: false,
    processData: false,
        //si se ejecuta de manera correcta ,pasa a la siguiente instancia
    success: function(datos) {
     location.reload();
    }
  
  })

}
function dateTimeLocal(){
    var inputDTime = $("#DTime");
    var inputDdate = $("#Ddate");
    var dateTime = new Date();
    var mes = (dateTime.getMonth() +1);
    var dia = dateTime.getDate();
    var hora = dateTime.getHours();
    var minuto = dateTime.getMinutes();
  // condicional mes
    if(mes < '10'){
      newmes = '0'+mes;
    }else{
      newmes = mes;
    }
    // condicional dia
    if(dia < '10'){
      newday = '0'+dia;
    }else{
      newday = dia;
    }
    // condicional hora
    if(hora < '10'){
      newhora = '0'+hora;
    }else{
      newhora = hora;
    }
    // condicional minuto
    if(minuto < '10'){
      newminuto = '0'+minuto;
    }else{
      newminuto = minuto;
    }
    fechaActual = dateTime.getFullYear() + "-" + newmes + "-" + newday;
    horaActual = newhora+":"+ newminuto;
    inputDTime.val(horaActual);
    inputDdate.val(fechaActual);
  }
listar()
dateTimeLocal();
</script>


    
@endsection