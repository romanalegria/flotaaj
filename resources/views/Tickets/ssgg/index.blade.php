@extends('layouts.app')

@section('htmlheader_title')
	Flota AJ
@endsection

@section('main-content')

<script>
    $(document).ready(function() {
        $('#incidencias').DataTable();        
    } );
</script>

<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Listado incidencias <a href="ssgg/create"><button class="btn btn-success">Nuevo</button></a></h3>
		@include('Tickets.ssgg.search')
	</div>
</div>


<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">	
			<table id="incidencias" class="display" cellspacing="0" width="100%">
        		<thead style="background-color: #2e2f89; color:#259551; font-weight: bold;">
		            <tr>
		                <th>Id</th>
		                <th>Resumen</th>	
						<th>Solicitante</th>
		                <th>Sucursal</th>
		                <th>Fecha Creación</th>
		                <th>Fecha Cierre</th>
		                <th>Estado</th>
		                <th>Acciones</th>
		            </tr>
		        </thead>
		        <tfoot>
		        	<tr>
		        		<th>Id</th>
		                <th>Resumen</th>
		                <th>Solicitante</th>		                
		                <th>Sucursal</th>
		                <th>Fecha Creación</th>
		                <th>Fecha Cierre</th>
		                <th>Estado</th>
		                <th>Acciones</th>
		        	</tr>
		        </tfoot>
		        <tbody>
		        	@foreach ($incidencias as $inc)
				<tr>
					
					<td>{{ $inc->id}}</td>
					<td>{{ $inc->resumen}}</td>
					<td>{{ $inc->name}}</td>
					@if($inc->sucursal = 1)
						<td>La Divisa 0340</td>
					@else
						<td>Holanda 100</td>
					@endif
					<td> {{$inc->fecha_creacion}} </td>					
					<td>{{ $inc->fecha_cierre}}</td>				
					@if(is_null($inc->fecha_cierre))
						<td>Abierta</td>
					@else
						<td>Cerrada</td>
					@endif
							
					<td>
						<a href="{{URL::action('SsggController@edit',$inc->id)}}"><button class="btn btn-info">Editar</button></a>
                        <a href="" data-target="#modal-delete-{{$inc->id}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
					</td>
				</tr>

				@include('Tickets.ssgg.modal')
			
				@endforeach
		      </tbody>
    		 </table>   
    	</div>
		{{$incidencias->render()}}
	</div>
</div>


  <!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Modal Header</h4>
      </div>
      <div class="modal-body">
        <p>Some text in the modal.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

@endsection