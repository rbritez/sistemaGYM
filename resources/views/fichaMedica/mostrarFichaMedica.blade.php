@extends('layout')

@section('title', 'Ficha Medica - '.$cliente->persona->apellido.' '.$cliente->persona->nombre)

@section('content')
<?php
        $datos="";
        if(isset($fichamedica[0]) && !empty($fichamedica[0])){
            $datos= '{x:'.$fichamedica[0]->altura.',y:'.$fichamedica[0]->peso.'}';
        }
        $datosFecha="";
        $datosPeso="";
        if(isset($fichamedica2[0]) && !empty($fichamedica2[0])){
            foreach ($fichamedica2 as $fm) {
            $datosFecha = $datosFecha.'"'.$newDate = date("d/m/Y", strtotime($fm->fecha)).'",';
            $datosPeso = $datosPeso.$fm->peso.',';
            }
            $datosPeso = substr($datosPeso,0,-1);
            $datosFecha= substr($datosFecha,0,-1);
        }
       
?>
<h1>{{ $cliente->persona->apellido }} {{$cliente->persona->nombre}}</h1>
<hr>
<div>
  <div class="row">
      <div class="col-md-6">
          <canvas id="myChart" width="260" height="170"></canvas>
      </div>
        <div class="col-md-6" style="width:100%">
                    <div class="row">
                            <div class="col-lg-12">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                    <span class="input-group-text">Desde:</span>
                                    </div>
                                    <input type="date" class="form-control" name="fechaI" id="fechaI" value="{{ date('Y-m-d')}}">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Hasta:</span>
                                    </div>
                                    <input type="date" class="form-control" name="fechaF" id="fechaF" value="{{ date('Y-m-d')}}">
                                    <div class="input-group-append">
                                    <button class="btn btn-primary" type="button" onclick="mostrarchart()">Todos</button>
                                    </div>
                                </div>
                            </div>
                        </div>
            <canvas id="myChart1" width="300" height="170"></canvas>
            <canvas id="myChart2" width="300" height="170" style="display:none"></canvas>
            {{-- <img style="width: 100%;margin-left:200px;" src={{asset("img/masacorp.jpg")}} > --}}
        </div>
  </div>
  
    <h2>Ficha Medica</h2>
<br>

<div class="col-md-2 col-lg-2 col-sm-12" style="padding:0px;"><button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#modal_crear_fichamedica">Agregar Revisión</button></div>
<br>
<table class="table">
  <thead>
    <tr>
        <th>Acciones</th>
        <th>Fecha</th>
        <th>Indice m/Corporal</th>
        <th>Peso</th>
        <th>Altura</th>
    </tr>
  </thead>
  <tbody>
  @foreach($fichamedica as $ficha)
      <tr>
        <td><button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modal_editar_fichamedica" onclick="mostrar({{$ficha->id}})"> Editar </button></td>
        <td>{{ $newDate = date("d/m/Y", strtotime($ficha->fecha)) }}</td>
        <td style="text-transform: capitalize;">{{ $ficha->Estadonutricional->descripcion }}</td>
        <td>{{ $ficha->peso }}</td>
        <td>{{ $ficha->altura }}</td>
      </tr>
    @endforeach
  </tbody>
</table>
<hr>
<div class="modal fade" id="modal_crear_fichamedica"> <!-- modallllllllll-->
  <div class="modal-dialog">
      <div class="modal-content"> <!-- div content --> 
          <div class="modal-warning modal-header " style="background-color:#007BFF">
            <b style="color:white;" id="title_categoria" class="modal-title">NUEVA FICHA MEDICA</b>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true" style="color:white">&times;</span>
              </button>
              
          </div>
          <div class="modal-body">
              <div class="row">
                  <div class="col-sm-12">
                      <form action={{route('fichamedica.store')}} method="POST">
                          <div class="form-group row">
                              <label for="inputDate" class="col-sm-4 col-form-label">FECHA</label>
                              <div class="col-sm-8">
                                  {{csrf_field()}}
                                  <input type="hidden" name="cliente_id" id="cliente_id" value="{{ $cliente->id }}" >
                                  <input type="date" name="fecha_revision" class="form-control" id="inputDate" value=<?php echo date('Y-m-d');?> required>
                              </div>
                          </div>
                          <div class="form-group row">
                            <label class="col-sm-4 col-form-label">PESO EN KG</label>
                            <div class="col-sm-8">
                                <input type="number" step="0.1" min="40" name="peso" id="peso" class="form-control" placeholder="70.0" required>
                            </div>
                          </div>
                          <div class="form-group row">
                              <label class="col-sm-4 col-form-label">ALTURA EN CM</label>
                              <div class="col-sm-8">
                                  <input type="number" name="altura" id="altura" step="0.1" min="100" class="form-control" placeholder="170.0"  required>
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
{{-- --------------------------------------------------------------------------------------------------------------------- --}}
<div class="modal fade" id="modal_editar_fichamedica"> <!-- modallllllllll EDITARRR-->
    <div class="modal-dialog">
        <div class="modal-content"> <!-- div content --> 
            <div class="modal-warning modal-header " style="background-color:#007BFF">
              <b style="color:white;" id="title_categoria" class="modal-title">EDITAR FICHA MEDICA</b>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" style="color:white">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        <form action={{route('fichamedica.update',1)}} method="POST">
                            <div class="form-group row">
                                <label for="inputDate" class="col-sm-4 col-form-label">FECHA</label>
                                <div class="col-sm-8">
                                    {{csrf_field()}}
                                    @method('PUT')
                                    <input type="hidden" name="cliente_id" id="cliente_idUpdate" value="{{ $cliente->id }}" >
                                    <input type="hidden" name="fichamedica_id" id="fichamedica_id">
                                    <input type="date" name="fecha_revision" class="form-control" id="fechaUpdate" value='' required>
                                </div>
                            </div>
                            <div class="form-group row">
                              <label class="col-sm-4 col-form-label">PESO EN KG</label>
                              <div class="col-sm-8">
                                  <input type="number" step="0.1" min="40" name="peso" id="pesoUpdate" class="form-control" value="" placeholder="70.0" required>
                              </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">ALTURA EN CM</label>
                                <div class="col-sm-8">
                                    <input type="number" name="altura" id="alturaUpdate" step="0.1" min="100" class="form-control" value="" placeholder="170.0"  required>
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

