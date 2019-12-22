<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Nota de Credito PDF</title>
     {{-- bootstraop 4.0.0 --}}
  <link rel="stylesheet" href={{asset("bootstrap/css/bootstrap.min.css")}}>
</head>
<body style="width:100%">
    <div id="encabezado">
        <div class="row">
            <div class="col-sm-12">
                <img src="{{asset("img/logoGYM.jpg")}}" width="100" height="100" />
            </div>
            <div class="col-sm-3 float-right" id="info" >
                <div class="sm-12"><u>Contactos:</u></div>
                <div class="sm-12"><b>Celular:</b> 3704759863</div>
                <div class="sm-12"><b>E-mail:</b> RBGym@gmail.com</div>
                <div class="sm-12"><u>Dirección:</u></div>
                <div class="sm-12">San Martin 15 - Ciudad de Formosa</div>
            </div>
        </div>
    </div>
<div id="#titulo"><b class="texto">Comprobante de Plan</b> <small class="fecha">Fecha: {{date('d/m/Y')}}</small> <small class="comprobante">Nota de Crédito Nro: 00{{$notaCredito->id}} </small> </div>
    <br>
        
            <table class="table table-striped" align="center">
                    <thead>
                        
                        <tr style="background-color:rgba(92,164,255, 0.2)"><th colspan="5"> DATOS DEL CLIENTE</th></tr>
                        <tr> 
                            <th>Nro Cliente</th>   
                            <th>Nombre y Apellido</th>
                            <th>Fecha de Nacimiento</th>
                            <th>Contacto</th>
                            <th>Fecha de Ingreso</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                        <td>00{{$pago->cliente->id}}</td>
                        <td style="text-transform:capitalize">{{$pago->cliente->persona->apellido}} {{ $pago->cliente->persona->nombre}}</td>
                        <td>{{date('d/m/Y', strtotime($pago->cliente->persona->fecha_nac))}}</td>
                        <td>{{$pago->cliente->persona->celular}}</td>
                        <td>{{date('d/m/Y',strtotime($pago->cliente->fecha_ingreso))}}</td>
                        </tr>
                    </tbody>
            </table>
           <br>
           <table class="table table-striped table-danger" align="center">
            <thead>
                <tr style="background-color:rgba(92,164,255, 0.2)"><th colspan="4"> DATOS DEL PLAN CANCELADO</th></tr>
                <tr>    
                    <th>Plan</th>
                    <th>Inicio del Plan</th>
                    <th>Fin del Plan</th>
                    <th>Monto</th>
                </tr>
            </thead>
            <tbody>
                    <tr>
                        <td>{{$notaCredito->planclienteANT->plan->descripcion}}</td>
                        <td>{{date('d/m/Y',strtotime($notaCredito->planclienteANT->fecha_inicio))}}</td>
                        <td>{{date('d/m/Y',strtotime($notaCredito->planclienteANT->fecha_fin))}}</td>
                        <td>$ {{$notaCredito->monto_pANT}}</td>
                    </tr>
            </tbody>
           </table>
           <br>
           <table class="table table-striped" align="center">
            <thead>
                <tr style="background-color:rgba(92,164,255, 0.2)"><th colspan="4"> DATOS DEL PLAN VIGENTE</th></tr>
                <tr>    
                    <th>Plan</th>
                    <th>Inicio del Plan</th>
                    <th>Fin del Plan</th>
                    <th>Monto</th>
                </tr>
            </thead>
            <tbody>
                    <tr>
                        <td>{{$notaCredito->planclienteACT->plan->descripcion}}</td>
                        <td>{{date('d/m/y',strtotime($notaCredito->planclienteACT->fecha_inicio))}}</td>
                        <td>{{ date('d/m/Y',strtotime($notaCredito->planclienteACT->fecha_fin)) }}</td>
                        <td>$ {{$notaCredito->planclienteACT->plan->precio}}</td>
                    </tr>
            </tbody>
           </table>
           <table class="table table-striped table-success">
                <tbody>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td style="text-align:right">SALDO DISPONIBLE:</td>
                            <td style="text-align:center;width:112px">$ {{$saldo->monto_saldo}}</td>
                        </tr>
                </tbody>
               </table>
           <table class="table table-striped table-info">
            <tbody>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td style="text-align:right">MONTO TOTAL:</td>
                        <td style="text-align:center;width:112px">$ {{$notaCredito->monto }}</td>
                    </tr>
            </tbody>
           </table>
    </div>
   
</body>
</html>
{{-- <script type="text/php">
    if ( isset($pdf) ) {

        $x = 260;
        $y = 750;
        $text = "Pagína {PAGE_NUM} de {PAGE_COUNT}";
        $font = $fontMetrics->get_font("Arial", "bold");
        $size = 12;
        $color = array(0,0,0);
        $word_space = 0.0;  // default
        $char_space = 0.0;  // default
        $angle = 0.0;   // default
        $pdf->page_text($x, $y, $text, $font, $size, $color, $word_space, $char_space, $angle);
       
    }
</script>  --}}
{{-- jquery --}}
<style>
    #cubo{
        margin: auto;
        background-color: white;
        width: 20px;
        height: 20px;
        border: 1px solid black;
        text-align: center;
   
    }
    #encabezado{
        background-color: rgba(92,164,255, 0.2);
    }
    #info{
        font-size: 12px;
        font-family: Arial;
        font-style: italic;
    }
    #titulo{
        position: absolute;
    }
    #titulo, .texto{
        position:fixed;
        left: 200px;
        top: 12px;
        font-style:italic;
        font-size: 25px;
    }
    #titulo, .fecha{
        position:fixed;
        left: 160px;
        top: 60px;
        font-style:italic;
        font-size: 14px;

    }
}
    #titulo, .comprobante{
        position:fixed;
        left: 340px;
        top: 60px;
        font-style:italic;
        font-size: 14px;

    }
    th, td{
        text-align: center;
    }
</style>
<script src={{asset("js/jquery-3.4.1.min.js")}}></script>
{{-- boostrap 4.0.0 --}}
<script src={{asset("bootstrap/js/bootstrap.min.js")}}></script>
