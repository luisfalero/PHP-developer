@extends('admin.layouts.base')

@section('content')

<!-- top tiles -->
<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel animate">
      <div class="x_title">
        <h2>Listado de Casos con Dengue</h2>
        <div class="clearfix"></div>
      </div>

      <small class="pull-right">
      	      
      </small>

      <div class="x_content">   
        <div class="table-responsive">
          <div class="form-group">
            <input type="hidden" name="_token" id="token_mostrar_provincia" value = "{{ csrf_token() }}">
            <input type="hidden" name="_token" id="token_mostrar_distrito" value = "{{ csrf_token() }}">
            <input type="hidden" name="_token" id="token_mostrar_reporte" value = "{{ csrf_token() }}">

            <div class="form-group col-md-6 col-sm-12 col-xs-12">
              <label for="email">Departamento:</label>
              {!! Form::select('departamento', $elementos, null , 
                array('id'=>'departamento', 'class'=>'form-control col-md-7 col-xs-12')); !!} 
            </div>
            <div class="form-group col-md-6 col-sm-12 col-xs-12">
              <label for="pwd">Provincia:</label>
              <select id="provincia" class="form-control col-md-7 col-xs-12"></select>            
            </div>
           
            <div class="form-group col-md-6 col-sm-12 col-xs-12">
              <label for="email">Distrito:</label>
              <select id="distrito" class="form-control col-md-7 col-xs-12"></select>            
            </div>
            <div class="form-group col-md-6 col-sm-12 col-xs-12">
              <label for="pwd">Periodo:</label>
              <input type="text" name="periodo" id="periodo" class="form-control"/>
            </div>

            <div class="col-md-12 col-sm-12 col-xs-12">
                <canvas id="canvas"></canvas>
            </div>
        </div>          
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('script')
<!-- Select2 -->
<script type="text/javascript" src="/administrador/assets/select2/select2.full.min.js"></script>
<!-- Daterangepicker -->
<script type="text/javascript" src="/administrador/assets/daterangepicker/moment.min.js"></script>
<script type="text/javascript" src="/administrador/assets/daterangepicker/daterangepicker.min.js"></script>

<script type="text/javascript" src="/administrador/assets/chart/Chart.bundle.js"></script>
<script type="text/javascript" src="/administrador/assets/chart/utils.js"></script>
<script type="text/javascript">

function restarDias(fecha, dias){
  fecha.setDate(fecha.getDate() - dias);
  return fecha;
}

function valor0(valor){
  var formato = ("0" + valor).slice (-2);
  return formato;
}

var f = new Date();
var ff = f.getDate() + "/" + (f.getMonth() +1) + "/" + f.getFullYear();
var fff = f.getFullYear() + "-" + valor0(f.getMonth() +1) + "-" + valor0(f.getDate());

var nf = restarDias(f, 180);
var fi = nf.getDate() + "/" + (nf.getMonth() +1) + "/" + nf.getFullYear();  
var ffi = nf.getFullYear() + "-" + valor0(nf.getMonth() +1) + "-" + valor0(nf.getDate());

$(document).ready(function() {
  carga_inicial();
  listarprovincia();

  $( "#departamento" ).change(function() {
    listarprovincia();
  });

  $( "#provincia" ).change(function() {
    listardistrito();
  });

  $( "#distrito" ).change(function() {
    mostrarReporte();
  });
});

function listarprovincia(){
  var ruta = "/reporte/ruta_mostrar_provincia";
  var token = $('#token_mostrar_provincia').val();
  var departamento = $("#departamento").val();

  var element = {departamento:departamento};
  $(".carga-datos").addClass("hide");
  $(".fa-spinner").removeClass("hide"); 

  $.ajax({
    url: ruta,
    headers: {'X-CSRF-TOKEN':token},
    type:"POST",
    dataType: 'json',
    data: element,
    success: function(data){   
      if(data.mensaje){ 
        $("#provincia").html("");
        for(var i=0; i< data.elementos.length; i++){
          var html = '<option value="'+data.elementos[i].provincia+'">'+data.elementos[i].provincia+'</option>';
          $("#provincia").append(html);
        }
      }
    },
    error: function(error) {
      console.log(error);
    }             
  }).complete(function() {
    listardistrito();
    $(".fa-spinner").addClass("hide");  
    $(".carga-datos").removeClass("hide");  
  });
}

