@extends('layouts.app')

@section('htmlheader_title')
	Tipo Documento
@endsection


<script>
function GuardarAlert() {
swal(
     'Registro creado con exito',
    'Presione el boton OK!',
    'success'
    )
}
    
</script>

@section('main-content')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Nuevo documento</h3>
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
			{!!Form::open(array('url'=>'maestros/documentos','method'=>'POST','autocomplete'=>'off','files'=>'true'))!!}
            {{Form::token()}}
    <div class="row">
    	<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    		<div class="form-group">
            	<label for="codigo">Código</label>
            	<input type="text" name="codigo" required value="{{old('codigo')}}" class="form-control" placeholder="Código...">
            </div>
    	</div>
    </div>
    <div class="row">
    	<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    		<div class="form-group">
            	<label for="nombre">Nombre</label>
            	<input type="text" name="nombre" required value="{{old('nombre')}}" class="form-control" placeholder="Nombre del Documento...">
            </div>  	
		</div>
    </div>
    <div class="row">
            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            	<button class="btn btn-primary" type="submit" onclick="GuardarAlert();">Guardar</button>
            	<button class="btn btn-danger" type="reset">Cancelar</button>
            </div>
     </div>

			{!!Form::close()!!}		


@endsection