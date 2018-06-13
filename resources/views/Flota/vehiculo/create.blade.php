@extends('layouts.app')

@section('htmlheader_title')
	Vehículos
@endsection

<script>
function EventoAlert() {
swal(
     'Registro creado con exito',
    'Presione el boton OK!',
    'success'
    )
}
    
  $(document).ready(function() {
        $('#documentos').DataTable();
    } );
</script>

@section('main-content')
<div class="panel panel-primary">
    <div class="panel-heading">
        Nuevo Vehículo
    </div>
<div class="panel-body">
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">			
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
			{!!Form::open(array('url'=>'flota/vehiculo','method'=>'POST','autocomplete'=>'off','files'=>'true'))!!}
            {{Form::token()}}
    <div class="row">
    	<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    		<div class="form-group">
            	<label for="nombre">Nombre *</label>
            	<input type="text" id="rut" name="nombre" required value="{{old('nombre')}}" class="form-control" placeholder="Nombre...">
            </div>
    	</div>
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="marca">Marca</label>
                <input type="text" name="marca" required value="{{old('marca')}}" class="form-control" placeholder="Marca...">
            </div>      
        </div>
    </div>
   
    <div class="row">
        <div class="col-lg-4 col-sm-4 col-md-4 col-xs-4">
            <div class="form-group">
                <label for="modelo">Modelo</label>
                <input type="text" name="modelo" required value="{{old('modelo')}}" class="form-control" placeholder="Modelo...">
            </div>      
        </div>
         <div class="col-lg-4 col-sm-4 col-md-4 col-xs-4">
            <div class="form-group">
                <label for="numserie">N° Motor</label>
                <input type="text" name="numserie" required value="{{old('numserie')}}" class="form-control" placeholder="Numero de Serie...">
            </div>      
        </div>
         <div class="col-lg-4 col-sm-4 col-md-4 col-xs-4">
            <div class="form-group">
                <label for="axo">Año</label>
                <input type="number" name="axo" required value="{{old('axo')}}" class="form-control" placeholder="Año del Vehiculo...">
            </div>      
        </div>
        
    </div>

    <div class="row">
        <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
            <div class="form-group">
                <label>Tipo Flota</label>
                <select name="empresa" class="form-control">
                    @foreach ($tipos as $tip)
                        <option value="{{$tip->id}}">{{$tip->nombre}}</option>
                    @endforeach
                </select>
            </div>
        </div>
         <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
            <div class="form-group">
                <label>Estado Vehículo</label>
                <select name="estadovehiculo" class="form-control">
                    @foreach ($estados as $est)
                        <option value="{{$est->id}}">{{$est->nombre}}</option>
                    @endforeach
                </select>
            </div>
        </div>

         <div class="col-lg-4 col-sm-4 col-md-4 col-xs-4">
            <div class="form-group">
                <label for="kilometros">Kilometraje inicial</label>
                <input type="number" name="kilometraje" required value="{{old('kilometraje')}}" class="form-control" placeholder="Kilometraje del Vehiculo...">
            </div>      
        </div>

    </div>

    <div class="row">
       
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="patente">Patente</label>
                <input type="text" name="patente" required value="{{old('patente')}}" class="form-control" placeholder="Patente...">
            </div>      
        </div>
          <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="color">Color</label>
                <input type="text" name="color" required value="{{old('color')}}" class="form-control" placeholder="Color...">
            </div>  
        </div>   
    </div>    


    <div class="row">
       
            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                <div class="form-group">
                    <label>Aréa Negocio</label>
                     <select name="areanegocio" class="form-control">
                         @foreach ($areas as $are)
                          <option value="{{$are->id}}">{{$are->nombre}}</option>
                         @endforeach
                    </select>
                </div>
            </div>   

            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                <div class="form-group">
                    <label>Tipo Vehículo</label>
                     <select name="tipovehiculo" class="form-control">
                         @foreach ($categorias as $cat)
                          <option value="{{$cat->id}}">{{$cat->nombre}}</option>
                         @endforeach
                    </select>
                </div>
            </div>   
        
    </div>

    <div class="row">
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                <div class="form-group">
                    <label>Encargado</label>
                     <select name="encargado" class="form-control">
                         @foreach ($encargados as $enc)
                          <option value="{{$enc->id}}">{{$enc->Nombres}}&nbsp;{{$enc->Apellidos}}</option>
                         @endforeach
                    </select>
                </div>
        </div>

        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                <div class="form-group">
                    <label>Tipo Combustible</label>
                     <select name="combustible" class="form-control">
                          <option value="1">Bencina</option>
                          <option value="2">Petroleo</option>
                    </select>  
                </div>
        </div>

    </div>


   <!-- Aqui se definen cada cuanto seran las inspecciones y mantenciones--> 
     <div class="panel panel-primary">
         <div class="panel-heading">
            Definición de mantenimiento
        </div>
        <div class="panel-body">
             <div class="col-lg-4 col-sm-4 col-md-4 col-xs-4">
                <div class="form-group">
                    <label for="kilometros">Inspecciones</label>
                    <input type="number" name="inspeccion" required value="{{old('inspeccion')}}" class="form-control" placeholder="Definición traje de inspección...">
                </div>      
            </div>
            <div class="col-lg-4 col-sm-4 col-md-4 col-xs-4">
                <div class="form-group">
                    <label for="kilometros">Mantenciones</label>
                    <input type="number" name="mantencion" required value="{{old('mantencion')}}" class="form-control" placeholder="Definición traje del mantención...">
                </div>      
            </div>
        </div>
    </div>

  <!-- Fin de definicon inspecciones y mantenciones -->
  
    <!-- Aqui se suben las fotos maximo 10 unidades-->
   
    <div class="panel panel-primary">
         <div class="panel-heading">
            Fotos
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
                   <div class="form-group">
                        <label for="foto1">Foto N° 1</label>
                        <input type="file" name="foto1"   class="form-control">
                    </div>
                </div>
                <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
                   <div class="form-group">
                        <label for="foto2">Foto N° 2</label>
                        <input type="file" name="foto2"   class="form-control">
                    </div>
                </div>
                <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
                   <div class="form-group">
                        <label for="foto3">Foto N° 3</label>
                        <input type="file" name="foto3"   class="form-control">
                    </div>
                </div>
            </div>
            <div class="row">
               <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
               <div class="form-group">
                    <label for="foto4">Foto N° 4</label>
                    <input type="file" name="foto4"   class="form-control">
                </div>
            </div>
             <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
               <div class="form-group">
                    <label for="foto5">Foto N° 5</label>
                    <input type="file" name="foto5"   class="form-control">
                </div>
            </div>
             <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
               <div class="form-group">
                    <label for="foto6">Foto N° 6</label>
                    <input type="file" name="foto6"   class="form-control">
                </div>
            </div>
            </div>
             <div class="row">
               <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
               <div class="form-group">
                    <label for="foto7">Foto N° 7</label>
                    <input type="file" name="foto7"   class="form-control">
                </div>
            </div>
             <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
               <div class="form-group">
                    <label for="foto8">Foto N° 8</label>
                    <input type="file" name="foto8"   class="form-control">
                </div>
            </div>
             <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
               <div class="form-group">
                    <label for="foto9">Foto N° 9</label>
                    <input type="file" name="foto9"   class="form-control">
                </div>
            </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
               <div class="form-group">
                    <label for="foto10">Foto N° 10</label>
                    <input type="file" name="foto10"   class="form-control">
                </div>
            </div>
            </div>

        </div>
    </div>
  

    <div class="row">
            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            	<button class="btn btn-primary" type="submit" onclick="EventoAlert();">Guardar</button>
            	<button class="btn btn-danger" type="reset">Cancelar</button>
            </div>
     </div>

    

	{!!Form::close()!!}		

</div>
</div>

@endsection