function listardistrito(){
  var ruta = "/reporte/ruta_mostrar_distrito";
  var token = $('#token_mostrar_distrito').val();
  var provincia = $("#provincia").val();

  var element = {provincia:provincia};
  $(".carga-datos").addClass("hide");
  $(".fa-spinner").removeClass("hide"); 

  $.ajax({
    url: ruta,
    headers: {'X-CSRF-TOKEN':token},
    type:"POST",
    dataType: 'json',
    data: element,
    success: function(data){   
      if(data.mensaje){ 
        $("#distrito").html("");
        for(var i=0; i< data.elementos.length; i++){
          var html = '<option value="'+data.elementos[i].id+'">'+data.elementos[i].distrito+'</option>';
          $("#distrito").append(html);
        }
      }
    },
    error: function(error) {
      console.log(error);
    }             
  }).complete(function() {
    $(".fa-spinner").addClass("hide");  
    $(".carga-datos").removeClass("hide");
    mostrarReporte();  
  });
}

function carga_inicial() {
  $('#periodo').daterangepicker({      
      "autoclose":"true",
      "startDate": fi,
      "endDate": ff,
      "locale": {
          "format": "DD/MM/YYYY",
          "separator": " - ",
          "applyLabel": "Aplicar",
          "cancelLabel": "Cancelar",
          "fromLabel": "From",
          "toLabel": "To",
          "customRangeLabel": "Custom",
          "daysOfWeek": [
              "Do",
              "Lu",
              "Ma",
              "Mi",
              "Ju",
              "Vi",
              "Sa"
          ],
          "monthNames": [
              "Enero",
              "Febrero",
              "Marzo",
              "Abril",
              "Mayo",
              "Junio",
              "Julio",
              "Agosto",
              "Septiembre",
              "Octubre",
              "Noviembre",
              "Deciembre"
          ],
          "firstDay": 1
      }
  }, function(start, end, label) {
    var fi = start.format('YYYY-MM-DD');
    var ff = end.format('YYYY-MM-DD');
    mostrarReporte();
  });
}

function mostrarReporte(){
  var fi = $('#periodo').data('daterangepicker').startDate.format('YYYY-MM-DD');
  var ff = $('#periodo').data('daterangepicker').endDate.format('YYYY-MM-DD');
  var ruta = "/reporte/ruta_mostrar_reporte_caso_dengue";
  var token = $('#token_mostrar_reporte').val();
  var ubigeo =$("#distrito").val();
  var element = {fi:fi, ff:ff, ubigeo:ubigeo};
  $(".carga-datos").addClass("hide");
  $(".fa-spinner").removeClass("hide"); 

  $.ajax({
    url: ruta,
    headers: {'X-CSRF-TOKEN':token},
    type:"POST",
    dataType: 'json',
    data: element,
    success: function(data){   
      console.log(data)
      if(data.mensaje){ 
         mostrarGrafico(data.array_x, data.array_y)
      }
    },
    error: function(error) {
      console.log(error);
    }             
  }).complete(function() {
    $(".fa-spinner").addClass("hide");  
    $(".carga-datos").removeClass("hide");  
  });
}

var myLine = 0; 
function mostrarGrafico(array_x, array_y){
  var MONTHS = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Setiembre", "Octubre", "Noviembre", "Diciembre"];
  var config = {
      type: 'line',
      data: {
          labels: array_x,
          datasets: [{
              label: "Dengue",
              backgroundColor: window.chartColors.red,
              borderColor: window.chartColors.red,
              data: array_y,
              fill: false,
          }]
      },
      options: {
          responsive: true,
          title:{
              display:true,
              text:'Reporte de Enfermedades'
          },
          tooltips: {
              mode: 'index',
              intersect: false,
          },
          hover: {
              mode: 'nearest',
              intersect: true
          },
          scales: {
              xAxes: [{
                  display: true,
                  scaleLabel: {
                      display: true,
                      labelString: 'Meses'
                  }
              }],
              yAxes: [{
                  display: true,
                  scaleLabel: {
                      display: true,
                      labelString: 'Valores'
                  }
              }]
          }
      }
  };

  if(myLine != 0)  myLine.destroy();
  var ctx = document.getElementById("canvas").getContext("2d");
    myLine = new Chart(ctx, config);  

}
</script>
@endsection

@section('style')
<!-- Select2 -->
<link media="all" type="text/css" rel="stylesheet" href="/administrador/assets/select2/select2.min.css">
<!-- Daterangepicker -->
<link media="all" type="text/css" rel="stylesheet" href="/administrador/assets/daterangepicker/daterangepicker.min.css">
@endsection

