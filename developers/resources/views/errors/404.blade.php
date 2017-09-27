<!DOCTYPE html>
<html lang="{{ App::getLocale() }}">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{!! config('global.titleSite') !!}</title>

        <link rel="shortcut icon" href="{{ asset('images/ico/favicon.ico') }}">
        <link rel="apple-touch-icon-precomposed" sizes="144x144" 
          href="{{ asset('images/ico/apple-touch-icon-144-precomposed.png') }}">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" 
          href="{{ asset('images/ico/apple-touch-icon-114-precomposed.png') }}">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" 
          href="{{ asset('images/ico/apple-touch-icon-72-precomposed.png') }}">
        <link rel="apple-touch-icon-precomposed" href="{{ asset('images/ico/apple-touch-icon-57-precomposed.png') }}">

        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
        <link href="/css/404.css" rel="stylesheet" type="text/css">
        <style type="text/css">h2{font-size: 25px;}</style>
    </head>
    <body>
        <!--
        <header class="page-container page-container-responsive space-top-4">
            <a href="/" class="icon icon-airbnb link-icon h2">
              <span class="screen-reader-only">
                {!! config('global.titleSite') !!}
              </span>
            </a>
          </header>-->
          <div class="page-container page-container-responsive">
            <div class="row space-top-8 space-8 row-table">
                <div class="col-5 col-middle">
                  <h1 class="text-jumbo text-ginormous">Oops!</h1>
                  <h2>Parece que no podemos encontrar la página que estás buscando.</h2>
                  <h6>Código de error: 404</h6>
                </div>
                <div class="col-5 col-middle text-center">
                  <img src="/images/404.gif" width="313" height="428" alt="Girl has dropped her ice cream.">
                </div>
              </div>
            </div>
          </div>
    </body>
</html>
