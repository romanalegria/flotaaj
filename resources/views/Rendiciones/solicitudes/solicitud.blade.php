@extends('layouts.app')

@section('htmlheader_title')
 Solicitudes
@endsection





@section('main-content')
	  <div class="panel panel-primary">
         <div class="panel-heading" style="text-align: center;">
            Solictud de Fondos a Rendir
        </div>
        {!!Form::open(array('url'=>'rendiciones/solicitudes','method'=>'POST','autocomplete'=>'off','files'=>'true'))!!}
        {{Form::token()}}
        <div class="panel-body">
            <div class="row">
                 <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
                   <div class="form-group">
                        <label for="solicitante">Solicitante:&nbsp;{{$id}}&nbsp;{{$nombre}}&nbsp;Codigo Sap:{{$codigoSap}}</label>
                        <input type="hidden" name="id_solicitante" value="{{$id}}">
                        <input type="hidden" name="codigoSap" value="{{$codigoSap}}">

                    </div>
                </div>
            </div>
            @if (Auth::User()->idrol == 3)
               <div class="row">
                 <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
                   <div class="form-group">
                        <label for="tercero">Solicitar a terceros</label>
                        <select name="tercero" class="form-control">
                          <option value="{{$id}}">Propia</option>
                         @foreach ($trabajadores as $tra)
                            <option value="{{$tra->id}}">{{$tra->name}}</option>
                        @endforeach 

                        </select>
                     
                    </div>
                </div>
            </div>
            @endif
            <div class="row">
                 <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
                   <div class="form-group">
                        <label for="anegocio">Arèa Negocio:</label>
                        <select name="area" class="form-control">
                         @foreach ($areas as $area)
                            <option value="{{$area->codigo}}">{{$area->nombre}}</option>
                        @endforeach 
                        </select>
                     
                    </div>
                </div>
            </div>
            <div class="row">
                 <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
                   <div class="form-group">
                        <label for="proyecto">Proyecto:</label>
                         <select class="js-example-basic-single form-control" name="proyecto" >
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
                        <label for="proyecto">Motivo:</label>
                         <select class="js-example-basic-multiple form-control" name="concepto[]" multiple="multiple">
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
                        <input type="text" name="monto_solicitado" required value="{{old('monto')}}" class="form-control" placeholder="Monto a solicitar...">
                    </div>
                </div>
            </div>
            <div class="row">
                 <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
                    <div class="form-group">
                         <a class="btn btn-success ver-solicitud" data-target="#Solicitudes" data-toggle="modal" data-id="{{$id}}" >Mis Solicitudes</a> 
                    </div>
                 </div>
            </div>
        </div>
        </div>

              <div class="row">
                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                  <button class="btn btn-primary btn-submit"  onclick="Guardar();">Guardar</button>
                  <button class="btn btn-danger" type="reset">Cancelar</button>
                </div>
         </div>

    </div>
 
 
       
    {!!Form::close()!!} 


<!-- Modal -->
<div class="modal fade" id='Solicitudes' tabindex='-1' role='dialog' aria-labellebdy='myModalLabel'
  aria-hidden='true'>
  
    <div class="modal-dialog">
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
                  url: '/rendiciones/solicitudes/'+id+'/misSolicitudes',
                  method: 'GET'
                }).done(function(view) {
                    $('.modal-solicitudes').html(view);
                    //console.log(data);
                  //$( this ).addClass( "done" );
            });

        });

        $(document).ready(function() {
        $('.js-example-basic-single').select2();
         $('.js-example-basic-multiple').select2();
        });

        function Guardar() {
            swal(
                'Registro creado con exito',
                'Enviando E-Mails correspondientes...',
                'success'
            )
        }

       

    </script>

@endsection