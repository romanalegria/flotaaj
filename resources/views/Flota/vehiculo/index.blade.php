@extends('layouts.app')

@section('htmlheader_title')
	Flota AJ
@endsection

@section('main-content')



<div class="row">
	<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
		<h3>Listado Vehiculos <a href="vehiculo/create"><button class="btn btn-success">&nbsp;Nuevo</button></a></h3>
		@include('flota.vehiculo.search')		
	</div>	
</div>
<div class="row">
	<div  class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
			
	</div>	
	<div  class="col-lg-6 col-md-6 col-sm-6 col-xs-6">		
		<a href="{{Route('index')}}"><button class="fa fa-file-excel-o btn btn-success">&nbsp;Excel</button></a>
		{{-- {{URL::action('VehiculoController@excel')}} --} --}}
	</div>	
</div> 



<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">	
			<table id="vehiculos" class="display nowrap" cellspacing="0" width="100%">
        		<thead style="background-color: #2e2f89; color:#259551; font-weight: bold;">
		            <tr>
		                <th>Id</th>
		                <th>Nombre</th>
		                <th>Marca</th>
		                <th>Modelo</th>
		                <th>Año</th>
		                <th>Patente</th>
		                <th>Encargado</th>
		                <th>Tipo Flota</th>
		                <th>Documentos</th>
		                <th>Acciones</th>
		            </tr>
		        </thead>
		        <tfoot>
		        	<tr>
		        		<th>Id</th>
		                <th>Nombre</th>
		                <th>Marca</th>
		                <th>Modelo</th>
		                <th>Año</th>
		                <th>Patente</th>
		                <th>Encargado</th>
		                <th>Tipo Flota</th>
		                <th>Documentos</th>
		                <th>Acciones</th>
		        	</tr>
		        </tfoot>
		        <tbody>
		        	@foreach ($vehiculos as $veh)
				<tr>
					<td>{{ $veh->id}}</td>
					<td>{{ $veh->nombre}}</td>
					<td>{{ $veh->marca}}</td>
					<td>{{ $veh->modelo}}</td>
					<td>{{ $veh->axo}}</td>
					<td>{{ $veh->patente}}</td>
					<td></td>
					<td>{{ $veh->nombreFlota}}</td>
					<td>
					    <a href="{{url('flota/vehiculo/'.$veh->id.'/documentos')}}"><button type="submit" class="btn btn-success fa fa-search">&nbsp;Documentos</button></a>
            
						
					</td>
				
					<td>
						<a href="{{URL::action('VehiculoController@edit',$veh->id)}}"><button class="btn btn-info">Editar</button></a>
                        {{-- <a href="" data-target="#modal-delete-{{$veh->id}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a> --}}

						<div class="btn-group">
						   <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
						   	Más opciones<span class="caret"></span>
						   </button>
						   <ul class="dropdown-menu" role="menu">
						   	 
						      <li><a class="ver-asignacion" data-target="#Asignaciones" data-toggle="modal" data-id="{{$veh->patente}}" >Asignaciones</a></li>
						      <li><a href="{{url('flota/vehiculo/'.$veh->id.'/planificaMan')}}">Mantenciones</a></li>
						      <li><a href="#">Mant. Preventivo</a></li>						     
						   </ul>
						</div>

					</td>
				</tr>

				@include('flota.vehiculo.modal')
			
				@endforeach
		      </tbody>
    		 </table>   
    	</div>
		{{$vehiculos->render()}}
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

  <script>
    $(document).ready(function() {
        $('#vehiculos').DataTable({});        
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


		@if(Session::has('message'))
        var type = "{{ Session::get('alert-type', 'info') }}";
        switch(type){
            case 'info':
                toastr.info("{{ Session::get('message') }}");
                break;
            
            case 'warning':
                toastr.warning("{{ Session::get('message') }}");
                break;
            case 'success':
                toastr.success("{{ Session::get('message') }}");
                break;
            case 'error':
                toastr.error("{{ Session::get('message') }}");
                break;
        }
    	@endif

</script>

@endsection