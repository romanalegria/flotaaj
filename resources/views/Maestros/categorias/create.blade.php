@extends('layouts.app')

@section('htmlheader_title')
	Categorías
@endsection

<script>
	function GuardarAlert() {
		swal(
 	 		'Registro grabado con exito',
  			'Presione el boton OK!',
  			'success'
		)
	}
	
</script>

@section('main-content')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Nueva Categoría</h3>
			@if (count($errors)>0)
			<div class="alert alert-danger">
				<ul>
				@foreach ($errors->all() as $error)
					<li>{{$error}}</li>
				@endforeach
				</ul>
			</div>
			@endif
		</div>
	</div>
			{!!Form::open(array('url'=>'maestros/categorias','method'=>'POST','autocomplete'=>'off','files'=>'true'))!!}
            {{Form::token()}}
    <div class="row">
    	<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    		<div class="form-group">
            	<label for="codigo">Nombre</label>
            	<input type="text" name="nombre" required value="{{old('nombre')}}" class="form-control" placeholder="Nombre de la Categoría...">
            </div>  	
		</div>
    </div>
    <div class="row">
            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            	<button class="btn btn-primary" type="submit" onclick="GuardarAlert();"">Guardar</button>
            	<button class="btn btn-danger" type="reset">Cancelar</button>
            </div>
     </div>

			{!!Form::close()!!}		


@endsection