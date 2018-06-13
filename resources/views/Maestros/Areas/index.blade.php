@extends('layouts.app')

@section('htmlheader_title')
	Aréas de Negocios
@endsection


@section('main-content')

<script>
    $(document).ready(function() {
        $('#areas').DataTable();
    } );
</script>

<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Listado Aréas de Negocios <a href="areas/create"><button class="btn btn-success">Nuevo</button></a></h3>
		@include('maestros.areas.search')
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">	
			<table id="areas" class="display" cellspacing="0" width="100%">
        		<thead style="background-color: #2e2f89; color:#259551; font-weight: bold;">
		            <tr>
		                <th>Id</th>
		                <th>Código</th>
		                <th>Nombre</th>	
		                <th>Acciones</th>	      
		            </tr>
		        </thead>
		        <tfoot>
		        	<tr>
		        		<th>Id</th>
		                <th>Código</th>
		                <th>Nombre</th>		                
		                <th>Acciones</th>	      
		        	</tr>
		        </tfoot>
		        <tbody>
		        	@foreach ($areas as $are)
				<tr>
					<td>{{ $are->id}}</td>
					<td>{{ $are->codigo}}</td>
					<td>{{ $are->nombre}}</td>
					<td>
						<a href="{{URL::action('AreaController@edit',$are->id)}}"><button class="btn btn-info">Editar</button></a>
                         <a href="" data-target="#modal-delete-{{$are->id}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
					</td>
				</tr>
				@include('maestros.areas.modal')
				@endforeach
		      </tbody>
    		 </table>   
    	</div>
		{{$areas->render()}}
	</div>
</div>

@endsection