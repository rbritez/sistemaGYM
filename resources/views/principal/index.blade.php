@extends('layout')

@section('title', 'Inicio')

@section('content')
 <center> <h1><u>Bienvenido al Sistema</u></h1> </center>

<div class="row">
  {{-- aun no se --}}
    <div class="col-log-6 col-md-6 col-sm-12">
        <div class="card border-left-success shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div>
                  <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Ingresos del Dia</div>
                  <div class="h5 mb-0 text-gray-800 font-weight-bold"> $215,000</div>
                </div>
              </div>
              <div class="col-auto"> 
                  <span style="font-size:60px;font-weight:bold;color:rgba(178,178,178,1);">$</span>
                </div>
            </div>
          </div>
        </div>
      </div>
{{-- Ingresos del dia --}}
  <div class="col-log-6 col-md-6 col-sm-12">
    <div class="card border-left-success shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div>
              <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Ingresos del Dia</div>
              <div class="h5 mb-0 text-gray-800 font-weight-bold"> $215,000</div>
            </div>
          </div>
          <div class="col-auto"> 
              <span style="font-size:60px;font-weight:bold;color:rgba(178,178,178,1);">$</span>
            </div>
        </div>
      </div>
    </div>
  </div>
  {{-- Clientes meses --}}
  <div class="col-lg-6 col-md-6 col-sm-12">
    <div style="text-align:center"><h3>Clientes Nuevos Ultimos 2 Meses</h3></div>
    <canvas  id="clientesMensual" width="300" height="170" ></canvas>
  </div>
  {{-- Clientes Constantes --}}
  <div class="col-lg-6 col-md-6">
    <div style="text-align:center"><h3>Clientes Más Constantes</h3></div>
    <div class="row">
        <div class="col-lg-5 col-md-5">
            <canvas  id="clientesConstantes" width="300" height="400"></canvas>
        </div>
        <div class="col-lg-7 col-md-7">
            <table class="table-striped table-sm" id="clientesC" style="font-size: 12px;text-align:center">
                <head>
                  <th>Cliente</th>
                  <th>Fecha Ingreso</th>
                  <th>Cant. Pagos</th>
                  <th>Color</th>
                </head>
                <tbody id="agregarC">

                </tbody>
              </table>      
        </div>
    </div>
  </div>
  {{-- Empleados --}}
  <div class="col-lg-6 col-md-6 col-sm-12">
      <h3>Asistencias de la Semana de Empelados</h3>
      <table id="tbasistencia" class="table table-condensed table-striped table-borderless table-hover nowrap" style="width:100%">
        <thead>
          <tr>
            <th>Empleado</th>
            <th>Fecha</th>
            <th>Turno</th>
          </tr>
        </thead>
        <tbody id="tbody">
          
        </tbody>
      </table>
    </div>
</div>
@endsection
@section('js')
<script>
  var persona;
  var tabla;
 function init(){
  listarasistencias();
  };
  
