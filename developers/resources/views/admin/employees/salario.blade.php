@extends('admin.layouts.base')

@section('content')

<!-- top tiles -->
<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel animate">
      <div class="x_title">
        <h2>Salario de Empleado</h2>        
        <div class="clearfix"></div>
      </div>

      <div class="x_content">     
      {!! Form::open(['url'=>'/employees/salario/', 'class' => 'form-horizontal', 'id' => 'formdata'] ) !!}
          <div class="form-group col-md-5 col-sm-12 col-xs-12">
            <label for="monto_minimo">Monto Mínimo:</label>
            {!! Form::text('monto_minimo', '', array('id'=>'monto_minimo', 'class'=>'form-control', 'placeholder'=>'Monto Mínimo')) !!} 
          </div>
          <div class="form-group col-md-5 col-sm-12 col-xs-12">
            <label for="monto_maximo">Monto Máximo:</label>
            {!! Form::text('monto_maximo', '', array('id'=>'monto_maximo', 'class'=>'form-control', 'placeholder'=>'Monto Máximo')) !!} 
          </div>
          <div class="form-group form-group-buscar col-md-2 col-sm-12 col-xs-12">
            <a id="busqueda" class="btn btn-success register"> <i class="fa fa-search"></i> Buscar</a>
          </div>
        {!! Form::close() !!}
      </div>
    </div>
  </div>
</div>
@endsection

@section('script')
<script>
  $(document).ready(function(){
      $("#busqueda").click(function(){
        registrarRuta();
      });
  });
  function registrarRuta(){
    $('#formdata').submit();
  }
</script>
@endsection

@section('style')
<style>
  .form-group-buscar{
    padding-top: 19px;
  }
</style>
@endsection

