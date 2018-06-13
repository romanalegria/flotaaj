@extends('layouts.app')

@section('htmlheader_title')
	Zonas
@endsection
<script>
function EventoAlert() {
swal(
 	 'Registro modificado con exito',
  	'Presione el boton OK!',
  	'success'
	)
}
	
</script>

@section('main-content')
<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Editar Zona: {{ $zona->nombre}}</h3>
			@if (count($errors)>0)
			<div class="alert alert-danger">
				<ul>
				@foreach ($errors->all() as $error)
					<li>{{$error}}</li>
				@endforeach
				</ul>
			</div>
			@else
			
			@endif
		</div>
	</div>
			{!!Form::model($zona,['method'=>'PUT','route'=>['zonas.update',$zona->id],'files'=>'true'])!!}
            {{Form::token()}}
            	<div class="row">
    				<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    					<div class="form-group">
            				<label for="nombre">Código</label>
            				<input type="text" name="codigo" required value="{{$zona->codigo}}" class="form-control">
           				 </div>
			    	</div>   	
				</div>
    			<div class="row">	
    				<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    					<div class="form-group">
            				<label for="nombre">Nombre</label>
            				<input type="text" name="nombre" required value="{{$zona->nombre}}" class="form-control">
           				 </div>
			    	</div>   	 
   			  	</div>
				<div class="row">
			    	<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			            <div class="form-group">
			            	<button class="btn btn-primary" type="submit" onclick="EventoAlert();">Guardar</button>
			            	<button class="btn btn-danger" type="reset">Cancelar</button>
			            </div>
			        </div>
    			</div>  

	{!!Form::close()!!}		
            
	
@endsection