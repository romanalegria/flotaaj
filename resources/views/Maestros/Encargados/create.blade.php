@extends('layouts.app')

@section('htmlheader_title')
	Encargados
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
			<h3>Nuevo Encargado</h3>
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
			{!!Form::open(array('url'=>'maestros/encargados','method'=>'POST','autocomplete'=>'off','files'=>'true'))!!}
            {{Form::token()}}
    <div class="row">
    	<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
    		<div class="form-group">
            	<label for="rut">Rut</label>
            	<input type="text" id="rut" name="rut" required value="{{old('rut')}}" class="form-control" placeholder="Rut...">
            </div>
    	</div>
        
        <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
            <div class="form-group">
                <label for="nombres">Nombres</label>
                <input type="text" name="nombres" required value="{{old('nombres')}}" class="form-control" placeholder="Nombres...">
            </div>      
        </div>

    </div>
    
    <div class="row">
        <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
            <div class="form-group">
                <label for="apellidos">Apellidos</label>
                <input type="text" name="apellidos" required value="{{old('apellidos')}}" class="form-control" placeholder="Apellidos...">
            </div>      
        </div>
        <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
            <div class="form-group">
                <label for="telefono">Télefono Contacto</label>
                <input type="text" name="telefono" required value="{{old('telefono')}}" class="form-control" placeholder="Télefono...">
            </div>      
        </div>
    </div>
   
    <div class="row">
        <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
            <div class="form-group">
                <label for="fechav">Vencimiento Licencia</label>
                <input type="date" name="fechav" required value="{{old('fecha_vencimiento')}}" class="form-control" placeholder="Vencimiento Licencia...">
            </div>      
        </div>
         <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
            <div class="form-group">
                <label for="imagen">Licencia</label>
                <input type="file" name="licencia"   class="form-control">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
            <div class="form-group">
                <label>Cargo</label>
                <select name="cargo" class="form-control">
                    @foreach ($cargos as $car)
                        <option value="{{$car->id}}">{{$car->nombre}}</option>
                    @endforeach
                </select>
            </div>
        </div>
         <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
            <div class="form-group">
                <label>Aréa Negocio</label>
                <select name="area" class="form-control">
                    @foreach ($areas as $are)
                        <option value="{{$are->id}}">{{$are->nombre}}</option>
                    @endforeach
                </select>
            </div>
        </div>

    </div>

    <div class="row">
        <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
            <div class="form-group">
                <label>Asignar Usuario</label>
                <select name="usuario" class="form-control">
                    @foreach ($usuarios as $use)
                        <option value="{{$use->id}}">{{$use->name}}&nbsp;{{$use->email}}</option>
                    @endforeach
                </select>
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