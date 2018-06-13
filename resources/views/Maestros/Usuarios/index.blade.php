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
		<h3>Listado de usuarios <a href="usuarios/create"><button class="btn btn-success">Nuevo</button></a></h3>
		@include('maestros.usuarios.search')
	</div>
</div>


<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">	
			<table id="example" class="display" cellspacing="0" width="100%">
        		<thead style="background-color: #2e2f89; color:#259551; font-weight: bold;">
		            <tr>
		                <th>Id</th>
		                <th>Nombre</th>
		                <th>E-Mail</th>
		                <th>Codigo Sap</th>
		                <th>Monto Autotizado</th>
		                <th>Monto Solicitado</th>
		                <th>Jefatura</th>
						<th>Acciones</th>
		            </tr>
		        </thead>
		        <tfoot>
		        	<tr>
		        		<th>Id</th>
		                <th>Nombre</th>
		                <th>E-Mail</th>
		                <th>Codigo Sap</th>
		                <th>Monto Autotizado</th>
		                <th>Monto Solicitado</th>
		                <th>Jefatura</th>
						<th>Acciones</th>
		        	</tr>
		        </tfoot>
		        <tbody>
		        	@foreach ($usuarios as $usu)
				<tr>
					<td>{{ $usu->id}}</td>
					<td>{{ $usu->name}}</td>
					<td>{{ $usu->email}}</td>
					<td>{{ $usu->codigoSap}}</td>
					<td>{{ $usu->montoMaximo}}</td>
					<td>{{ $usu->montoPedido}}</td>
					<td>{{ $usu->nombreJefe}}</td>

					
					
					<td>
						<a href="{{URL::action('UsuarioController@edit',$usu->id)}}"><button class="btn btn-info">Editar</button></a>
                         <a href="" data-target="#modal-delete-{{$usu->id}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
					</td>
				</tr>
				@include('maestros.usuarios.modal')
				@endforeach
		      </tbody>
    		 </table>   
    	</div>
		{{$usuarios->render()}}
	</div>
</div>
@endsection