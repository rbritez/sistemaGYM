<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Clientes Inactivos PDF</title>
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
<div id="#titulo"><b class="texto">Inactivos</b> <small class="fecha">Informe de la fecha {{date('d/m/Y')}}</small></div>
    <br>
           <table class="table table-striped table-danger table-borderless" align="center">
            <thead>
                <tr>
                    <th>Clientes</th>
                    <th>Inactivo desde</th>
                    <th>Cumpleaños</th>
                    <th>Celular</th>
                    <th>Informar</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($clientes as $item)
                    <tr>
                    <td style="text-transform:capitalize">{{$item->persona->apellido}} {{$item->persona->nombre}}</td>
                    <td>{{date("d/m/Y", strtotime($item->fecha_inactivo))}}</td>
                    <td>{{date("d/m", strtotime($item->persona->fecha_nac))}}</td>
                    <td>{{$item->persona->celular}}</td>
                    <td><div id="cubo">&nbsp;</div></td>
                    </tr>
                @endforeach
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
        left: 260px;
        top: 12px;
        font-style:italic;
        font-size: 40px;
    }
    #titulo, .fecha{
        position:fixed;
        left: 260px;
        top: 65px;
        font-style:italic;

    }
    th, td{
        text-align: center;
    }
</style>
<script src={{asset("js/jquery-3.4.1.min.js")}}></script>
{{-- boostrap 4.0.0 --}}
<script src={{asset("bootstrap/js/bootstrap.min.js")}}></script>
