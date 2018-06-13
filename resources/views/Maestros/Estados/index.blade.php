@extends('layouts.app')

@section('htmlheader_title')
	Estado del Vehículo
@endsection


@section('main-content')

<script>
    $(document).ready(function() {
        $('#estados').DataTable();
    } );
</script>

<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Listado Estados del Vehículo <a href="estados/create"><button class="btn btn-success">Nuevo</button></a></h3>
		@include('maestros.estados.search')
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">	
			<table id="estados" class="display" cellspacing="0" width="100%">
        		<thead>
		            <tr>
		                <th>Id</th>
		                <th>Nombre</th>	
		                <th>Acciones</th>	      
		            </tr>
		        </thead>
		        <tfoot>
		        	<tr>
		        		<th>Id</th>		                
		                <th>Nombre</th>		                
		                <th>Acciones</th>	      
		        	</tr>
		        </tfoot>
		        <tbody>
		        	@foreach ($estados as $est)
				<tr>
					<td>{{ $est->id}}</td>				
					<td>{{ $est->nombre}}</td>
					<td>
						<a href="{{URL::action('EstadoController@edit',$est->id)}}"><button class="btn btn-info">Editar</button></a>
                         <a href="" data-target="#modal-delete-{{$est->id}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
					</td>
				</tr>
				@include('maestros.estados.modal')
				@endforeach
		      </tbody>
    		 </table>   
    	</div>
		{{$estados->render()}}
	</div>
</div>

@endsection