@extends('layout')

@section('title', 'Empleados')

@section('content')
<h1 style="text-transform: capitalize">Ingresos de {{$empleado->persona->apellido}} {{$empleado->persona->nombre}}</h1>
    <hr>
    {{-- <div>
      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal_editEmpleadoo">Crear Empleado</button>
      <a class="btn btn-primary">Ver turnos</a>
      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal_newIngreso">Nuevo Ingreso</button>
    </div> --}}
    @if (isset($FechaInicial))
        <form action="{{route('ingresos.show',$empleado->id)}}" method="GET">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-4">
                    {{-- @csrf --}}
                    {{-- @method('POST') --}}
                <input type="hidden" name="empleado_id" value="{{$empleado->id}}">
                        <label for="">Fecha Inicial</label>
                    <input type="date" class="form-control" value={{$FechaInicial}} name="fechaInicial" id="fechaInicial">
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-4">
                        <label for="">Fecha Final</label>
                    <input type="date" class="form-control" value={{$fechaFinal}} name="fechaFinal" id="fechaFinal">
                </div>
                <div class="col-lg-2 col-md-2 col-sm-12 col-xs-2">
                    <label for="">&nbsp;</label>
                    <button type="submit" class="btn btn-primary btn-block">Filtrar</button>
                </div>
                <div class="col-lg-2 col-md-2 col-sm-12 col-xs-2">
                        <label for="">&nbsp;</label>
                        <button type="button" class="btn btn-success  btn-block" onclick="redirect()">Mostrar Todos</button>
                </div>
            </div>
        </form>
    @else
    <form action="{{route('ingresos.show',$empleado->id)}}" method="GET">
            <div class="row">
                <div class="col-lg-5 col-md-5 col-sm-12 col-xs-5">
                    {{-- @csrf --}}
                    {{-- @method('POST') --}}
                <input type="hidden" name="empleado_id" value="{{$empleado->id}}">
                        <label for="">Fecha Inicial</label>
                    <input type="date" class="form-control" value={{date("Y-m-d")}} name="fechaInicial" id="fechaInicial">
                </div>
                <div class="col-lg-5 col-md-5 col-sm-12 col-xs-5">
                        <label for="">Fecha Final</label>
                    <input type="date" class="form-control" value={{date("Y-m-d")}} name="fechaFinal" id="fechaFinal">
                </div>
                <div class="col-lg-2 col-md-2 col-sm-12 col-xs-2">
                    <label for="">&nbsp;</label>
                    <button type="submit" class="btn btn-primary btn-block">Filtrar</button>
                </div>
            </div>
        </form>
    @endif
   
    <hr>
    @if (isset($FechaInicial))
    <div align="center">
            <span style="text-transform: uppercase">Filtrado desde <b>{{$FechaInicial}}</b> hasta <b>{{$fechaFinal}}</b></span>
    </div>
    <hr>
    @endif
    <div class="table-responsive" id="table_res">
        <table class="table table-bordered table-hover nowrap" id="tablalistado" >
        <thead align="center">
            <tr>
                <th>Acciones</th>
                <th>Fecha/Hora</th>
                <th>Turno</th>
            </tr>
        </thead>
        <tbody align="center">
            @foreach($ingresos as $ingreso)
            <tr>
                <td><button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modal_editEmpleado{{$ingreso->id}}">Editar</button></td>
                <td style="text-transform:capitalize">{{$ingreso->fecha}} {{$ingreso->hora}}</td>
                <td>{{ $ingreso->turno->descripcion }}</td>
            </tr>
            @endforeach
        </table>
    </div>
@foreach ($ingresos as $ingreso)
<div class="modal fade" id="modal_editEmpleado{{$ingreso->id}}"> <!-- modallllllllll-->
    <div class="modal-dialog">
        <div class="modal-content"> <!-- div content --> 
            <div class="modal-warning modal-header " style="background-color:#007BFF">
              <b style="color:white;" id="title_categoria" class="modal-title">EDITAR INGRESO</b>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" style="color:white">&times;</span>
                </button>
                
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        <form  method="POST" action={{route('ingresos.update',$ingreso->id)}} enctype="multipart/form-data">
                            <div class="form-group row">
                                    {{csrf_field()}}
                                    @method('PUT')
                                    <input type="hidden" value={{$empleado->id}} name="empleado_id">
                                    <input type="hidden" value={{$ingreso->id}} name="id_ingreso">
                                    {{-- <input type="hidden" name="id_inscripcion" id="id_inscripcion" value="{{ $inscripcion->id }}" >
                                    <input type="hidden" name="cliente_id" id="cliente_id" value="{{ $inscripcion->cliente->id }}" > --}}
                            </div>
                            <div class="form-group row">
                              <label class="col-sm-4 col-form-label">FECHA</label>
                              <div class="col-sm-8">
                                  <input type="date" name="fecha" class="form-control"  value="{{ $ingreso->fecha }}" required>
                              </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">HORA</label>
                                <div class="col-sm-8">
                                    <input type="time" name="hora" class="form-control" value="{{ $ingreso->hora }}" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">TURNO</label>
                                    <div class="col-sm-8">
                                        <select name="turno_id" class="form-control" required>
                                        @foreach ($turnos as $turno)
                                        @if ($turno->id == $ingreso->turno_id)
                                        <option value="{{$turno->id}}" selected>{{$turno->descripcion}}</option>
                                        @else
                                        <option value="{{$turno->id}}">{{$turno->descripcion}}</option> 
                                        @endif
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
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
@endforeach
   
@endsection
@section('js')
<script>
   var tabla;
  function init(){
    listar();
    $("#fechaInicial").change(filtroFecha);
    $("#fechaFinal").change(filtroFecha);
  }
function filtroFecha(){
    finicial = $("#fechaInicial").val();
    ffinal = $("#fechaFinal").val();
    if(finicial > ffinal){
        alert('La Fecha Inicial no debe ser mayor a la Fecha Final');
        return false;     
    }
}

function redirect(){
    $(location).attr('href',"{{route('ingresos.show',$empleado->id)}}");
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

init()
</script>


    
@endsection