@extends('layouts.app')

@section('htmlheader_title')
 Asignaciones
@endsection





@section('main-content')
	  <div class="panel panel-primary">
         <div class="panel-heading" style="text-align: center;">
            Rendición de fondos
        </div>
       {!!Form::open(array('url'=>'Rendiciones/rendiciones','method'=>'POST','id'=>'frmA','autocomplete'=>'off','files'=>'true'))!!}
         <meta name="_token" content="{!! csrf_token() !!}"/>
        {{-- {{Form::token()}} --}}
        <div class="panel-body">
            <div class="row">
                 <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
                   <div class="form-group">
                        <label for="solicitante">Rendidor:&nbsp;{{$id}}&nbsp;{{$nombre}}&nbsp;Codigo Sap:&nbsp;{{$codigoSap}}</label>
                        <input type="hidden" name="id_solicitante" value="{{$id}}" id="id_solicitante">
                        <input type="hidden" name="codigoSap" value="{{$codigoSap}}" id="codigoSap">

                    </div>
                </div>
            </div>
      

            <div class="row">
                 <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
                    <div class="form-group">
                         <label for="proyecto">Solicitud a rendir : </label> 
                         <a class="btn btn-success ver-solicitud" data-target="#Solicitudes" data-toggle="modal" data-id="{{$id}}" >Mis Solicitudes</a> 
                    </div>                    
                 </div>
                 <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
                    <div class="form-group">                         
                         <a class="btn btn-success ver-solicitud" data-target="#Solicitudes" data-toggle="modal" data-id="{{$id}}" >Mis Rendiciones</a> 
                    </div>                    
                 </div>                
            </div>

            <div class="row">
                 <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
                   <div class="form-group">
                        <label for="foto">Foto</label>  
                        <input accept="image/*"  type="file" capture="camera" id="foto"/>                              
                   </div>
                </div>                                
            </div>

                <div class="row">
                 <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
                   <div class="form-group">
                        <label for="proyecto">Proyecto:</label>
                         <select class="js-example-basic-single form-control" name="proyecto" id="proyecto">
                        @foreach ($proyectos as $proyecto)
                            <option value="{{$proyecto->PrjCode}}">{{$proyecto->PrjCode}}&nbsp;&nbsp;{{$proyecto->PrjName}}</option>
                        @endforeach 
                        </select>
                    </div>
                </div>
            </div>

             <div class="row">
                 <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
                   <div class="form-group">
                        <label for="zona">Zona:</label>
                         <select class="form-control" name="proyecto" id="proyecto">
                        @foreach ($zonas as $zona)
                            <option value="{{$zona->codigo}}">{{$zona->codigo}}&nbsp;&nbsp;{{$zona->nombre}}</option>
                        @endforeach 
                        </select>
                    </div>
                </div>
            </div>



            <div class="row">
                 <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
                   <div class="form-group">
                        <label for="tipodoc">Tipo Documento</label>
                        <select name="tipodoc" id="tipodoc" class="form-control">                         
                            <option value="1">Factura</option>
                            <option value="2">Boleta</option>
                            <option value="3">Vale por</option>
                        </select>
                     
                    </div>
                </div> 
            </div>
             <div class="row">
                 <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
                   <div class="form-group">
                        <label for="ndoc">Nº Documento</label>
                        <input type="number" name="ndoc" id="ndoc" required value="{{old('ndoc')}}" class="form-control" placeholder="Nº Documento...">
                    </div>
                </div>
            </div>
             <div class="row">
                 <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
                   <div class="form-group">
                        <label for="fechadoc">Fecha Documento</label>
                        <input type="date" name="fechadoc" id="fechadoc" required value="{{old('fechadoc')}}" class="form-control" placeholder="Fecha  documento...">
                    </div>
                </div>
            </div>

             <div class="row">
                 <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
                   <div class="form-group">
                        <label for="concepto">Motivo:</label>
                         <select class="js-example-basic-multiple form-control" name="concepto[]" multiple="multiple" id="concepto">
                        @foreach ($tiposolicitudes as $tiposolicitud)
                            <option value="{{$tiposolicitud->id}}">{{$tiposolicitud->concepto}}</option>
                        @endforeach 
                        </select>
                    </div>
                </div>
            </div>
         
            <div class="row">
                 <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
                   <div class="form-group">
                        <label for="monto">Monto:</label>
                        <input type="number" name="monto" id="monto" required value="{{old('monto')}}" class="form-control" placeholder="Monto a rendir...">
                    </div>
                </div>
            </div>

            <div class="row">
                 <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
                   <div class="form-group">
                        <label for="observaciones">Observaciones</label>                        
                        <textarea name="observaciones" id="observaciones" required cols="70"  rows="5" placeholder="Observaciones..."></textarea>       
                    </div>
                </div>
            </div>
            
        </div>
        </div>

         <div class="row">
                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">                  
                  
                   
                  <button class="btn btn-primary" type="button" id="BtnEnviar">Guardar</button>
                  <button class="btn btn-danger" type="reset">Cancelar</button>
                </div>
         </div>
 
       
    {!!Form::close()!!} 


