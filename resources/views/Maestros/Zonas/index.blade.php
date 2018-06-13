@extends('layouts.app')

@section('htmlheader_title')
	Zonas
@endsection


@section('main-content')

<script>
    $(document).ready(function() {
        $('#zonas').DataTable();
    } );

      @if(Session::has('message'))
        var type = "{{ Session::get('alert-type', 'info') }}";
        switch(type){
            case 'info':
                toastr.info("{{ Session::get('message') }}");
                break;
            
            case 'warning':
                toastr.warning("{{ Session::get('message') }}");
                break;
            case 'success':
                toastr.success("{{ Session::get('message') }}");
                break;
            case 'error':
                toastr.error("{{ Session::get('message') }}");
                break;
        }
    	@endif
</script>

<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Listado Zonas <a href="zonas/create"><button class="btn btn-success">Nuevo</button></a></h3>
		@include('maestros.zonas.search')
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">	
			<table id="zonas" class="display" cellspacing="0" width="100%">
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
		        	@foreach ($zonas as $zon)
				<tr>
					<td>{{ $zon->id}}</td>
					<td>{{ $zon->codigo}}</td>
					<td>{{ $zon->nombre}}</td>
					<td>
						<a href="{{URL::action('ZonaController@edit',$zon->id)}}"><button class="btn btn-info">Editar</button></a>
                         <a href="" data-target="#modal-delete-{{$zon->id}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
					</td>
				</tr>
				@include('maestros.zonas.modal')
				@endforeach
		      </tbody>
    		 </table>   
    	</div>
		{{$zonas->render()}}
	</div>
</div>

@endsection