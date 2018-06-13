@extends('layouts.app')

@section('htmlheader_title')
	Flota AJ
@endsection

@section('main-content')

<script>
    $(document).ready(function() {
        $('#mismantenciones').DataTable({
        	
        });        
    } );
</script>

<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Listado de Mis Mantenciones :
		{{$vehiculo->name}}</h3>
</div>
<div class="row">
	<div  class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
			
	</div>	
	<div  class="col-lg-6 col-md-6 col-sm-6 col-xs-6">		
		<a href="{{Route('mismantenciones_excel')}}"><button class="fa fa-file-excel-o btn btn-success">&nbsp;Excel</button></a>
		
	</div>	

</div> 
<br>


<div class="row">
	<div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
		<div class="table-responsive">	
			<table id="mismantenciones" class="display" cellspacing="0" width="100%">
        		<thead style="background-color: #2e2f89; color:#259551; font-weight: bold;">
		            <tr>
		                <th>Solicitud N°</th>
		                <th>Fecha Solicitud</th>
		                <th>Estado</th>		                
		                <th>Acciones</th>
		            </tr>
		        </thead>
		        <tfoot>
		        	<tr>
		        		<th>Solicitud N°</th>
		                <th>Fecha Solictud</th>
		                <th>Estado</th>		                
		                <th>Acciones</th>
		        	</tr>
		        </tfoot>
		        <tbody>
		        	@foreach ($solicitudes as $sol)
				<tr>
					<td>{{ $sol->id}}</td>
					<td>{{date('d-m-Y',strtotime($sol->fecha_creacion))}}</td>									
					@if($sol->estado == 0)
						<td style="background-color: red; color: white ">Sin Procesar</td>
					@endif	
					@if($sol->estado == 1)
						<td style="background-color: yellow; color: white">En Proceso</td>
					@endif
					@if($sol->estado == 2)
						<td style="background-color: green; color: white">Terminado</td>
					@endif
					@if($sol->estado == 3)
						<td style="background-color: orange; color: white">Cancelada</td>
					@endif
					<td>
						<a href="#"><button class="btn btn-info">Ver</button></a>                        
					</td>
				</tr>			
			
				@endforeach
		      </tbody>
    		 </table>   
    	</div>
		{{$solicitudes->render()}}
	</div>
</div>


 

@endsection