@extends('layouts.app')

@section('htmlheader_title')
	Gastos
@endsection


@section('main-content')

<script>
    $(document).ready(function() {
        $('#gastos').DataTable();
    } );
</script>

<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Listado Gastos <a href="gastos/create"><button class="btn btn-success">Nuevo</button></a></h3>
		@include('maestros.gastos.search')
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">	
			<table id="gastos" class="display" cellspacing="0">
        		<thead style="background-color: #2e2f89; color:#259551; font-weight: bold;">
		            <tr>
		                <th>Id</th>
		                <th>Detalle</th>	
		                <th>Acciones</th>	      
		            </tr>
		        </thead>
		        <tfoot>
		        	<tr>
		        		<th>Id</th>
		                <th>Detalle</th>		                
		                <th>Acciones</th>	      
		        	</tr>
		        </tfoot>
		        <tbody>
		        	@foreach ($gastos as $gas)
				<tr>
					<td>{{ $gas->id}}</td>
					<td>{{ $gas->detalle}}</td>
					<td>
						<a href="{{URL::action('GastoController@edit',$gas->id)}}"><button class="btn btn-info">Editar</button></a>
                         <a href="" data-target="#modal-delete-{{$gas->id}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
					</td>
				</tr>
				@include('maestros.gastos.modal')
				@endforeach
		      </tbody>
    		 </table>   
    	</div>
		{{$gastos->render()}}
	</div>
</div>

@endsection