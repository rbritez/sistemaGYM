<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Rutina.PDF</title>
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
    <div id="#titulo"><b class="texto">Rutina</b></div>
            @foreach ( $dias as  $dia)
            <br>
            <div style="background-color:rgba(92,164,255, 0.2),width:10%">Dia {{$dia->dia}} </div>

                    <table  style="width:100%" class="table-striped"> 
                            <thead> 
                                <tr>
                                    <th style="width:70%">Ejercicios</th>
                                    <th>Series</th>
                                    <th>Repeticiones</th>
                                </tr>
                            </thead>
                            <tbody style="font-size:12px;">
                                @foreach ($ejercicios as $item)
                                    @if ($item['id_dia'] == $dia->id)
                                        <tr>
                                        <td style="width:70%">{{$item['descripcion']}}</td>
                                        <td>{{$item['series']}}</td>
                                        <td>{{$item['repeticiones']}}</td>
                                        </tr>
                                    @else
                                        
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
            @endforeach
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
        left: 280px;
        top: 12px;
        font-style:italic;
        font-size: 40px;
    }
</style>
<script src={{asset("js/jquery-3.4.1.min.js")}}></script>
{{-- boostrap 4.0.0 --}}
<script src={{asset("bootstrap/js/bootstrap.min.js")}}></script>
