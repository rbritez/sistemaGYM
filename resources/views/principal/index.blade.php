@extends('layout')

@section('title', 'Inicio')

@section('content')
 <center> <h1><u>Bienvenido al Sistema</u></h1> </center>

<div class="row">
  {{-- aun no se --}}
    <div class="col-log-6 col-md-6 col-sm-12" style="margin-top:5px;margin-bottom:5">
        <div class="card border-left-success shadow h-100 py-2" style="box-shadow: 2px 2px 5px gray ">
          <div class="card-body">
              <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Ingresos del Dia</div>
                        <div class="h5 mb-0 text-gray-800 font-weight-bold" id="montoDia"> -------- </div>
                    </div>
                    <div class="col-auto"><span style="font-size:60px;font-weight:bold;color:rgba(178,178,178,1);">$</span></div>
              </div>
          </div>
        </div>
    </div>
{{-- Ingresos del dia --}}
  <div class="col-log-6 col-md-6 col-sm-12" style="margin-top:5px;margin-bottom:15;">
    <div class="card border-left-success shadow h-100 py-2" style="box-shadow: 2px 2px 5px gray ">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div>
              <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Medir Indice de Masa Corporal</div>
              <div class="h5 mb-0 text-gray-800 font-weight-bold">
                  <div class="row">
                      <div class="col-lg-10 col-sm-10">
                          <div class="input-group">
                              <div class="input-group-prepend">
                              <span class="input-group-text">Peso:</span>
                              </div>
                              <input type="number" class="form-control" min="0" max="250" id="peso">
                              <div class="input-group-prepend">
                                  <span class="input-group-text">Altura:</span>
                              </div>
                              <input type="number" class="form-control" min="0" max="250"  id="altura">
                              <div class="input-group-append">
                              <button class="btn btn-primary" type="button" onclick="ResultadoIMC()">Medir</button>
                              </div>
                          </div>
                          <small style="font-style: italic; font-size:12px" id="resultado" class="text-primary">Para que el cálculo sea correcto Ingrese Peso en Kg y Altura en Cm.</small><br>
                          <small id="infoadd" class="text-info" style="font-style:italic;font-size:12px;display:none"></small>
                      </div>
                  </div>
              </div>
            </div>
          </div>
          <div class="col-auto"> 
          <img src="{{asset('img/img.png')}}" width="70" height="70" alt="">
            </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-12 col-md-12 col-sm-12">
    <h3 style="text-align:center;margin-top:10px">Clientes Activos con Plan Caducado</h3>
      <table class="table table-danger table-striped" style="color:white">
        <thead>
        <tr align="center"><th colspan="3" align="center"><a href="{{route("clientes.index")}}" style="color:white"> VER CLIENTES -></a></th></tr>
          <tr>
            <th>Cliente</th>
            <th>Contacto</th>
            <th>Fin del Plan</th>
          </tr>
        </thead>
        <tbody id="tablecaducado">

        </tbody>
      </table>
  </div>
  {{-- Clientes meses --}}
  <div class="col-lg-6 col-md-6 col-sm-12">
      <div style="margin-top:5px;margin-bottom:15;">
          <div class="card border-left-success shadow h-100 py-2" style="box-shadow: 2px 2px 5px gray;padding:15px; ">
            <div style="text-align:center"><h3>Clientes Nuevos Ultimos 2 Meses</h3></div>
            <canvas  id="clientesMensual" width="300" height="190" ></canvas>
          </div>
      </div>    
  </div>
  {{-- Clientes Constantes --}}
  <div class="col-lg-6 col-md-6 col-sm-12">
      <div style="margin-top:5px;margin-bottom:15;">
          <div class="card border-left-success shadow h-100 py-2" style="box-shadow: 2px 2px 5px gray;padding:10px; ">
              <div style="text-align:center;"><h3>Clientes Más Regulares</h3></div>
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
      </div>
  </div>
  {{-- Empleados --}}
  <div class="col-lg-12 col-md-12 col-sm-12">
      <h3 style="text-align:center;margin-top:10px">Asistencias de la Semana de Empelados</h3>
      <table id="tbasistencia" class="table table-condensed table-striped table-borderless table-hover nowrap" style="width:100%">
        <thead>
          <tr>
            <th>FECHA</th>
            <th>EMPLEADO</th>
            <th>CANT. TURNOS</th>
          </tr>
        </thead>
        <tbody id="tbody">
          
        </tbody>
      </table>
    </div>
</div>
<br>
<hr>
<br>
@endsection
@section('js')
<script>
  $.post('{{route("clientes.activosfinplan")}}',{'_token': $('meta[name="csrf-token"]').attr('content')},function(r){
    console.log(r);
    for (let i = 0; i < r.length; i++) {
      const element = r[i];
      $("#tablecaducado").append('<tr>'+
        '<td>'+r[i].apellido+' '+r[i].nombre +'</td>'+
        '<td>'+r[i].contacto+'</td>'+
        '<td>'+r[i].fin_plan+'</td>'+
        '</tr>');
      
    }
  });