<!-- Modal -->
<div class="modal fade" id='Solicitudes' tabindex='-1' role='dialog' aria-labellebdy='myModalLabel'
  aria-hidden='true'>
  
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
           <h2 class="text-center">Usuario:{{$nombre}} </h2>
        </div>
        <div class="modal-body modal-solicitudes">
         
        </div>
        <div class="modal-footer">         
          <button class="btn btn-primary" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
      
    </div>
  </div>

   <!-- Fin Modal -->
    <script>
         $('.ver-solicitud').click(function(event) {
            event.preventDefault();
            $('.modal-solicitudes').html('Cargando...');
            var loc = $(this).attr('href');
            var id= $(this).data('id');

            console.log(id);
            $.ajax({
                  url: '/rendiciones/solicitudes/'+id+'/misSolicitudesRendir',
                  method: 'GET'
                }).done(function(view) {
                    $('.modal-solicitudes').html(view);
                    //console.log(data);
                  //$( this ).addClass( "done" );
            });

        });

        $(document).ready(function() 
        {
            $('.js-example-basic-single').select2();
            $('.js-example-basic-multiple').select2();  

             $.ajaxSetup
             ({
                headers: {'X-CSRF-Token': $('meta[name=_token]').attr('content')}
            });


              $("#BtnEnviar").click(function (e) {                    
                    e.preventDefault();
                    var id_solicitante = $('#id_solicitante').val();
                    var ndoc = $('#ndoc').val();
                    var tipodoc = $('#tipodoc').val();
                    var fechadoc = $('#fechadoc').val();
                    var monto = $('#monto').val();
                    var codigoSap = $('#codigoSap').val();
                    var proyecto = $('#proyecto').val();
                    var observaciones = $('#observaciones').val();
                    var concepto = $('#concepto').val();
                    var foto = $('#foto').val();
                    $.ajax({
                        type: "post",
                        url: "/Rendiciones/rendiciones",
                        data: {
                            id_solicitante: id_solicitante,
                            ndoc: ndoc,                            
                            tipodoc: tipodoc,
                            fechadoc: fechadoc,
                            monto: monto,
                            codigoSap: codigoSap,
                            proyecto: proyecto,
                            observaciones: observaciones,
                            concepto: concepto

                        }, success: function (msg)                                                
                        {

                           //alert("Se ha realizado el POST con exito "+msg);
                            swal(
                                'Registro ingresado con exito',
                                 'Presione el boton OK!',
                                'success'
                            );

                            //limpiamos los input
                            document.getElementById('ndoc').value = '';
                            document.getElementById('fechadoc').value = '';
                            document.getElementById('monto').value = '';
                            document.getElementById('observaciones').value = '';
                            document.getElementById('proyecto').focus();

                         }
                    });
              });




        });



     function Guardar(e)
     {
             e.preventDefault();
              var tipodoc = $('#tipodoc').val();
              $.ajax({
                type: "post",
                url: "",
                data: {
                    tipodoc: tipodoc
                }, success: function (msg) {
                        //alert("Se ha realizado el POST con exito "+msg);
                        swal(
                          'Registro ingresado con exito',
                           'Presione el boton OK!',
                           'success'
                        );

                }
      });





             

             // event.preventDefault();
             //  url = '';           
             //  $.post(url,
             //  {   
             //      _token: "{{ csrf_token() }}",
             //      tipodoc: $("select[name='tipodoc']")[0].value,
             //      ndoc: $("input[name='ndoc']")[0].value,
             //      fechadoc: $("input[name='fechadoc']")[0].value,              
             //      monto: $("input[name='monto']")[0].value,
             //      observaciones: $("textarea[name='observaciones']")[0].value
             //      //proyecto: $("select[name='proyecto']")[0].value             
             //  },function(data, status){                    
             //      swal(
             //          'Registro ingresado con exito',
             //          'Presione el boton OK!',
             //          'success'
             //      ).then(function () {
             //        location.reload();
             //  });


             //  });     
     }

       
        function Llevar()
        {

          alert("datos para traspasar a rendicion");
        }

    </script>

@endsection