@endsection
@section('js')
<script>
    function init(){
        $("#fechaI").change(filtrarfecha);
        $("#fechaF").change(filtrarfecha);
    }
        function zfill(number, width) {
        var numberOutput = Math.abs(number); /* Valor absoluto del número */
        var length = number.toString().length; /* Largo del número */
        var zero = "0"; /* String de cero */

        if (width <= length) {
            if (number < 0) {
                return ("-" + numberOutput.toString());
            } else {
                return numberOutput.toString();
            }
        } else {
            if (number < 0) {
                return ("-" + (zero.repeat(width - length)) + numberOutput.toString());
            } else {
                return ((zero.repeat(width - length)) + numberOutput.toString());
            }
        }
    }
    function mostrarchart(){
        var f = new Date();
        var fechahoy = f.getFullYear() + "-" + zfill((f.getMonth() + 1), 2) + "-" + zfill(f.getDate(), 2);
        $("#fechaI").val(fechahoy);
        $("#fechaF").val(fechahoy);

        $("#myChart1").show();
        $("#myChart2").hide();
    }
    function filtrarfecha(){
        var fechaI = $("#fechaI").val();
        var fechaF = $("#fechaF").val();
        var cliente= $("#cliente_id").val();
        console.log(cliente);
        $.post('{{route("fichamedica.filtrarFecha")}}',{'_token': $('meta[name="csrf-token"]').attr('content'),'id':cliente,'fechaI': fechaI, 'fechaF': fechaF},function(r){
            var peso = [];
            var fecha=[];
            for (let i = 0; i < r.length; i++) {
                fecha.unshift(r[i].fecha);
                peso.unshift(r[i].peso);
            }
            chartFiltrado(fecha,peso);
        })
    }
    function chartFiltrado(fecha,peso){

        // ----------------------  chart  ------------------------------------------
        var ctx1 = document.getElementById('myChart2').getContext('2d');
        var myChart = new Chart(ctx1, {
        type: 'line',
        data: {
            labels: fecha,
            datasets: [{
                label: 'Peso en KG',
                data: peso,
                backgroundColor:'rgba(0,123,255, 0.2)',
                borderColor:'rgba(0,123,255, 1)',
                // this dataset is drawn below
                order: 1
        }]
        },
        options: {
            title: {
                        display: true,
                        text: 'Historial de Peso'
                    },
            tooltips: {
                mode: 'nearest'
            },
                scales: {
                    yAxes: [{
                        scaleLabel:{
                                display:true,
                                labelString:'Peso en KG',
                            },
                        ticks: {
                        beginAtZero: true,
                        }
                    }],
                    xAxes:[{
                        scaleLabel:{
                                display:true,
                                labelString:'Fecha de Control',
                            }
                    }],
                }
            }
        });
    // ---------------------- Fin chart  ------------------------------------------
        $("#myChart1").hide();
        $("#myChart2").show();
    }
    function mostrar(id){
        $.post('{{route("fichamedica.mostrar")}}',{'_token': $('meta[name="csrf-token"]').attr('content'),'id': id},function(r){
            console.log(r);
            //   $("#id_cliente").val(r.id);
            $("#fichamedica_id").val(r.id);
            $("#pesoUpdate").val(r.peso)
            $("#alturaUpdate").val(r.altura);
            $("#fechaUpdate").val(r.fecha);
        })
    }

    init();
