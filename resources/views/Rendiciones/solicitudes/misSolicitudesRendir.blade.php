@extends('layouts.app')

@section('htmlheader_title')
Solicitudes a rendir
@endsection





@section('main-content')
	  <div class="panel panel-primary">
         <div class="panel-heading" style="text-align: center;">
            Rendición de fondos
        </div>
       {{--  {!!Form::open(array('url'=>'Rendiciones/rendiciones','method'=>'POST','id'=>'frmA','autocomplete'=>'off','files'=>'true'))!!}
         <meta name="_token" content="{!! csrf_token() !!}"/>  --}}
        {{-- {{Form::token()}} --}}
        <div class="panel-body">
            <div class="row">
                 <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                   <div class="form-group">
                        <label for="solicitante">Rendidor:&nbsp;{{$id}}&nbsp;{{$nombre}}&nbsp;Codigo Sap:&nbsp;{{$codigoSap}}</label>
                        <input type="hidden" name="id_solicitante" value="{{$id}}" id="id_solicitante">                      
                           <a class="btn btn-success ver-rendicion" data-target="#Rendiciones" data-toggle="modal" data-id="{{$id}}" >Mis Rendiciones</a> 
                        
                    </div> 
                 </div>
                </div>
            </div>
     <div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      	<div class="table-responsive">	
           <table id="versolicitudes" class="display" cellspacing="0" width="100%">
        		<thead style="background-color: #2e2f89; color:#259551; font-weight: bold;">
		            <tr>		            	
		                <th>Id</th>
		                <th>fecha</th>		                
		                <th>Proyecto</th>
		                <th>Nombre</th>
		                <th>Solicitado</th>
		                <th>Rendido</th>
		                <th>Saldo</th>
		                <th>Acción</th>
		                <th>Acción2</th>                    
		            </tr>
		        </thead>
		        <tfoot>
		        	<tr>
		            	<th>Id</th>
		                <th>fecha</th>
		                <th>Proyecto</th>
		                <th>Nombre</th>
		                <th>Solicitado</th>
		                <th>Rendido</th>
		                <th>Saldo</th>
		                <th>Acción</th>
		                <th>Acción2</th>                    
		                
		        	</tr>
		        </tfoot>
		        <tbody>
			@foreach($tsolicitud as $solicitud)
				<tr>          
					@if ($solicitud->rendido < $solicitud->monto_solicitado)
						<td>{{$solicitud->id}}</td>
						<td>{{date('d-m-Y',strtotime($solicitud->fecha_solicitud))}}</td>
						<td>{{$solicitud->proyecto}}</td>
						<td>{{$solicitud->nombreProyecto}}</td>
						<td>{{number_format($solicitud->monto_solicitado)}}</td>
						<td>{{number_format($solicitud->rendido)}}</td>          
						<?php
							$saldo = $solicitud->monto_solicitado - $solicitud->rendido;
						?>
						<td><?php echo $saldo; ?></td> 
						
					<td><a class="btn btn-success form-rendir" data-target="#Rendir" data-toggle="modal" data-id="{{$solicitud->id}}" >Rendir</a></td>
					<td><a class="btn btn-success form-rendir2" data-target="#Rendir2" data-toggle="modal" data-id="{{$solicitud->id}}" >Rendir2</a></td>          
					
					@endif						
				</tr>
			@endforeach			
		</tbody>		
		</table>	
	</div>	
	{{$tsolicitud->render()}}				
 </div>

</div>
 
  

<!-- Modal -->
<div class="modal fade" id='Rendir' tabindex='-1' role='dialog' aria-labellebdy='myModalLabel'
  aria-hidden='true'>
  
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
           <h3 class="text-center">Usuario:{{$nombre}} </h3>
            <h3 class="text-center">Solicitud:&nbsp;<label class="solicitud"></label> </h3>            
        </div>

        <div class="modal-body modal-rendicion">
         
        </div>
        <div class="modal-footer">
          <button class="btn btn-primary" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
      
    </div>
  </div>

   <!-- Fin Modal -->

<!-- Modal 2-->
<div class="modal fullscreen-modal fade" id='Rendir2' tabindex='-1' role='dialog' aria-labellebdy='myModalLabel'
  aria-hidden='true'>
  
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <label class="text-center">SALDO:&nbsp;<label class="saldo"></label></label> 
            
        </div>
        <div class="modal-body modal-rendicion2">      	
        </div>        
        <div class="modal-footer">
          <button class="btn btn-primary" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
      
    </div>
  </div>
   <!-- Fin Modal 2-->


<!-- Modal Mis Rendiciones-->
<div class="modal fade" id='Rendiciones' tabindex='-1' role='dialog' aria-labellebdy='myModalLabel'
  aria-hidden='true'>
  
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
           <h2 class="text-center">Usuario:{{$nombre}} </h2>
        </div>
        <div class="modal-body modal-rendiciones">
         
        </div>
        <div class="modal-footer">
          <button class="btn btn-primary" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
      
    </div>
  </div>
<!-- Modal Mis Rendiciones-->

 {{--  {!!Form::close()!!}   --}}
<script>
  $(document).ready(function() 
  {

	$('#versolicitudes').DataTable(); 

 	$('.form-rendir').click(function(event)
   {
            event.preventDefault();                
            $('.modal-rendicion').html('Cargando...');
            var loc = $(this).attr('href');
            var id= $(this).data('id');  
    		    $('.solicitud').html(id);
    		
           
            $.ajax({
                  url: '/rendiciones/solicitudes/'+id+'/miRendicion',
                  method: 'GET'
                }).done(function(view) {
                    $('.modal-rendicion').html(view);
                    //console.log(data);
                  //$( this ).addClass( "done" );
            });

    });

	$('.form-rendir2').click(function(event)
   {         
            event.preventDefault();
            $('.modal-rendicion2').html('Cargando...');
            var loc = $(this).attr('href');
            var id= $(this).data('id');                        
    		    $('.solicitud').html(id);
        

            $.ajax({
                  url: '/rendiciones/solicitudes/'+id+'/miRendicion2',
                  method: 'GET'
                }).done(function(view) {
                    $('.modal-rendicion2').html(view);                    
            });

    }); 	

	$('#versolicitudes tr').on('click', function()
  {
  		var _id = $(this).find('td:first').html();  	
  		var _saldo = $(this).find('td:nth-child(7)').html();         
  		$('.saldo').html(_saldo);  
    
	});
 });


 $('.ver-rendicion').click(function(event) {
            event.preventDefault();
            $('.modal-rendiciones').html('Cargando...');
            var loc = $(this).attr('href');
            var id= $(this).data('id');

            console.log(id);
            $.ajax({
                  url: '/rendiciones/solicitudes/'+id+'/misRendiciones',
                  method: 'GET'
                }).done(function(view) {
                    $('.modal-rendiciones').html(view);
                    //console.log(data);
                  //$( this ).addClass( "done" );
            });

        });

</script>


<style>
 

  .fullscreen-modal .modal-dialog {
  margin: 0;
  margin-right: auto;
  margin-left: auto;
  width: 100%;
  }
  @media (min-width: 768px) {
  .fullscreen-modal .modal-dialog {
    width: 750px;
  }
  }
  @media (min-width: 992px) {
  .fullscreen-modal .modal-dialog {
    width: 970px;
  }
  }
  @media (min-width: 1200px) {
  .fullscreen-modal .modal-dialog {
     width: 1170px;
  }
  }
</style>


@endsection


















