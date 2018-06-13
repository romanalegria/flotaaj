@extends('layouts.app')

@section('htmlheader_title')
	Tipo Flota
@endsection


@section('main-content')

<script>
    $(document).ready(function() {
        $('#flotas').DataTable();
    } );
</script>

<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Listado Tipo Flotas <a href="flotas/create"><button class="btn btn-success">Nuevo</button></a></h3>
		@include('maestros.flotas.search')
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">	
			<table id="flotas" class="display" cellspacing="0" width="100%">
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
		        	@foreach ($flotas as $flo)
				<tr>
					<td>{{ $flo->id}}</td>				
					<td>{{ $flo->nombre}}</td>
					<td>
						<a href="{{URL::action('FlotaController@edit',$flo->id)}}"><button class="btn btn-info">Editar</button></a>
                         <a href="" data-target="#modal-delete-{{$flo->id}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
					</td>
				</tr>
				@include('maestros.flotas.modal')
				@endforeach
		      </tbody>
    		 </table>   
    	</div>
		{{$flotas->render()}}
	</div>
</div>

@endsection