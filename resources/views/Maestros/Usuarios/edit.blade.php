@extends('layouts.app')

@section('htmlheader_title')
    Usuarios
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
            <h3>Editar Usuario: {{ $usuario->name}}</h3>
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
 {!!Form::model($usuario,['method'=>'PUT','route'=>['usuarios.update',$usuario->id,$usuario->idrol,$usuario->idJefe],'files'=>'true'])!!}
   {{Form::token()}}
        <div class="row">
            <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
                <div class="form-group">
                    <label for="name">Nombre</label>
                    <input type="text"  name="name" required value="{{$usuario->name}}" class="form-control">
                </div>
            </div>

            <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
                <div class="form-group">
                    <label for="email">Correo</label>
                    <input type="text"  name="email" required value="{{$usuario->email}}" class="form-control">
                </div>      
            </div>
        </div>

    <div class="row">      
        <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
            <div class="form-group">
                <label for="password">Password</label>
                <input type="text" name="password"  class="form-control">
            </div>      
        </div>

        <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
            <div class="form-group">
                <label for="codigoSap">Codigo Sap</label>
                <input type="text" name="codigoSap" required value="{{$usuario->codigoSap}}" class="form-control">
            </div>      
        </div>
    </div>
 
    <div class="row">
        <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
            <div class="form-group">
                <label for="montoMaximo">Monto Màximo</label>
                <input type="text" name="montoMaximo" required value="{{$usuario->montoMaximo}}" class="form-control">
            </div>      
        </div>

        <div class="col-lg-4 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                    <label>Jefe Directo</label>
                    <select name="idJefe" class="form-control">
                        @foreach ($jefes as $jef)
                            @if ($jef->id == $usuario->idJefe)
                                <option value="{{$jef->id}}" selected>{{$jef->nombreJefe}}</option>
                            @else
                                <option value="{{$jef->id}}">{{$jef->nombreJefe}}</option>
                            @endif
                        @endforeach
                    </select>
            </div>
      </div>
    </div>        

   <div class="row">    
      <div class="col-lg-4 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
                <label>Rol Usuario</label>
                <select name="idrol" class="form-control">
                    @foreach ($roles as $rol)
                        @if ($rol->id == $usuario->idrol)
                            <option value="{{$rol->id}}" selected>{{$rol->rol}}</option>
                        @else
                            <option value="{{$rol->id}}">{{$rol->rol}}</option>
                        @endif
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
                       @if ($usuario->bloqueado == 0)
                            <option value="0" selected>Desbloqueado</option>
                            <option value="1">Bloqueado</option>
                       @else
                            <option value="0" >Desbloqueado</option>
                            <option value="1" selected>Bloqueado</option>
                        @endif
                   
                </select>
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
            
    
@endsection