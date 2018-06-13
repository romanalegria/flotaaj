@extends('layouts.app')

@section('htmlheader_title')
	Definir topes de gastos
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
			<h3>Nuevo Tope</h3>
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
			{!!Form::open(array('url'=>'maestros/topes','method'=>'POST','autocomplete'=>'off','files'=>'true'))!!}
           {{Form::token()}}
    

    <div class="row">
        <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
            <div class="form-group">
                <label>Zona</label>
                <select name="zona" class="form-control">
                    @foreach ($zonas as $zon)
                        <option value="{{$zon->id}}">{{$zon->nombre}}</option>
                    @endforeach
                </select>
            </div>
        </div>
         <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
            <div class="form-group">
                <label>Motivo</label>
                <select name="concepto" class="form-control">
                    @foreach ($conceptos as $con)
                        <option value="{{$con->id}}">{{$con->concepto}}</option>
                    @endforeach
                </select>
            </div>
        </div>

    </div>

    <div class="row">
        <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
            <div class="form-group">
                <label>Sub Concepto</label>
                <select name="subconcepto" class="form-control">
                    <option value=0>SIN SUB CONCEPTO</option>
                    @foreach ($gastos as $gas)
                        <option value="{{$gas->id}}">{{$gas->detalle}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
            <div class="form-group">
                <label>Autorización</label>
                <select name="autoriza" class="form-control">
                    <option value=0>NO AUTORIZA</option>
                    <option value=1>SI AUTORIZA</option>
                </select>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
            <div class="form-group">
                <label for="monto">Monto</label>
                <input type="number" id="monto" name="monto" required value="{{old('monto')}}" class="form-control" placeholder="Monto tope...">
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