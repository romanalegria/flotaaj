@extends('layouts.app')

@section('htmlheader_title')
	Topes de gastos
@endsection

@section('main-content')

<script>
    $(document).ready(function() {
        $('#example').DataTable();
    } );
</script>

<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Listado Topes <a href="topes/create"><button class="btn btn-success">Nuevo</button></a></h3>
		@include('maestros.topes.search')
	</div>
</div>


<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">	
			<table id="example" class="display" cellspacing="0" width="100%">
        		<thead style="background-color: #2e2f89; color:#259551; font-weight: bold;">
		            <tr>
		                <th>Id</th>
		                <th>Zona</th>
		                <th>Concepto</th>
		                <th>SubConcepto</th>
		                <th>Tope</th>
						<th>Autorizado</th>
		                <th>Acciones</th>
		            </tr>
		        </thead>
		        <tfoot>
		        	<tr>
		        		<th>Id</th>
		                <th>Zona</th>
		                <th>Concepto</th>
		                <th>SubConcepto</th>
		                <th>Tope</th>
		                <th>Autorizado</th>	                
		                <th>Acciones</th>
		        	</tr>
		        </tfoot>
		        <tbody>
		        	@foreach ($topes as $top)
				<tr>
					<td>{{ $top->id}}</td>
					<td>{{ $top->nombre}}</td>
					<td>{{ $top->concepto}}</td>
					<td>{{ $top->detalle}}</td>
					<td>{{ $top->tope}}</td>	
					
						@if ($top->autoriza == 0)
							<td>NO AUTORIZADO</td>
						@else	
							<td>SI AUTORIZADO</td>
						@endif

					
					<td>
						<a href="{{URL::action('TopeController@edit',$top->id)}}"><button class="btn btn-info">Editar</button></a>
                         <a href="" data-target="#modal-delete-{{$top->id}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
					</td>
				</tr>
				@include('maestros.topes.modal')
				@endforeach
		      </tbody>
    		 </table>   
    	</div>
		{{$topes->render()}}
	</div>
</div>
@endsection