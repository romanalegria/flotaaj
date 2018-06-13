@extends('layouts.app')

@section('htmlheader_title')
	Categorías
@endsection


@section('main-content')

<script>
    $(document).ready(function() {
        $('#categorias').DataTable();
    } );
</script>

<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Listado Categorías <a href="categorias/create"><button class="btn btn-success">Nuevo</button></a></h3>
		@include('maestros.categorias.search')
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">	
			<table id="categorias" class="display" cellspacing="0" width="100%">
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
		        	@foreach ($categorias as $cat)
				<tr>
					<td>{{ $cat->id}}</td>				
					<td>{{ $cat->nombre}}</td>
					<td>
						<a href="{{URL::action('CategoriaController@edit',$cat->id)}}"><button class="btn btn-info">Editar</button></a>
                         <a href="" data-target="#modal-delete-{{$cat->id}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
					</td>
				</tr>
				@include('maestros.categorias.modal')
				@endforeach
		      </tbody>
    		 </table>   
    	</div>
		{{$categorias->render()}}
	</div>
</div>

@endsection