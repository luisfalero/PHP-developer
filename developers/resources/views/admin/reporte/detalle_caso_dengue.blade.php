@extends('admin.layouts.base')

@section('content')

<!-- top tiles -->
<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel animate">
      <div class="x_title">
        <h2>Detalle de Casos con Dengue</h2>

        <div class="clearfix"></div>
      </div>

      <small class="pull-right">
        @if($elementos["revisado"] == 'I')
        {!! Form::open(['url'=>'/reporte/revisar_caso/'.$elementos["id"], 'class' => 'form-horizontal'] ) !!}
          <button class="btn btn-info btn-xs"><i class="fa fa-check-square"></i> Revisado </button>
        {!! Form::close() !!}
        @endif
      </small>

      <div class="x_content">
        <div class="form-group col-md-6 col-sm-12 col-xs-12">
          <label for="email">Fecha Registro:</label>
          <input type="text" class="form-control" readonly="readonly" value="{{ $elementos['fecha_registro'] }}">
        </div>
        <div class="form-group col-md-6 col-sm-12 col-xs-12">
          <label for="pwd">DNI:</label>
          <input type="text" class="form-control" readonly="readonly" value="{{ $elementos['dni'] }}">
        </div>
       
        <div class="form-group col-md-6 col-sm-12 col-xs-12">
          <label for="email">Nombre y Apellido:</label>
          <input type="text" class="form-control" readonly="readonly" 
          value="{{ $elementos['nombre'].' '.$elementos['apellido_materno'].' '.$elementos['apellido_paterno'] }}">
        </div>
        <div class="form-group col-md-6 col-sm-12 col-xs-12">
          <label for="pwd">Celular:</label>
          <input type="text" class="form-control" readonly="readonly" value="{{ $elementos['celular'] }}">
        </div>

        <div class="form-group col-md-6 col-sm-12 col-xs-12">
          <label for="email">Departamento:</label>
          <input type="text" class="form-control" readonly="readonly" value="{{ mb_convert_case($elementos->departamento, MB_CASE_TITLE, "UTF-8") }}">
        </div>
        <div class="form-group col-md-6 col-sm-12 col-xs-12">
          <label for="pwd">Provincia:</label>
          <input type="text" class="form-control" readonly="readonly" value="{{ mb_convert_case($elementos->provincia, MB_CASE_TITLE, "UTF-8") }}">
        </div>

        <div class="form-group col-md-6 col-sm-12 col-xs-12">
          <label for="email">Distrito:</label>
          <input type="text" class="form-control" readonly="readonly" value="{{ mb_convert_case($elementos->distrito, MB_CASE_TITLE, "UTF-8") }}">
        </div>

        <div class="form-group col-md-6 col-sm-12 col-xs-12">
          <label for="email">Enfermedad:</label>
          <input type="text" class="form-control" readonly="readonly" value="{{ $elementos['enfermedad'] }}">
        </div>
        <div class="form-group col-md-6 col-sm-12 col-xs-12">
          <label for="pwd">Resultado del Sistema:</label>
          <input type="text" class="form-control" readonly="readonly" value="{{ $elementos['estado'] }}">
        </div>

        
        <div class="form-group col-md-6 col-sm-12 col-xs-12" style="display: none;">
          
          <label for="email">Resultado Final:</label>

          @if($elementos["estado_especialista"] == '')
          {!! Form::open(['url'=>'/reporte/revisar_caso_especialista/'.$elementos["id"],
          'class' => 'form-horizontal'] ) !!}
          <div>
            <div class="col-md-10 col-sm-12 col-xs-12" style="padding: 0;">
              <select id="cb_resultado_especialista" class="form-control" name="cb_resultado_especialista">
                  <!--<option value="dengue_ss">SOSPECHA DENGUE SIN SÍNTOMAS DE ALARMA</option>
                  <option value="denge_cs">SOSPECHA DENGUE CON SÍNTOMAS DE ALARMA</option>-->
                  <option value="denge">DENGUE</option>
                  <option value="sin_dengue">SIN DENGUE</option>
              </select>
            </div>
            <div class="col-md-2 col-sm-12 col-xs-12" style="margin-top: 4px">
              <button class="btn btn-info btn-xs"><i class="fa fa-check-square"></i> Confirmar </button>
            </div>
          </div>
          {!! Form::close() !!}
          @else
          <input type="text" class="form-control" readonly="readonly" value="{{ $elementos['estado_especialista'] }}">
          @endif
        </div>

        <table class="table table-bordered">
          <thead>
            <tr>
              <th width="10%">#</th>
              <th width="70%">Pregunta</th>
              <th width="20%">Respuesta(s)</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>1</td>
              <td>¿Ha sufrido alguna picadura en las últimas dos semanas?</td>
              <td id="r_1">
                <script type="text/javascript">
                  var valor = '<?php echo  $elementos["respuesta_1"]; ?>';
                  var valor_json = JSON.parse(valor);
                  var retorno = (valor_json[0]["si"] == 'A') ? "Si" : "No";
                  $("#r_1").html(retorno);
                </script>
              </td>
            </tr>

            <tr>
              <td>2</td>
              <td>¿Sospecha que le haya picado un mosquito / zancudo?</td>
              <td id="r_2">
                <script type="text/javascript">
                  var valor = '<?php echo  $elementos["respuesta_2"]; ?>';
                  var valor_json = JSON.parse(valor);
                  var retorno = (valor_json[0]["r_1"] == 'A') ? "Si" : "No";
                  $("#r_2").html(retorno);
                </script>
              </td>
            </tr>
            <tr>
              <td>3</td>
              <td>¿Actualmente presenta fiebre?</td>
              <td id="r_3">
                <script type="text/javascript">
                  var valor = '<?php echo  $elementos["respuesta_2"]; ?>';
                  var valor_json = JSON.parse(valor);
                  var retorno = (valor_json[0]["r_2"] == 'A') ? "Si" : "No";
                  $("#r_3").html(retorno);
                </script>
              </td>
            </tr>

            <tr>
              <td>4</td>
              <td>¿Ha notado manchas rojas en su piel?</td>
               <td id="r_4">
                <script type="text/javascript">
                  var valor = '<?php echo  $elementos["respuesta_3"]; ?>';
                  var valor_json = JSON.parse(valor);
                  var retorno = (valor_json[0]["r_1"] == 'A') ? "Si" : "No";
                  $("#r_4").html(retorno);
                </script>
              </td>
            </tr>
            <tr>
              <td>5</td>
              <td>¿Ha presentado dolor de cabeza?</td>
               <td id="r_5">
                <script type="text/javascript">
                  var valor = '<?php echo  $elementos["respuesta_3"]; ?>';
                  var valor_json = JSON.parse(valor);
                  var retorno = (valor_json[0]["r_2"] == 'A') ? "Si" : "No";
                  $("#r_5").html(retorno);
                </script>
              </td>
            </tr>
            <tr>
              <td>6</td>
              <td>¿Ha presentado dolor en los ojos?</td>
               <td id="r_6">
                <script type="text/javascript">
                  var valor = '<?php echo  $elementos["respuesta_3"]; ?>';
                  var valor_json = JSON.parse(valor);
                  var retorno = (valor_json[0]["r_3"] == 'A') ? "Si" : "No";
                  $("#r_6").html(retorno);
                </script>
              </td>
            </tr>
            <tr>
              <td>7</td>
              <td>¿Ha presentado dolor muscular?</td>
               <td id="r_7">
                <script type="text/javascript">
                  var valor = '<?php echo  $elementos["respuesta_3"]; ?>';
                  var valor_json = JSON.parse(valor);
                  var retorno = (valor_json[0]["r_4"] == 'A') ? "Si" : "No";
                  $("#r_7").html(retorno);
                </script>
              </td>
            </tr>
            <tr>
              <td>8</td>
              <td>¿Ha presentado dolor de huesos?</td>
               <td id="r_8">
                <script type="text/javascript">
                  var valor = '<?php echo  $elementos["respuesta_3"]; ?>';
                  var valor_json = JSON.parse(valor);
                  var retorno = (valor_json[0]["r_5"] == 'A') ? "Si" : "No";
                  $("#r_8").html(retorno);
                </script>
              </td>
            </tr>
            <tr>
              <td>9</td>
              <td>¿Ha presentado vómitos o náuseas?</td>
               <td id="r_9">
                <script type="text/javascript">
                  var valor = '<?php echo  $elementos["respuesta_3"]; ?>';
                  var valor_json = JSON.parse(valor);
                  var retorno = (valor_json[0]["r_6"] == 'A') ? "Si" : "No";
                  $("#r_9").html(retorno);
                </script>
              </td>
            </tr>
            <tr>
              <td>10</td>
              <td>¿Ha presentado falta de apetito?</td>
               <td id="r_10">
                <script type="text/javascript">
                  var valor = '<?php echo  $elementos["respuesta_3"]; ?>';
                  var valor_json = JSON.parse(valor);
                  var retorno = (valor_json[0]["r_7"] == 'A') ? "Si" : "No";
                  $("#r_10").html(retorno);
                </script>
              </td>
            </tr>

            <tr>
              <td>11</td>
              <td>¿Ha presentado dolor de estómago intenso y/o continuo?</td>
               <td id="r_11">
                <script type="text/javascript">
                  var valor = '<?php echo  $elementos["respuesta_4"]; ?>';
                  var valor_json = JSON.parse(valor);
                  var retorno = (valor_json[0]["r_1"] == 'A') ? "Si" : "No";
                  $("#r_11").html(retorno);
                </script>
              </td>
            </tr>
            <tr>
              <td>12</td>
              <td>¿Ha presentado cansancio y/o irritabilidad?</td>
               <td id="r_12">
                <script type="text/javascript">
                  var valor = '<?php echo  $elementos["respuesta_4"]; ?>';
                  var valor_json = JSON.parse(valor);
                  var retorno = (valor_json[0]["r_2"] == 'A') ? "Si" : "No";
                  $("#r_12").html(retorno);
                </script>
              </td>
            </tr>
            <tr>
              <td>13</td>
              <td>¿Ha presentado sangrado de nariz, de encías, o al momento de orinar?</td>
               <td id="r_13">
                <script type="text/javascript">
                  var valor = '<?php echo  $elementos["respuesta_4"]; ?>';
                  var valor_json = JSON.parse(valor);
                  var retorno = (valor_json[0]["r_3"] == 'A') ? "Si" : "No";
                  $("#r_13").html(retorno);
                </script>
              </td>
            </tr>
            <tr>
              <td>14</td>
              <td>¿Ha presentado desmayos o pérdida de conciencia?</td>
               <td id="r_14">
                <script type="text/javascript">
                  var valor = '<?php echo  $elementos["respuesta_4"]; ?>';
                  var valor_json = JSON.parse(valor);
                  var retorno = (valor_json[0]["r_4"] == 'A') ? "Si" : "No";
                  $("#r_14").html(retorno);
                </script>
              </td>
            </tr>
            <tr>
              <td>15</td>
              <td>¿Puede respirar con facilidad?</td>
               <td id="r_15">
                <script type="text/javascript">
                  var valor = '<?php echo  $elementos["respuesta_4"]; ?>';
                  var valor_json = JSON.parse(valor);
                  var retorno = (valor_json[0]["r_5"] == 'A') ? "Si" : "No";
                  $("#r_15").html(retorno);
                </script>
              </td>
            </tr>
            <tr>
              <td>16</td>
              <td>¿Se ha sentido agitado?</td>
               <td id="r_16">
                <script type="text/javascript">
                  var valor = '<?php echo  $elementos["respuesta_4"]; ?>';
                  var valor_json = JSON.parse(valor);
                  var retorno = (valor_json[0]["r_6"] == 'A') ? "Si" : "No";
                  $("#r_16").html(retorno);
                </script>
              </td>
            </tr>
            
          </tbody>
        </table>

        <div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('script')

@endsection

@section('style')
 
@endsection

