@extends('admin.layouts.base')

@section('content')

<!-- top tiles -->
<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel animate">
      <div class="x_title">
        <h2>Listado de Empleados</h2>
        <div class="clearfix"></div>
      </div>

      <div class="x_content">   

      {!! Form::open(['url'=>'/employees/buscar/', 'class' => 'form-horizontal', 'id' => 'formdata'] ) !!}
        <div class="form-group col-md-1 col-sm-12 col-xs-12">
          <label for="email">Correo:</label>
        </div>
        <div class="form-group col-md-5 col-sm-12 col-xs-12">
          {!! Form::text('email', '', array('id' => 'email', 'class'=>'form-control', 'placeholder'=>'Correo')) !!} 
        </div>
        <div class="form-group col-md-2 col-sm-12 col-xs-12">
          <a id="busqueda" class="btn btn-success register"> <i class="fa fa-search"></i> Buscar</a>
        </div>
        {!! Form::close() !!}
      
      <div class="form-group col-md-12 col-sm-12 col-xs-12">
        <div class="table-responsive">
          <table id="tblListado" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr>                    
                    <th width="30%">Nombre</th>                     
                    <th width="20%">Correo</th>  
                    <th width="20%">Área</th>  
                    <th width="20%">Cargo</th>  
                    <th width="10%"></th>
                </tr>
            </thead>
            <tbody>   
                @for ($i=0; $i < $cantidad ; $i++)              
                  <tr>                
                      <td>{!! $elementos[$i]["name"] !!}</td>                      
                      <td>{!! $elementos[$i]["email"] !!}</td>
                      <td>{!! $elementos[$i]["position"] !!}</td>
                      <td>{!! $elementos[$i]["salary"] !!}</td>
                      <td> 
                        <center>
                          <a  href="{{URL::to('admin/empleado/'.$elementos[$i]['id'])}}">
                            <button type="button" class="btn btn-success docs-tooltip" data-toggle="tooltip" title="" data-original-title="Ver Detalle" data-method="Ver Detalle" title="Ver Detalle">
                                <span class="fa fa-eye"></span>
                            </button>
                          </a>
                        </center>
                      </td> 
                  </tr>     
                @endfor                           
            </tbody>
          </table>

           <script type="text/javascript">
              $(document).ready(function() {   
                  $('#tblListado').DataTable({
                      //order: [[ 3, "asc" ]],
                      pageLength : 100
                  });
              });
          </script>    
        </div>
      </div>
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

@endsection

