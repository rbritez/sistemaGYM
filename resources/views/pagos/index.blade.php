@extends('layout')

@section('title', 'Pagos')

@section('content')
<h1>Pagos</h1>
<hr>
<form action="{{ route('pagos.store') }}" method="post">
  @csrf
  <div class="form-group">
    <div class="row">
      <div class="col-lg">
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text">Cliente</span>
          </div>
          <select class="form-control selectpicker" name="cliente_id" id="cliente_id" data-live-search="true" required>
            <option value="">Seleccionar...</option>
            @foreach($clientes as $cliente)
            <option value="{{ $cliente->id }}">{{ $cliente->persona->apellido }} {{$cliente->persona->nombre}}</option>
            @endforeach
          </select>
        </div>
      </div>
      <div class="col-lg">
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text">Plan</span>
            </div>
            <select class="form-control" name="plan_id" id='plan_id' required>
              <option value="">Seleccionar...</option>
              @foreach($planes as $plan)
              <option value="{{ $plan->id }}">{{ $plan->descripcion }}</option>
              @endforeach
            </select>
            <input type="hidden" name="cant_meses" id="cant_meses">
          </div>
        </div>
      <div class="col-lg-4">
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text">Cobrar $</span>
          </div>
          <input type="number" name="pago" id="pago" value="00.00">
          <div class="input-group-append">
            <button class="btn btn-primary" type="submit">Cobrar</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</form>
<table class="table" id="tablalistado">
  <thead>
    <tr>
      <th>#</th>
      <th>Cliente</th>
      <th>Plan</th>
      <th>Monto</th>
      <th>Fecha Pago</th>
      <th>Empleado</th>
    </tr>
  </thead>
  <tbody>
    @foreach($pagos as $pago)
      <tr>
        <td>{{ $pago->id }}</td>
        {{-- <td><a href="{{ route('inscripciones.show', $pago->cliente->inscripcion->id) }}">{{$pago->cliente->persona->apellido }} {{ $pago->cliente->persona->nombre }}</a></td> --}}
        <td style="text-transform:capitalize"><a href="">{{$pago->cliente->persona->apellido }} {{ $pago->cliente->persona->nombre }}</a></td>
        <td>{{ $pago->plan->descripcion }}</td>
        <td>${{ $pago->monto }}</td>
        <td>{{ $pago->fecha }}</td>
        <td style="text-transform:capitalize"> {{ $pago->empleado->persona->apellido }} {{ $pago->empleado->persona->nombre }}</td>
      </tr>
    @endforeach
  </tbody>
</table>
@endsection
@section('js')
<script type="text/javascript">
  function init(){
    listar();
    $("#cliente_id").change(ultimoplan);
    $("#plan_id").change(precio);
  }
  function ultimoplan(){
    var idcliente =  $("#cliente_id").val();
    var plan = $("#plan_id").val();
    // dejar select del Plan en blanco 
    if(plan !=""){
      $('#plan_id option[value='+plan+']').attr("selected",false);
    }
  //cargar select del plan con el ultimo plan contratado por el cliente
    $.post("{{route('clientes.ultimoPlan')}}",{
      headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
      "_token":$("meta[name='csrf-token']").attr("content"),
      'id_cliente': idcliente},
      function(r){
        if(r.length>0){
          console.log(r);
          var res = r[0]['plan_id'];
          var precio = r[0]['precio'];
          var cant_meses= r[0]['cant_meses'];
          $('#plan_id option[value='+res+']').attr("selected",true);
          $("#cant_meses").val(cant_meses);
          $("#pago").val(precio);
        }else{
          console.log('nada')
        }
    })
  }
  function precio(){
    var idplan =  $("#plan_id").val();

    $.post("{{route('clientes.precio')}}",{
      headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
      "_token":$("meta[name='csrf-token']").attr("content"),
      'id_plan': idplan},
      function(r){
        $("#pago").val();
        $("#cant_meses").val(r.cant_meses);
        $("#pago").val(r.precio);
        $("#cant_meses").val(r.cant_meses);
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
  
  init();
</script>    
@endsection