@extends('admin.layouts.base')

@section('content')

<!-- top tiles -->
<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel animate">
      <div class="x_title">
        <h2>Listado de Casos con Dengue Revisados</h2>
        <div class="clearfix"></div>
      </div>

      <small class="pull-right">
      	      
      </small>

      <div class="x_content">   
       
        <div class="table-responsive">
          <table id="tblListado" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr>                    
                    <th width="10%">Fecha Registro</th>
                    <th width="10%">Código</th>                     
                    <th width="10%">DNI</th>
                    <th width="20%">Nombres y Apellidos</th>
                    <th width="10%">Celular</th>  
                    <th width="10%">Procedencia</th>  
                    <th width="20%">Resultado</th>
                    <th width="10%"></th>
                </tr>
            </thead>
            <tbody>   
                @foreach ($elementos as $index => $elementos)             
                  <tr>                
                      <td>{!! $elementos->fecha_registro!!}</td>
                      <td>{!! $elementos->codigo_caso!!}</td>
                      <td>{!! $elementos->dni!!}</td>
                      <td>{!! $elementos->nombre.' '.$elementos->apellido_materno.' '.$elementos->apellido_paterno !!}</td>
                      <td>{!! $elementos->celular!!}</td>
                      <td>{!! mb_convert_case($elementos->departamento, MB_CASE_TITLE, "UTF-8").' - '.mb_convert_case($elementos->provincia, MB_CASE_TITLE, "UTF-8").' - '.mb_convert_case($elementos->distrito, MB_CASE_TITLE, "UTF-8");!!}</td>
                      <td>{!! $elementos->estado!!}</td>
                      <td>
                        <a href="{{URL::to('admin/detalle-caso-dengue-revisado/'.$elementos->id)}}" class="btn btn-info btn-xs">
                          <i class="fa fa-eye"></i> Ver Detalle 
                        </a>  
                      </td>
                  </tr>     
                @endforeach                               
            </tbody>
          </table>

           <script type="text/javascript">
              $(document).ready(function() {   
                  $('#tblListado').DataTable({
                      //order: [[ 0, "asc" ]],
                      order: [],
                      pageLength : 100
                  });
              });
          </script>    
        </div>
       
      </div>
    </div>
  </div>
</div>
@endsection

@section('script')

@endsection

@section('style')
 
@endsection

