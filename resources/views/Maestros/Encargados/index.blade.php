@extends('layouts.app')

@section('htmlheader_title')
	Encargados
@endsection

@section('main-content')

<script>
    $(document).ready(function() {
        $('#example').DataTable();
    } );
</script>

<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Listado Encargados <a href="encargados/create"><button class="btn btn-success">Nuevo</button></a></h3>
		@include('maestros.encargados.search')
	</div>
</div>


<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">	
			<table id="example" class="display" cellspacing="0" width="100%">
        		<thead style="background-color: #2e2f89; color:#259551; font-weight: bold;">
		            <tr>
		                <th>Id</th>
		                <th>Rut</th>
		                <th>Nombres</th>
		                <th>Apellidos</th>
		                <th>Télefono</th>
		                <th>Vencimiento</th>
		                <th>Acciones</th>
		            </tr>
		        </thead>
		        <tfoot>
		        	<tr>
		        		<th>Id</th>
		                <th>Rut</th>
		                <th>Nombres</th>
		                <th>Apellidos</th>
		                <th>Télefono</th>
		                <th>Vencimiento</th>
		                <th>Acciones</th>
		        	</tr>
		        </tfoot>
		        <tbody>
		        	@foreach ($encargados as $enc)
				<tr>
					<td>{{ $enc->id}}</td>
					<td>{{ $enc->rut}}</td>
					<td>{{ $enc->nombres}}</td>
					<td>{{ $enc->apellidos}}</td>
					<td>{{ $enc->telefono}}</td>
					@if($enc->fecha_vencimiento > date('Y-m-d'))
						<td style="background-color: green; color: white ">{{date('d-m-Y',strtotime($enc->fecha_vencimiento))}}</td>
					@else
						<td style="background-color: red; color: white">{{ $enc->fecha_vencimiento}}</td>
					@endif
					
					<td>
						<a href="{{URL::action('EncargadoController@edit',$enc->id)}}"><button class="btn btn-info">Editar</button></a>
                         <a href="" data-target="#modal-delete-{{$enc->id}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
					</td>
				</tr>
				@include('maestros.encargados.modal')
				@endforeach
		      </tbody>
    		 </table>   
    	</div>
		{{$encargados->render()}}
	</div>
</div>
@endsection