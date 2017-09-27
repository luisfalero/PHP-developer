@extends('admin.layouts.base')

@section('content')

<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel animate">
      <div class="x_title">
        <h2>Especificidad & Sensibilidad</h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <div class="form-group col-md-12 col-sm-12 col-xs-12 table-responsive">
          <table class="table table-bordered" style="font-weight: bold;font-size: 16px;text-align: center;">
            <tr>
              <td colspan="2" rowspan="2" style="width: 40%; text-align: center;">
               {!! Html::image(asset('images/logo.png'), 'Zero Dengue', array('class' => 'img-logo')) !!}
              </td>
              <td colspan="2">CUADRO CLÍNICO EN LA APP (REGLAS EN LA SINTOMALOGÍA)</td>
            </tr>
            <tr>
              <td>SI SOSPECHA / PROBABILIDAD DE DENGUE</td>
              <td>NO SOSPECHA / PROBABILIDAD DE DENGUE</td>
            </tr>
            <tr>
              <td rowspan="2">VALIDACIÓN Y/O CONFIRMACIÓN DESDE EL MINSA</td>
              <td>+</td>
              <td>{{ $pos }}</td>
              <td>{{ $neg }}</td>
            </tr>
            <tr>
              <td>-</td>
              <td>0</td>
              <td>0</td>
            </tr>
          </table>
        </div>
        <div class="form-group col-md-6 col-sm-12 col-xs-12">
          <label for="email">SENSIBILIDAD:</label>
          <input type="text" class="form-control" readonly="readonly" value="100%">
        </div>
        <div class="form-group col-md-6 col-sm-12 col-xs-12">
          <label for="pwd">ESPECIFICIDAD:</label>
          <input type="text" class="form-control" readonly="readonly" value="100%">
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('script')

@endsection

@section('style')
 <style type="text/css">.img-logo{width: 220px;margin-top: 18px;}.footer{display: none !important;}</style>
@endsection

