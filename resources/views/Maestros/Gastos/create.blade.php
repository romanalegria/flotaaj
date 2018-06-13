@extends('layouts.app')

@section('htmlheader_title')
	Gastos
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
			<h3>Nueva Gasto</h3>
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
			{!!Form::open(array('url'=>'maestros/gastos','method'=>'POST','autocomplete'=>'off','files'=>'true'))!!}
            {{Form::token()}}
    <div class="row">
    	<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    		<div class="form-group">
            	<label for="codigo">Detalle</label>
            	<input type="text" name="detalle" required value="{{old('detalle')}}" class="form-control" placeholder="Detalle del Gasto...">
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