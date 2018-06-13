@extends('layouts.app')

@section('htmlheader_title')
	Tipo Documento
@endsection


@section('main-content')

<script>
    $(document).ready(function() {
        $('#documentos').DataTable();
    } );
</script>

<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Listado Tipo Documento <a href="documentos/create"><button class="btn btn-success">Nuevo</button></a></h3>
		@include('maestros.documentos.search')
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">	
			<table id="documentos" class="display" cellspacing="0" width="100%">
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
		        	@foreach ($documentos as $doc)
				<tr>
					<td>{{ $doc->id}}</td>
					<td>{{ $doc->codigo}}</td>
					<td>{{ $doc->nombre}}</td>
					<td>
						<a href="{{URL::action('DocumentoController@edit',$doc->id)}}"><button class="btn btn-info">Editar</button></a>
                         <a href="" data-target="#modal-delete-{{$doc->id}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
					</td>
				</tr>
				@include('maestros.documentos.modal')
				@endforeach
		      </tbody>
    		 </table>   
    	</div>
		{{$documentos->render()}}
	</div>
</div>

@endsection