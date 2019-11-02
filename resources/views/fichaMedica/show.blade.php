@extends('layout')

@section('title', 'Inscripcion - '.$inscripcion->cliente->persona->apellido_nombre)

@section('content')
<h1>{{ $inscripcion->cliente->persona->apellido_nombre }}</h1>
<hr>
<div>
    <div style=" width: 100%;">
        <img style=" width: 60%; margin-left:500px ;
        " src="../../resources/img/masacorp.jpg" >
    </div>
    <h2>Ficha Medica</h2>
<br>

<a  class="btn btn-primary btn-block col-sm-2" data-toggle="modal" data-target="#modal_crear_fichamedica">Agregar Revisión</a>
<br>
<table class="table">
  <thead>
    <tr>
      <th>Fecha</th>
      <th>Indice m/Corporal</th>
      <th>Peso</th>
      <th>Altura</th>
      <th>talla</th>
    </tr>
  </thead>
  <tbody>
  @foreach($fichamedica as $ficha)
      <tr>
      <td>{{ $newDate = date("d-m-Y", strtotime($ficha->fecha)) }}</td>
      <td style="text-transform: capitalize;">{{ $ficha->Estadonutricional->descripcion }}</td>
      <td>{{ $ficha->peso }}</td>
      <td>{{ $ficha->altura }}</td>
      <td>{{ $ficha->talla }}</td>
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
                              <label for="inputDate" class="col-sm-2 col-form-label">FECHA</label>
                              <div class="col-sm-10">
                                  {{csrf_field()}}
                                  <input type="hidden" name="id_inscripcion" id="id_inscripcion" value="{{ $inscripcion->id }}" >
                                  <input type="hidden" name="cliente_id" id="cliente_id" value="{{ $inscripcion->cliente->id }}" >
                                  <input type="date" name="fecha_revision" class="form-control" id="inputDate" value=<?php echo date('Y-m-d');?> required>
                              </div>
                          </div>
                          <div class="form-group row">
                            <label class="col-sm-2 col-form-label">PESO</label>
                            <div class="col-sm-10">
                                <input type="number" step="0.1" min="40" name="peso" id="peso" class="form-control" placeholder="70.0" required>
                            </div>
                          </div>
                          <div class="form-group row">
                            <label class="col-sm-2 col-form-label">TALLA</label>
                            <div class="col-sm-10">
                                <input type="number" name="talla" id="talla" step="0.1" min="40" class="form-control" placeholder="40.0"  required>
                            </div>
                          </div>
                          <div class="form-group row">
                              <label class="col-sm-2 col-form-label">ALTURA</label>
                              <div class="col-sm-10">
                                  <input type="number" name="altura" id="altura" step="0.1" min="100" class="form-control" placeholder="170.0"  required>
                              </div>
                            </div>
                          <div class="form-group row">
                            <label class="col-sm-2 col-form-label">INDICE M/CORP</label>
                            <div class="col-sm-10">
                                <select name="estado_nutricional_id" id="estado_nutricional_id" class="form-control">
                                    <option value="" >Seleccionar... </option>
                                  @foreach($estadoNutricional as $estado)
                                    <option value={{ $estado->id }}>{{ $estado->descripcion }}</option>
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

@endsection
{{-- <script src="../../js/charts/" type="text/javascript">
    $(document).ready(function(){
        $('select').material_select();
    });
</script> --}}
 