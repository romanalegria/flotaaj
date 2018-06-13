@extends('layouts.app')

@section('htmlheader_title')
	Flota AJ
@endsection

@section('main-content')



<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Listado Control de arriendos <a href="arriendos/create"><button class="btn btn-success">Nuevo</button></a></h3>
		@include('arriendos.search')
	</div>
</div>


<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">	
			<table id="incidencias" class="display" cellspacing="0" width="100%">
        		<thead style="background-color: #2e2f89; color:#259551; font-weight: bold;">
		            <tr>
		                <th>Id</th>
		                <th>Fecha</th>		                
		                <th>Solicitante</th>		                
		                <th>Proyecto</th>
		                <th>Factura</th>
		                <th>Monto</th>
		                <th>Patente</th>
		                <th>Marca</th>
		                <th>Acciones</th>
		            </tr>
		        </thead>
		        <tfoot>
		        	<tr>
		        		<th>Id</th>
		                <th>Fecha</th>	
		                <th>Solicitante</th>		                	                
		                <th>Proyecto</th>
		                <th>Factura</th>
		                <th>Monto</th>
		                <th>Patente</th>
		                <th>Marca</th>
		                <th>Acciones</th>
		        	</tr>
		        </tfoot>
		        <tbody>
		        	@foreach ($arriendos as $arr)
				<tr>
					
					<td>{{ $arr->id}}</td>
					<td>{{date('d-m-Y',strtotime($arr->fecha))}}</td>					
					<td> {{$arr->name}} </td>					
					<td>{{ $arr->proyecto}}</td>				
					<td>{{ $arr->factura}}</td>				
					<td>{{ $arr->valorCancelado}}</td>				
					<td>{{ $arr->patente}}</td>				
					<td>{{ $arr->marca}}</td>				
							
					<td>
						<a href="{{URL::action('ArriendoController@edit',$arr->id)}}"><button class="btn btn-info">Editar</button></a>
                        <a href="" data-target="#modal-delete-{{$arr->id}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
					</td>
				</tr>

				@include('arriendos.modal')
			
				@endforeach
		      </tbody>
    		 </table>   
    	</div>
		{{$arriendos->render()}}
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


<script>
    $(document).ready(function() {
        $('#incidencias').DataTable();        
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


@endsection