@extends('layouts.app')

@section('htmlheader_title')
	Usuarios
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
			<h3>Nuevo Usuario</h3>
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
			{!!Form::open(array('url'=>'maestros/usuarios','method'=>'POST','autocomplete'=>'off','files'=>'true'))!!}
            {{Form::token()}}
    <div class="row">
    	<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
    		<div class="form-group">
            	<label for="name">Nombre</label>
            	<input type="text" id="name" name="name" required value="{{old('name')}}" class="form-control" placeholder="Nombre...">
            </div>
    	</div>
        
        <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
            <div class="form-group">
                <label for="correo">Correo</label>
                <input type="text" name="email" required value="{{old('email')}}" class="form-control" placeholder="Correo...">
            </div>      
        </div>

    </div>
    
    <div class="row">
        <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
            <div class="form-group">
                <label for="password">Password</label>
                <input type="text" name="password" required value="{{old('password')}}" class="form-control" placeholder="Password...">
            </div>      
        </div>
        <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
            <div class="form-group">
                <label for="codigoSap">Codigo Sap</label>
                <input type="text" name="codigoSap" required value="{{old('codigoSap')}}" class="form-control" placeholder="Codigo Sap...">
            </div>      
        </div>
    </div>
   
    <div class="row">
        <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
            <div class="form-group">
                <label for="fechav">monto Màximo</label>
                <input type="number" name="montoMaximo" required value="{{old('montoMaximo')}}" class="form-control" placeholder="Monto Autorizado...">
            </div>      
        </div>
        <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
            <div class="form-group">
                <label>Jefe Directo</label>
                <select name="idJefe" class="form-control">
                    @foreach ($jefes as $jef)
                        <option value="{{$jef->id}}">{{$jef->nombreJefe}}</option>
                    @endforeach
                </select>
            </div>
        </div> 
    </div>

    <div class="row">        
        <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
            <div class="form-group">
                <label>Rol Usuario</label>
                <select name="idrol" class="form-control">
                    @foreach ($roles as $rol)
                        <option value="{{$rol->id}}">{{$rol->rol}}</option>
                    @endforeach
                </select>
            </div>                        
        </div> 
        @if ($rol->id == 5) {{-- Trabajador --}}
             <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
                <div class="form-group">
                    <label>Coordinador a cargo (solo para Rol usuario Trabajador)</label>
                     <select name="idcoo" class="form-control">
                         @foreach ($coordinadores as $coo)
                            <option value="{{$coo->id}}">{{$coo->name}}</option>
                        @endforeach
                     </select>   
                </div>
            </div>
        @endif
    </div>

    <div class="row">
         <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">         
             <div class="form-group">
                    <label>Bloqueo/Desbloqueo</label>
                     <select name="bloqueo" class="form-control">
                          <option value="0">Desbloqueado</option>
                          <option value="1">Bloqueado</option>                          
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