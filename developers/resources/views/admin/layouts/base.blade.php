<!DOCTYPE html>
<html lang="{{ App::getLocale() }}">
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

    <!--<script type="text/javascript" src="/administrador/assets/pacejs/js/pace.js"></script>
    <link media="all" type="text/css" rel="stylesheet" href="/administrador/assets/pacejs/css/pace-theme-flash.css">--> 

    <link media="all" type="text/css" rel="stylesheet" href="/administrador/assets/bs/css/bootstrap.min.css">
    
    <link media="all" type="text/css" rel="stylesheet" href="/administrador/assets/bs/css/font-awesome.min.css">
    <link media="all" type="text/css" rel="stylesheet" href="/administrador/assets/build/css/custom.min.css">

    <link media="all" type="text/css" rel="stylesheet" href="/administrador/assets/notify/css/icomoon.min.css">
    <link media="all" type="text/css" rel="stylesheet" href="/administrador/assets/notify/css/titatoggle.min.css">
    
    <!--<script type="text/javascript" src="/administrador/assets/sweetalert/sweetalert.min.js"></script>
    <link media="all" type="text/css" rel="stylesheet" href="/administrador/assets/sweetalert/sweetalert.css">-->
    <script type="text/javascript" src="/administrador/assets/sweetalert2/sweetalert2.min.js"></script>
    <link media="all" type="text/css" rel="stylesheet" href="/administrador/assets/sweetalert2/sweetalert2.min.css">

    <!--<script type="text/javascript" src="/administrador/assets/notify/js/app.js"></script>-->

    <script type="text/javascript" src="/js/jquery-2.1.1.min.js"></script>
    <!--<script type="text/javascript" src="/administrador/assets/bs/js/bootstrap.js"></script>-->
    <!--<script type="text/javascript" src="/administrador/assets/bs/js/jquery-1.11.2.min.js"></script>-->

    <script type="text/javascript" src="/administrador/assets/notify/js/bootstrap-notify.min.js"></script>

    <link media="all" type="text/css" rel="stylesheet" href="/administrador/assets/bs/css/dataTables.bootstrap.min.css">
    <script type="text/javascript" src="/administrador/assets/bs/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="/administrador/assets/bs/js/dataTables.bootstrap.min.js"></script>

    <script type="text/javascript" src="/administrador/assets/ckeditor/ckeditor.js"></script>

    <link media="all" type="text/css" rel="stylesheet" href="/administrador/css/base.css">
    <link media="all" type="text/css" rel="stylesheet" href="/administrador/css/spinner.min.css">
    
     <!-- Other Style -->
    @yield('style') 
  </head>
  
  <body class="nav-md scroll-view-hidden">   

    <div class="preloader">
      <div class="spinner">
        <span></span>
        <span></span>
        <span></span>
      </div>
    </div>  
    
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col" id="scroll-view-bar">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="{{URL::to('admin')}}" class="site_title">
                <!--<i class="fa fa-paw"></i> -->
                <span>{!! config('global.titleSite') !!}</span>
              </a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile">
           
              <div class="profile_info">
                <span>{{ 'Bienvenido' }},</span>
                <h2>Luis Falero Otiniano</h2>
              </div>
            </div>
            <!-- /menu profile quick info -->
            <br ></script>

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>                   
                    Administrador
                </h3>
                <ul class="nav side-menu">                   
                  <li class="content-loading">
                    <a href="{{URL::to('/')}}"><i class="fa fa-home"></i> Inicio</a>
                  </li>
                  <li class="content-loading">
                    <a href="{{URL::to('/admin/salario')}}"><i class="fa fa-money"></i> Salario</a>
                  </li>
              </div>

            </div>
            <!-- /sidebar menu -->
          </div>
        </div>

        <!-- top navigation -->
        <input type="hidden" name="_token" id="token_mostrar_notificaciones" value = "{{ csrf_token() }}">

        <div class="top_nav">
          <div class="nav_menu">
            <nav class="" role="navigation">
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">         
           <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              @include('admin.layouts.alert')
              @yield('content')
            </div>
          </div>
          <br />
        </div>
        <!-- /page content -->

        <!-- footer content -->
        <footer>
          <div class="pull-right">

          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div> 

    <script type="text/javascript" src="/administrador/assets/bs/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/administrador/assets/build/js/custom.min.js"></script>
    <script type="text/javascript" src="/administrador/js/base.min.js"></script>
    <!-- Other Script -->
    @yield('script') 
   
  </body>

</html>