</script>
<script>
  function ResultadoIMC(){
    mostrarINFOADD(0);
    var peso = parseFloat($("#peso").val());
    var altura = parseFloat($("#altura").val());
    var alturaC = ((altura/100)*(altura/100));
    var minimoIdeal = 21.2;
    var maximoIdeal = 22.2;
    var normalMAX = 24.9;
    var normalMIN = 18.6;
    
    if($("#peso").val() ==""){
      alert('Complete Todos los Campos');
     return;
    }
    if($("#altura").val() ==""){
      alert('Complete Todos los Campos');
     return;
    }
    if( peso > 250){
      alert('Ingrese datos Validos');
     return;
    }
    if(altura > 250){
      alert('Ingrese datos Validos');
     return;
    }
    //CALCULOS//
    /* 
    PMI = peso minimo ideal
    PMXI = peso maximo ideal
    PSB = peso a subir 
    NMAX = nomral maximo;
    NMIN = normal minimo;
    KGBMMI = KG para alcanzar peso minimo ideal
    KGPMXI = KG para alcanzar peso maximo ideal
    */
    PMI= parseFloat(alturaC * minimoIdeal).toFixed(1);
    PMXI = parseFloat(alturaC*maximoIdeal).toFixed(1);
    NMAX = parseFloat(alturaC*normalMAX).toFixed(1);
    NMIN = parseFloat(alturaC*normalMIN).toFixed(1);
    KGPMI= 0;
    KGPMXI= 0;
    bajarNORMAL = parseFloat(peso- NMAX).toFixed(1); //PARA ENTRAR EN EL RANGO DE PESO NORMAL, SI LA PERSONA ES PESO SUPERIOR
    bajarIDEAL = parseFloat(peso-PMXI ).toFixed(1);
    //CALCULOS//
    subirNORMAL= parseFloat(NMIN-peso).toFixed(1);
    subirIDEAL= parseFloat(PMI-peso ).toFixed(1); 
    resultado = peso / ((altura/100)*(altura/100));
    if(resultado < 18.5){ 
      $("#resultado").removeAttr('class');
      $("#resultado").attr('class','text-warning');
      $("#resultado").html('Estas por debajo del Peso Normal,<b>Puedes Crecer!! Solo te faltan unos Kg más. <a onclick="mostrarINFOADD(1)" id="vermas" href="#">Ver Más</a></b>');
      $("#infoadd").html('Tu Peso Normal se encuentra entre <b>'+NMIN+'</b> y <b>'+NMAX+'</b> Kg.'+
      '<br>Tu Peso Ideal se encuentra entre <b>'+PMI+'</b> y <b>'+PMXI+'</b> Kg.'+
      '<br>Debes Subir al menos <b>'+subirNORMAL+'</b> Kg para alcanzar tu peso Normal.'+
      '<br>Debes Subir al menos <b>'+subirIDEAL+'</b> Kg para alcanzar tu peso Ideal. <b><a onclick="mostrarINFOADD(0)" href="#">Ver Menos</a></b>');
    }else if(resultado < 24.99){
      $("#resultado").removeAttr('class');
      $("#resultado").attr('class','text-success');
      $("#resultado").html('Estas dentro del rango de Peso Normal, <b>Bien Hecho!! Sigue asi. <a onclick="mostrarINFOADD(1)" id="vermas" href="#">Ver Más</a></b>')
        if( PMXI >= peso  && peso >= PMI){
          $("#infoadd").html('Tu Peso Normal se encuentra entre <b>'+NMIN+'</b> y <b>'+NMAX+'</b> Kg.'+
          '<br>Tu Peso Ideal se encuentra entre <b>'+PMI+'</b> y <b>'+PMXI+'</b> Kg.'+
          '<br>Estas en tu peso Ideal..Continua así!. Toma mucha agua y has ejercicios.<b><a onclick="mostrarINFOADD(0)" href="#">Ver Menos</a></b>');
        }else if(PMXI < peso){
          $("#infoadd").html('Tu Peso Normal se encuentra entre <b>'+NMIN+'</b> y <b>'+NMAX+'</b> Kg.'+
          '<br>Tu Peso Ideal se encuentra entre <b>'+PMI+'</b> y <b>'+PMXI+'</b> Kg.'+
          '<br>Estas Bien, pero si bajas <b>'+bajarIDEAL+'</b> Kg llegaras a tu peso ideal.<br>Continua así!. Toma mucha agua y has ejercicios.<b><a onclick="mostrarINFOADD(0)" href="#">Ver Menos</a></b>');
        }else if(peso < PMI){
          $("#infoadd").html('Tu Peso Normal se encuentra entre <b>'+NMIN+'</b> y <b>'+NMAX+'</b> Kg.'+
          '<br>Tu Peso Ideal se encuentra entre <b>'+PMI+'</b> y <b>'+PMXI+'</b> Kg.'+
          '<br>Estas Bien, pero si subes <b>'+subirIDEAL+'</b> Kg llegaras a tu peso ideal.<br>Continua así!. Toma mucha agua y has ejercicios.<b><a onclick="mostrarINFOADD(0)" href="#">Ver Menos</a></b>');
        }else{
          $("#infoadd").html('Tu Peso Normal se encuentra entre <b>'+NMIN+'</b> y <b>'+NMAX+'</b> Kg.'+
          '<br>Tu Peso Ideal se encuentra entre <b>'+PMI+'</b> y <b>'+PMXI+'</b> Kg.<b><a onclick="mostrarINFOADD(0)" href="#">Ver Menos</a></b>')
      };
    }else if(resultado < 29.99){
      $("#resultado").removeAttr('class');
      $("#resultado").attr('class','text-warning');
      $("#resultado").html('Estas por encima del Peso Normal, <b>Puedes Mejorar!! Solo estás con unos Kg de más.  <a onclick="mostrarINFOADD(1)" id="vermas" href="#">Ver Más</a></b>');
      $("#infoadd").html('Tu Peso Normal se encuentra entre <b>'+NMIN+'</b> y <b>'+NMAX+'</b> Kg.'+
      '<br>Tu Peso Ideal se encuentra entre <b>'+PMI+'</b> y <b>'+PMXI+'</b> Kg.</b>'+
      '<br>Debes Bajar al menos <b>'+bajarNORMAL+'</b> Kg para alcanzar tu peso Normal.'+
      '<br>Debes Bajar al menos <b>'+bajarIDEAL+'</b> Kg para alcanzar tu peso Ideal. <b><a onclick="mostrarINFOADD(0)" href="#">Ver Menos</a></b>');
    }else{
      $("#resultado").removeAttr('class');
      $("#resultado").attr('class','text-danger');
      $("#resultado").html('Estas en el rango de Obecidad,<b>Para tu Salud te recomendamos empezar una dieta!!. <a onclick="mostrarINFOADD(1)" id="vermas" href="#">Ver Más</a></b>');
      $("#infoadd").html('Tu Peso Normal se encuentra entre <b>'+NMIN+'</b> y <b>'+NMAX+'</b> Kg.'+
      '<br>Tu Peso Ideal se encuentra entre <b>'+PMI+'</b> y <b>'+PMXI+'</b> Kg.'+
      '<br>Debes Bajar al menos <b>'+bajarNORMAL+'</b> Kg para alcanzar tu peso Normal.'+
      '<br>Debes Bajar al menos <b>'+bajarIDEAL+'</b> Kg para alcanzar tu peso Ideal. <b><a onclick="mostrarINFOADD(0)" href="#">Ver Menos</a></b>');
    }
  }
  function mostrarINFOADD(flag){
    if(flag == 1){
      $("#infoadd").show();
      $("#vermas").hide();
    }else{
      $("#infoadd").hide();
      $("#vermas").show();
    }
    
  }
