@extends('admin.layouts.base_login')

@section('content')
<section class="login_content">
    {!! Form::open(['url' => '/register']) !!}
      <h1>Registrar</h1>

      <div class="form-group">
        @if(Session::has('flash_message'))
            <div class="alert alert-danger validation">
              <span class="fa fa-info-circle"></span>
              <em> {!! session('flash_message') !!}</em>
            </div>
        @endif
      </div>

      <div class="form-group">                
        {!! Form::text('name', old('name') , array('', 'class'=>'form-control col-md-7 col-xs-12',  
                            'placeholder'=>'Nombres')) !!} 
      </div>
      @if($errors->has('name'))
        <div class="form-group" id="content-name">                 
          <div class="col-md-10 col-sm-10 col-xs-12 login">
                <div class="alert validation" >{{ $errors->first('name')  }}</div><br>
                <script type="text/javascript">
                  $("#content-name").addClass("item bad");
                </script>
          </div>
        </div>            
      @else
        <script type="text/javascript">
          $("#content-name").removeClass("item bad");
        </script>
      @endif

      <div class="form-group">                
        {!! Form::text('email', old('email'), array('', 'class'=>'form-control col-md-7 col-xs-12',  
                            'placeholder'=>'Correo electrónico')) !!} 
      </div>
      @if($errors->has('email'))
        <div class="form-group" id="content-email">                 
          <div class="col-md-10 col-sm-10 col-xs-12 login">
                <div class="alert validation" >{{ $errors->first('email')  }}</div><br>
                <script type="text/javascript">
                  $("#content-email").addClass("item bad");
                </script>
          </div>
        </div>            
      @else
        <script type="text/javascript">
          $("#content-email").removeClass("item bad");
        </script>
      @endif 

      <div class="form-group">
        {!! Form::password('password', array('class'=>'form-control col-md-7 col-xs-12',  
                               'placeholder'=>'Contraseña', 'id'=>'password')) !!}
      </div>
      @if($errors->has('password'))
        <div class="form-group" id="content-password">
          <div class="col-md-10 col-sm-10 col-xs-12 login">
                <div class="alert validation" >{{ $errors->first('password')  }}</div><br>
                <script type="text/javascript">
                  $("#content-password").addClass("item bad");
                </script>
          </div>
        </div>            
      @else
        <script type="text/javascript">
          $("#content-password").removeClass("item bad");
        </script>
      @endif 

      <div class="form-group">
        {!! Form::password('password_confirmation', array('class'=>'form-control col-md-7 col-xs-12',  
                               'placeholder'=>'Confirmar Contraseña', 'id'=>'password_confirmation')) !!}
      </div>
      @if($errors->has('password_confirmation'))
        <div class="form-group" id="content-password-confirm">
          <div class="col-md-10 col-sm-10 col-xs-12 login">
                <div class="alert validation" >{{ $errors->first('password_confirmation')  }}</div><br>
                <script type="text/javascript">
                  $("#content-password-confirm").addClass("item bad");
                </script>
          </div>
        </div>            
      @else
        <script type="text/javascript">
          $("#content-password-confirm").removeClass("item bad");
        </script>
      @endif 


      {!! Form::hidden('type', "0", array('', 'class'=>'form-control col-md-7 col-xs-12')) !!} 


      <div>
        {!!  Form::submit('Entrar', array('class'=>'btn btn-default submit')) !!}
      </div>

      <div class="clearfix"></div>

      <div class="separator">
        <div>
          <h1>
          <!--<i class="fa fa-paw"></i>-->
          {!! config('global.titleSite') !!}
          </h1>
          <p>©2016 All Rights Reserved. Gentelella Alela! is a Bootstrap 3 template. Privacy and Terms</p>
        </div>
      </div>
    {!! Form::close() !!}
</section>
@endsection