</script>
<script>
    var ctx = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx, {
      type: 'scatter',
      data: {
          datasets: [{
            label: 'Punto de Peso Actual',
            xAxisID:'x-axis-1',
            yAxisID:'y-axis-1',
            data: [ {{ $datos }} ],
            backgroundColor:'rgba(0,0,0,1)',
            borderColor:'rgba(0,0,0,1)',
            // this dataset is drawn below
            order: 1
      }]
      },
      options: {
                legend: {
                    legendPosition:'left',
                    text: 'default' },
				responsive: true,
				hoverMode: 'nearest',
				intersect: true,
				title: {
					display: true,
					text: 'Estado de Indice de Masa Corporal'
				},
				scales: {
					xAxes: [{
						position: 'bottom',
						gridLines: {
							zeroLineColor: 'rgba(0,0,0,1)'
						},
                        scaleLabel:{
                            display:true,
                            labelString:'Altura en Centimetros',
                        }
					}],
					yAxes: [{
						type: 'linear', // only linear but allow scale type registration. This allows extensions to exist solely for log scale for instance
						display: true,
						position: 'left',
						id: 'y-axis-1',
                        scaleLabel:{
                            display:true,
                            labelString:'Peso en KG',
                        }
					}],
				}
			}
    });
var mixedChart = new Chart(ctx, {
    type: 'scatter',
    data: {
        datasets: [{
            label: 'Punto de Peso Actual',
            xAxisID:'x-axis-1',
            yAxisID:'y-axis-1',
            data: [{{ $datos}}],
            backgroundColor:'rgba(0,0,0,1)',
            borderColor:'rgba(0,0,0,1)',
            // this dataset is drawn below
            order: 1
        }, {
            label: 'Peso Bajo',
            data: [{x:140,y:36.26},{x:150,y:41.625},{x:160,y:47.36},{x:170,y:53.465},{x:180,y:59.94},{x:190,y:66.785},{x:200,y:74},{x:210,y:81.585}],
            type: 'line',
            backgroundColor: 'rgba(71,106,204, 0.8)',
            // this dataset is drawn on top
            order: 2
        },
        {
            label: 'Peso Normal',
            data: [{x:140,y:48.804},{x:150,y:56.025},{x:160,y:63.744},{x:170,y:71.961},{x:180,y:80.679},{x:190,y:89.889},{x:200,y:99.6},{x:210,y:109.809}],
            type: 'line',
            backgroundColor: 'rgba(5,141,76, 0.7)',
            // this dataset is drawn on top
            order: 3
        },{
            label: 'Sobrepeso',
            data: [{x:140,y:58.8},{x:150,y:67.5},{x:160,y:76.8},{x:170,y:86.7},{x:180,y:97.2},{x:190,y:108.3},{x:200,y:120},{x:210,y:132.3}],
            type: 'line',
            backgroundColor: 'rgba(250,184,2, 0.6)',
            // this dataset is drawn on top
            order: 4
        },{
            label: 'Obesidad',
            type:'line',
            backgroundColor:'rgba(255,255,255, 0.0)',
        }],
    },
    options: {
                legend: {
                    legendPosition:'left',
                    text: 'default' },
				responsive: true,
				hoverMode: 'nearest',
				intersect: true,
				title: {
					display: true,
					text: 'Estado de Indice de Masa Corporal'
				},
				scales: {
					xAxes: [{
						position: 'bottom',
						gridLines: {
							zeroLineColor: 'rgba(0,0,0,1)'
						},
                        scaleLabel:{
                            display:true,
                            labelString:'Altura en Centimetros',
                        }
					}],
					yAxes: [{
						type: 'linear', // only linear but allow scale type registration. This allows extensions to exist solely for log scale for instance
						display: true,
						position: 'left',
						id: 'y-axis-1',
                        scaleLabel:{
                            display:true,
                            labelString:'Peso en KG',
                        }
					}],
				}
			}
     });

    var ctx1 = document.getElementById('myChart1').getContext('2d');
    var myChart = new Chart(ctx1, {
      type: 'line',
      data: {
          labels:[ <?php echo $datosFecha ?>],
          datasets: [{
            label: 'Peso en KG',
            data: [{{$datosPeso}}],
            backgroundColor:'rgba(0,123,255, 0.2)',
            borderColor:'rgba(0,123,255, 1)',
            // this dataset is drawn below
            order: 1
      }]
      },
      options: {
        title: {
					display: true,
					text: 'Historial de Peso'
				},
          tooltips: {
            mode: 'nearest'
        },
            scales: {
                yAxes: [{
                    scaleLabel:{
                            display:true,
                            labelString:'Peso en KG',
                        },
                    ticks: {
                    beginAtZero: true,
                    }
                }],
                xAxes:[{
                    scaleLabel:{
                            display:true,
                            labelString:'Fecha de Control',
                        }
                }],
            }
        }
    });


    </script>
    
@endsection
