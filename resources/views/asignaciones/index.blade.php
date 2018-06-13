@extends('layouts.app')

@section('htmlheader_title')
	Flota AJ
@endsection

@section('main-content')



<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Asignaciones / Devoluciones de flota <a href="asignaciones/create"><button class="btn btn-success">Nuevo</button></a></h3>
		@include('asignaciones.search')
	</div>
</div>


<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">	
			<table id="asignaciones" class="display" cellspacing="0" width="100%">
        		<thead style="background-color: #2e2f89; color:#259551; font-weight: bold;">
		            <tr>
		                <th>Id</th>
		                <th>Encargado</th>		                
		                <th>Vehiculo</th>
		                <th>Fecha Asignacion</th>		                
		                <th>Historial</th>		                
		                <th>Devoluciòn</th>
		                <th>Acciones</th>

		            </tr>
		        </thead>
		        <tfoot>
		        	<tr>
		        		 <th>Id</th>
		                <th>Encargado</th>		                
		                <th>Vehiculo</th>
		                <th>Fecha Asignacion</th>
		                <th>Historial</th>
		                <th>Devoluciòn</th>		                
		                <th>Acciones</th>
		        	</tr>
		        </tfoot>
		        <tbody>
		        	@foreach ($asignaciones as $asig)
				<tr>
					
					<td>{{ $asig->id}}</td>
					<td>{{ $asig->encargado}}&nbsp;{{ $asig->apellidos}}</td>
					<td> {{$asig->patente}} </td>
					<td>{{date('d-m-Y',strtotime($asig->fecha_asignacion))}}</td>										
					<td>
					    {{--  <a href="{{url('asignaciones/'.$asig->patente.'/asignaciones')}}" data-target="#misAsignaciones" data-toggle="modal"><button type="submit" class="btn btn-success fa fa-search">&nbsp;Ver Asignaciones</button></a> --}}					    
            
						 <a class="btn btn-success ver-asignacion" data-target="#Asignaciones" data-toggle="modal" data-id="{{$asig->patente}}" >Ver Asignaciones</a> 
					</td>	
					<td><a class="btn btn-default ver-devolucion" data-target="#Devolucion" data-toggle="modal" data-id="{{$asig->id_devolucion}}">
						{{ $asig->id_devolucion}}</a></td>
					<td>
						@if ($asig->id_devolucion == 0)
							<a href="{{URL::action('AsignarController@edit',$asig->id)}}"><button class="btn btn-info">Editar</button></a>
                        	{{-- <a href="" data-target="#modal-delete-{{$asig->id}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a> --}}
                        	<a href="{{URL::action('AsignarController@edit_asignacion',$asig->id)}}"><button class="btn btn-danger">Devolver</button></a>	
                        @else
                        	<a class="btn btn-info  btn-block ver-una-asignacion" data-target="#Asignacion" data-toggle="modal" data-id="{{$asig->id}}">
						Consultar</a>	
						@endif
						
                       
					</td>
				</tr>

				@include('asignaciones.modal')
				
			
				@endforeach
		      </tbody>
    		 </table>   
    	</div>
		{{$asignaciones->render()}}
	</div>
</div>


<!-- Modal -->
<div class="modal fade" id='Asignaciones' tabindex='-1' role='dialog' aria-labellebdy='myModalLabel'
  aria-hidden='true'>
  
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h2 class="text-center">Listado de Asignaciones</h2>
          <h2 class="text-center">Patente:&nbsp;<label class="patente"></label> </h2>
        </div>
        <div class="modal-body modal-asignaciones">
         
        </div>
        <div class="modal-footer">
          <button class="btn btn-primary" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
      
    </div>
  </div>

   <!-- Fin Modal -->

<!-- Modal Devolucion -->
<div class="modal fade" id='Devolucion' tabindex='-1' role='dialog' aria-labellebdy='myModalLabel'
  aria-hidden='true'>
  
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button class="close" data-dismiss="modal" aria-hidden="true">&times;</button>        
          <h2 class="text-center">Devolución Nº:&nbsp;<label class="devolucion"></label> </h2>
        </div>
        <div class="modal-body modal-devoluciones">
         
        </div>
        <div class="modal-footer">
          <button class="btn btn-primary" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
      
    </div>
  </div>

   <!-- Fin Modal devoluciones-->

<!-- Modal una Asignacion -->
<div class="modal fade" id='Asignacion' tabindex='-1' role='dialog' aria-labellebdy='myModalLabel'
  aria-hidden='true'>
  
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button class="close" data-dismiss="modal" aria-hidden="true">&times;</button>        
          <h2 class="text-center">Asignacion No:&nbsp;&nbsp;<label class="asignacion"></label> </h2>
        </div>
        <div class="modal-body modal-una-asignacion">
         
        </div>
        <div class="modal-footer">
          <button class="btn btn-primary" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
      
    </div>
  </div>

   <!-- Fin Modal una asignacion-->


<script>
$(document).ready(function() {
    $('#asignaciones').DataTable();
    $('#verasignaciones').DataTable();        
} );

$('.ver-asignacion').click(function(event) {
	event.preventDefault();
	$('.modal-asignaciones').html('Cargando...');
    var loc = $(this).attr('href');
    var id= $(this).data('id');
    $('.patente').html(id);

    console.log(id);
    $.ajax({
	  url: '/asignaciones/'+id+'/asignaciones',
	  method: 'GET'
	}).done(function(view) {
		$('.modal-asignaciones').html(view);
		//console.log(data);
	  //$( this ).addClass( "done" );
	});

});

$('.ver-devolucion').click(function(event) {
	event.preventDefault();
	$('.modal-devoluciones').html('Cargando...');
    var loc = $(this).attr('href');
    var id= $(this).data('id');
    $('.devolucion').html(id);

    console.log(id);
    $.ajax({
	  url: '/devoluciones/'+id+'/ver_devolucion',
	  method: 'GET'
	}).done(function(view) {
		$('.modal-devoluciones').html(view);
		//console.log(data);
	  //$( this ).addClass( "done" );
	});

});

$('.ver-una-asignacion').click(function(event) {
	event.preventDefault();
	$('.modal-una-asignacion').html('Cargando...');
    var loc = $(this).attr('href');
    var id= $(this).data('id');
    $('.asignacion').html(id);

   
    $.ajax({
	  url: '/asignaciones/'+id+'/verUnaAsignacion',
	  method: 'GET'
	}).done(function(view) {
		$('.modal-una-asignacion').html(view);
		console.log(data);
	  //$( this ).addClass( "done" );
	});

});


</script>
@endsection