function listarasistencias(){
  var row=2;
  var col=1;
  $.post('{{route("empleados.asistencias")}}',{'_token': $('meta[name="csrf-token"]').attr('content')},function(r){
    console.log(r)
    persona=r[0].empleado_id;
   
    $("#tbody").append('<tr id="tr'+col+'"><td rowspan="1" style="text-transform:capitalize" id="trr'+col+'">'+r[0].apellido+' '+r[0].nombre+'</td><td>'+r[0].fecha+' '+r[0].hora+'</td><td>'+r[0].turno+'</td></tr>');
    for (let i = 1; i < r.length; i++) {
        if(persona == r[i].empleado_id ){
            $("#trr"+col).attr('rowspan', row);
            $("#tr"+col).after('<tr id="td'+col+row+'"><td>'+r[i].fecha+' '+r[i].hora+'</td><td>'+r[i].turno+'</td></tr>');
            // console.log(row,);
        }else{
          var coll = col + 1;
          var roww = row - 1;
          if($("#td"+col+roww).length){
            $("#td"+col+roww).after('<tr id="tr'+coll+'"><td rowspan="1" style="text-transform:capitalize" id="trr'+coll+'">'+r[i].apellido+' '+r[i].nombre+'</td><td>'+r[i].fecha+' '+r[i].hora+'</td><td>'+r[i].turno+'</td></tr>');
          }else{
            $("#tr"+col).after('<tr id="tr'+coll+'"><td rowspan="1" style="text-transform:capitalize" id="trr'+coll+'">'+r[i].apellido+' '+r[i].nombre+'</td><td>'+r[i].fecha+' '+r[i].hora+'</td><td>'+r[i].turno+'</td></tr>');
          }
          
          col++;
          row=1;
          persona =r[i].empleado_id ;
        }

        row++
    }
  })
}
init();
</script>  
<script>
    var cantidad = [];
    var fecha=[];
    $.post('{{route("clientes.totalMes")}}',{'_token': $('meta[name="csrf-token"]').attr('content')},function(r){
   
      for (let i = 0; i < r.length; i++) {
          fecha.unshift(r[i].fecha);
          cantidad.unshift(r[i].cantidad);
      }
      clientesMes(fecha,cantidad);
    });
    function clientesMes(fecha,cantidad){
      var ctx = document.getElementById('clientesMensual').getContext('2d');
      var ventasMes = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: fecha,
            datasets: [{
                data: cantidad,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    // quitar o agregar mas segun la cantidad de dias
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    // quitar o agregar mas segun la cantidad de dias
                ],
                borderWidth: 1
            }]
        },
        options: {
            legend: {
              display: false
            },
            title: {
              display: true,
              text: 'Clientes de los ultimos dos Meses',
            },
            scales: {
              yAxes: [{
                  scaleLabel:{
                          display:true,
                          labelString:'Cantidad de Clientes',
                      },
                  ticks: {
                  beginAtZero: true,
                  }
              }],
              xAxes:[{
                  scaleLabel:{
                          display:true,
                          labelString:'Fecha en Mes',
                      }
              }],
          }
        }
    });
  
    }
  </script>  
  <script>
    var nombresC = [];
    var pagosC=[];
    var fechaC=[];
      $.post('{{route("clientes.constantes")}}',{'_token': $('meta[name="csrf-token"]').attr('content')},function(r){
        console.log(r);
        var nya = "";

        for (let i = 0; i < r.length; i++) {
            nya= r[i].apellido+' '+r[i].nombre;
            nombresC.unshift(nya);
            pagosC.unshift(r[i].pagos);
            fechaC.unshift(r[i].fecha_ingreso);
        } 
        clientesConstantes(nombresC,pagosC,fechaC);
        listar(r);
      });
      function clientesConstantes(nombresC,pagosC,fechaC){
        var ctx = document.getElementById('clientesConstantes').getContext('2d');
        var ventasMes = new Chart(ctx, {
          type: 'pie',
          data: {
          labels: nombresC,
          datasets: [{
          data: pagosC,
          backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(155, 99, 12, 0.2)',
                'rgba(4, 12, 215, 0.2)',
                'rgba(75, 192, 192, 0.2)'
                // quitar o agregar mas segun la cantidad de dias
            ],
            borderWidth: 1
        }]
    },
          options: {
            legend: {
              display: false
            },
              responsive: true
          }
      });
      }

      function listar(r) {
        var color;
        for (i = 0; i < r.length; i++){
          if(i == 4){
            color = '<span style="padding:5px; color:rgba(0,0,0,0);border-radius:10px; background-color:rgba(255, 99, 132, 0.2)"> color</span>';
          }else if(i == 3){
            color = '<span style="padding:5px; color:rgba(0,0,0,0);border-radius:10px; background-color:rgba(54, 162, 235, 0.2)"> color</span>';
          }else if( i == 2){
            color = '<span style="padding:5px; color:rgba(0,0,0,0);border-radius:10px; background-color:rgba(155, 99, 12, 0.2)"> color</span>';
          }else if( i == 1){
            color = '<span style="padding:5px; color:rgba(0,0,0,0);border-radius:10px; background-color:rgba(4, 12, 215, 0.2)"> color</span>';
          }else{
            color = '<span style="padding:5px; color:rgba(0,0,0,0);border-radius:10px; background-color:rgba(75, 192, 192, 0.2)"> color</span>';
          }
          $("#agregarC").append('<tr>'+
              '<td style="text-transform:capitalize;padding:12px">'+r[i].apellido+' '+r[i].nombre+'</td>'+
              '<td>'+r[i].fecha_ingreso+'</td>'+
              '<td>'+r[i].pagos+'</td>'+
              '<td>'+color+'</td>'+
              '</tr>');
        }
    }
  </script>
 
@endsection