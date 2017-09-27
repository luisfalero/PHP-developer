@extends('admin.layouts.base')

@section('content')

<!-- top tiles -->
<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel animate">
      <div class="x_title">
        <h2>Detalle de Empleado</h2>        
        <div class="clearfix"></div>
      </div>

      <small class="pull-right">
        <a href="{{URL::to('/')}}" class="btn btn-success register"> <i class="fa fa-reply-all"></i> Regresar</a> 
      </small>

      <div class="x_content">     
        <div class="form-group col-md-6 col-sm-12 col-xs-12">
          <label for="name">Nombre:</label>
          {!! Form::text('name', $elementos["name"], array('', 
              'class'=>'form-control', 'placeholder'=>'Nombre', 'readonly'=>'readonly')) !!} 
        </div>
        <div class="form-group col-md-6 col-sm-12 col-xs-12">
          <label for="email">Correo:</label>
          {!! Form::text('email', $elementos["email"], array('', 
              'class'=>'form-control', 'placeholder'=>'Correo', 'readonly'=>'readonly')) !!} 
        </div>

        <div class="form-group col-md-6 col-sm-12 col-xs-12">
          <label for="phone">Celular:</label>
          {!! Form::text('phone', $elementos["phone"], array('', 
              'class'=>'form-control', 'placeholder'=>'Celular', 'readonly'=>'readonly')) !!} 
        </div>
        <div class="form-group col-md-6 col-sm-12 col-xs-12">
          <label for="address">Dirección:</label>
          {!! Form::text('address', $elementos["address"], array('', 
              'class'=>'form-control', 'placeholder'=>'Dirección', 'readonly'=>'readonly')) !!} 
        </div>

        <div class="form-group col-md-6 col-sm-12 col-xs-12">
          <label for="position">Posición:</label>
          {!! Form::text('position', $elementos["position"], array('', 
              'class'=>'form-control', 'placeholder'=>'Posición', 'readonly'=>'readonly')) !!} 
        </div>
        <div class="form-group col-md-6 col-sm-12 col-xs-12">
          <label for="salary">Salario:</label>
          {!! Form::text('salary', $elementos["salary"], array('', 
              'class'=>'form-control', 'placeholder'=>'Salario', 'readonly'=>'readonly')) !!} 
        </div>
        <div class="form-group col-md-12 col-sm-12 col-xs-12">
          <label for="position">Habilidades:</label>
          <div class="table-responsive">
            <table id="tblListado" class="table table-striped table-bordered" cellspacing="0" width="100%">
              <thead>
                  <tr>                    
                      <th width="10%">#</th>                     
                      <th width="90%">Habilidad</th>  
                  </tr>
              </thead>
              <tbody>   
              @for ($i=0; $i < count($elementos["skills"]) ; $i++)              
                <tr>                
                    <td>{!! ($i + 1) !!}</td>                      
                    <td>{!! $elementos["skills"][$i]["skill"] !!}</td>
                </tr>     
              @endfor    
            </tbody> 
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('script')

@endsection

@section('style')
<style>footer{display:none;}</style>
@endsection

