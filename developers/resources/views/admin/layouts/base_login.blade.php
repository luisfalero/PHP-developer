<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta content="Luis Alberto Falero Otiniano" name="author">

    <title>{!! config('global.titleSite') !!}</title>

    <link rel="shortcut icon" href="{{ asset('images/ico/favicon.ico') }}">
    <link rel="apple-touch-icon-precomposed" href="{{ asset('images/ico/favicon.png') }}">
    
    <link rel="apple-touch-icon-precomposed" sizes="144x144" 
      href="{{ asset('images/ico/favicon.png') }}">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" 
      href="{{ asset('images/ico/favicon.png') }}">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" 
      href="{{ asset('images/ico/favicon.png') }}">
    <link rel="apple-touch-icon-precomposed" 
    href="{{ asset('images/ico/favicon.png') }}">
    
    <!-- Bootstrap -->
    <link media="all" type="text/css" rel="stylesheet" href="/administrador/assets/bs/css/bootstrap.min.css">
    <link media="all" type="text/css" rel="stylesheet" href="/administrador/assets/bs/css/bootstrap-theme.min.css">
    <link media="all" type="text/css" rel="stylesheet" href="/administrador/assets/bs/css/font-awesome.min.css">
    <link media="all" type="text/css" rel="stylesheet" href="/administrador/assets/build/css/custom.min.css">
    <script type="text/javascript" src="/administrador/assets/bs/js/jquery-1.11.2.min.js"></script>
    <link media="all" type="text/css" rel="stylesheet" href="/administrador/css/base_login.min.css">
  </head>

  @if(isset(Auth::user()->id) && Auth::user()->type === 0)
    <script type="text/javascript">
      window.location = "{!! url('/administrador/inicio') !!}";
    </script>
  @else
    <body>
      <div class="container">
        <div class="card card-container">
          @yield('content') 
        </div><!-- /card-container -->
      </div><!-- /container -->
    </body>
  @endif
</html>



