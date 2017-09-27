$(window).on("load", function(){
  $(".body").css("background", "#2A3F54"); 
  $(".preloader").addClass("hidden");  
  $(".nav-md").removeClass("scroll-view-hidden");            
});

$(document).ready(function(){
    mostrarNotificaciones();
});

function mostrarNotificaciones(){   
  var ruta = "/layouts/ruta_mostrar_notificaciones";
  var token = $('#token_mostrar_notificaciones').val();
  var element = {};

  $.ajax({
    url: ruta,
    headers: {'X-CSRF-TOKEN':token},
    type:"POST",
    dataType: 'json',
    data: element,
    success: function(data){
      if(data.mensaje){ 
        if(data.cargo == 'A'){
          if(data.cantidad > 0){
            var info_number = '<span class="badge bg-green">'+data.cantidad+'</span>';
            var info_number_right = '<span class="label label-success pull-right">'+data.cantidad+'</span>';
            var html = '';

            $("#info-number").html(info_number);
            $("#info-number-right").html(info_number_right);
            $("#menu1").html(html);

            for(var i=0; i<data.cantidad; i++){
              html = ''+
              '<li class="notificacion-li">'+
                '<a href="/admin/notificaciones">'+
                  '<span class="message">'+
                    'El material <b>'+data.elementosProducto[i].nombre+'</b> ha llegado a su stock mínimo de <b>'+data.elementosProducto[i].stock_minimo+'</b>'+
                  '</span>'+
               '</a>'+
              '</li>';
              $("#menu1").append(html);
            }

            html = ''+
            '<li>'+
              '<div class="text-center">'+
                '<a href="/admin/notificaciones">'+
                  '<strong>Ver todas las notificaciones </strong>'+
                  '<i class="fa fa-angle-right"></i>'+
                '</a>'+
              '</div>'+
            '</li>';
            $("#menu1").append(html);
          }
        }else if(data.cargo == 'T'){
          var tratamiento_trabajador = '<span class="label label-success pull-right">'+data.cantidad_tratamiento_trabajador+'</span>';
          var devolucion_trabajador = '<span class="label label-success pull-right">'+data.cantidad_devolucion_trabajador+'</span>';

          if(data.cantidad_tratamiento_trabajador > 0) $("#cantidad_tratamiento_trabajador").html(tratamiento_trabajador);
          if(data.cantidad_devolucion_trabajador > 0) $("#cantidad_devolucion_trabajador").html(devolucion_trabajador);
        }else if(data.cargo == 'J'){
            var tratamiento_jefe = '<span class="label label-success pull-right">'+data.cantidad_tratamiento_jefe+'</span>';
            var control_jefe = '<span class="label label-success pull-right">'+data.cantidad_control_jefe+'</span>';
            var entrega_jefe = '<span class="label label-success pull-right">'+data.cantidad_entrega_jefe+'</span>';
            var devolucion_jefe = '<span class="label label-success pull-right">'+data.cantidad_devolucion_jefe+'</span>';

            if(data.cantidad_tratamiento_jefe > 0) $("#cantidad_tratamiento_jefe").html(tratamiento_jefe);
            if(data.cantidad_control_jefe > 0) $("#cantidad_control_jefe").html(control_jefe);
            if(data.cantidad_entrega_jefe > 0) $("#cantidad_entrega_jefe").html(entrega_jefe);
            if(data.cantidad_devolucion_jefe > 0) $("#cantidad_devolucion_jefe").html(devolucion_jefe);

            var html = '';

            var info_number = '<span class="badge bg-green">'+data.cantidad+'</span>';
            $("#info-number").html(info_number);
            $("#menu1").html(html);

            for(var i=0; i<data.cantidad; i++){
              var usuario = data.notificacion[i].nombres + ' ' + data.notificacion[i].apellidos;
              var tipo_pedido = data.notificacion[i].tipo_pedido;
              var fecha_actual = data.notificacion[i].fecha_actual;
              var etapa = '';
              var ruta_admin = '';

              if(data.notificacion[i].etapa == 'C'){
                etapa = 'Control';
                ruta_admin = '/admin/aprobar-control';
              }else if(data.notificacion[i].etapa == 'E'){
                etapa = 'Entrega';
                ruta_admin = '/admin/aprobar-entrega';
              }else{
                etapa = 'Devolución';
                ruta_admin = '/admin/aprobar-devolucion';
              }

              html = ''+
              '<li class="notificacion-li">'+
                '<a href="'+ruta_admin+'">'+
                  '<span>'+
                    '<span class="tiempo-notificacion">'+fecha_actual+'</span>'+
                  '</span>'+
                  '<span class="message" style="margin-top: 20px;">'+
                    'Tienes una solicitud de <b>'+tipo_pedido+'</b> pendiente en la etapa de <b>'+etapa+'</b> del trabajador <b>'+usuario+'</b> '+
                  '</span>'+
               '</a>'+
              '</li>';
              $("#menu1").append(html);
          }
        }
      }else{
        html = ''+
        '<li>'+
          '<a>'+
            '<span class="message">'+
              'No hay notificaciones'+
            '</span>'+
         '</a>'+
        '</li>';
        $("#menu1").append(html);
      }
    },
    error: function(error) {
      console.log(error);
    }             
  });
}   