</script>
<script>
      $.post('{{route("pagos.montoDia")}}',{'_token': $('meta[name="csrf-token"]').attr('content')},function(r){
        if( r.length > 0){
          if(r[0].ingreso != null){
            $("#montoDia").text('$ '+ r[0].ingreso);
          }
        }
      });

</script>
<script>
  var persona;
  var tabla;
 function init(){
  listarasistencias();
  };
  
function listarasistencias(){
  var row=2;
  var col=1;
  var nroreg=1;
  $.post('{{route("empleados.asistencias")}}',{'_token': $('meta[name="csrf-token"]').attr('content')},function(r){

    //verificar existencia de datos
    if(r.length > 0){
      fechaa=r[0].fechaa;
      $("#tbody").append('<tr id="tr'+col+'"><td rowspan="1" id="trr'+col+'">'+r[0].fechaa+'</td><td  style="text-transform:capitalize">'+r[0].apellido+' '+r[0].nombre+'</td><td>'+r[0].turnos+'</td></tr>');
      for (let i = 1; i < r.length; i++) {

          if(fechaa == r[i].fechaa ){
              $("#trr"+col).attr('rowspan', row);
              $("#tr"+col).after('<tr id="td'+col+nroreg+'"><td>'+r[i].apellido+' '+r[i].nombre+'</td><td>'+r[i].turnos+'</td></tr>');
            row++;
            nroreg++;
          }else{  
            var coll = col + 1;
            // if(nroreg == 3){
            //   var roww = nroreg - 2;
            // }else if(nroreg == 2){
            //   var roww = nroreg -1;
            // }else{
            //   var roww = nroreg;
            // }
            roww = 1;

            if($("#td"+col+roww).length){
              $("#td"+col+roww).after('<tr id="tr'+coll+'"><td rowspan="1" id="trr'+coll+'">'+r[i].fechaa+'</td><td style="text-transform:capitalize">'+r[i].apellido+' '+r[i].nombre+'</td><td>'+r[i].turnos+'</td></tr>');
             
              }else{
              $("#tr"+nroreg).after('<tr id="tr'+coll+'"><td rowspan="1" id="trr'+coll+'">'+r[i].fechaa+'</td><td  style="text-transform:capitalize">'+r[i].apellido+' '+r[i].nombre+'</td><td>'+r[i].turnos+'</td></tr>');
              } 
              col++;
              nroreg=1;
              fechaa = r[i].fechaa;
              row = 2;
          }
     
      } // FIN FOREACH
    }// FIN PRIMER IF
    
  });
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