@extends('admin.layouts.base_login')

@section('content')

<div class="head-login">
    {!! Html::image('images/logo.png', config('global.titleSite'), array('class' => 'image-logo')) !!}
    <span class="pedidos-virtual">Pedido Virtual</span>
</div><!-- /card-container -->
<div class=" body-login">
  <h5 class="header blue lighter bigger">
    Por favor Ingresar sus Datos                                                               
  </h5>

  {!! Form::open(['url' => 'usuario/login', 'class' => 'form-signin']) !!}

    <div class="form-group">
      @if(Session::has('flash_message'))
          <div class="alert alert-danger validation">
            <span class="fa fa-info-circle"></span>
            <em> {!! session('flash_message') !!}</em>
          </div>
      @endif
    </div>

    <div class="form-group">                
      {!! Form::text('correo', null, array('', 'class'=>'form-control col-md-7 col-xs-12',  
                          'placeholder'=>'Correo electrónico')) !!} 
    </div>
    @if($errors->has('correo'))
      <div class="form-group" id="content-correo">                 
        <div class="col-md-10 col-sm-10 col-xs-12">
              <div class="alert validation" >{{ $errors->first('correo')  }}</div><br>
              <script type="text/javascript">
                $("#content-correo").addClass("item bad");
              </script>
        </div>
      </div>            
    @else
      <script type="text/javascript">
        $("#content-correo").removeClass("item bad");
      </script>
    @endif 

    <div class="form-group">
      {!! Form::password('clave', array('', 'class'=>'form-control col-md-7 col-xs-12',  
                             'placeholder'=>'Clave')) !!}
    </div>
    @if($errors->has('clave'))
      <div class="form-group" id="content-clave">
        <div class="col-md-10 col-sm-10 col-xs-12">
              <div class="alert validation" >{{ $errors->first('clave')  }}</div><br>
              <script type="text/javascript">
                $("#content-clave").addClass("item bad");
              </script>
        </div>
      </div>            
    @else
      <script type="text/javascript">
        $("#content-clave").removeClass("item bad");
      </script>
    @endif 

    <div>
      {!!  Form::submit('Entrar', array('class'=>'btn btn-lg btn-primary btn-block btn-signin')) !!}
    </div>
   
  {!! Form::close() !!}
</div>
@endsection
