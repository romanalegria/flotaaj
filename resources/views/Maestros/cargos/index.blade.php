@extends('layouts.app')

@section('htmlheader_title')
	Cargos
@endsection


@section('main-content')

<script>
    $(document).ready(function() {
        $('#cargos').DataTable();
    } );
</script>

<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Listado Cargos <a href="cargos/create"><button class="btn btn-success">Nuevo</button></a></h3>
		@include('maestros.cargos.search')
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">	
			<table id="cargos" class="display" cellspacing="0" width="100%">
        		<thead style="background-color: #2e2f89; color:#259551; font-weight: bold;">
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
		        	@foreach ($cargos as $car)
				<tr>
					<td>{{ $car->id}}</td>
					<td>{{ $car->nombre}}</td>
					<td>
						<a href="{{URL::action('CargoController@edit',$car->id)}}"><button class="btn btn-info">Editar</button></a>
                         <a href="" data-target="#modal-delete-{{$car->id}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
					</td>
				</tr>
				@include('maestros.cargos.modal')
				@endforeach
		      </tbody>
    		 </table>   
    	</div>
		{{$cargos->render()}}
	</div>
</div>

@endsection