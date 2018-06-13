@extends('layouts.app')

@section('htmlheader_title')
    Encargados
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
            <h3>Editar Encargado: {{ $encargado->nombres}}</h3>
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
 {!!Form::model($encargado,['method'=>'PUT','route'=>['encargados.update',$encargado->id,$encargado->codcargo,$encargado->codarea],'files'=>'true'])!!}
            {{Form::token()}}
        <div class="row">
        <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
            <div class="form-group">
                <label for="rut">Rut</label>
                <input type="text"  name="rut" required value="{{$encargado->rut}}" class="form-control">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
            <div class="form-group">
                <label for="nombres">Nombres</label>
                <input type="text"  name="nombres" required value="{{$encargado->Nombres}}" class="form-control">
            </div>      
        </div>
        
         <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
            <div class="form-group">
                <label for="apellidos">Apellidos</label>
                <input type="text" name="apellidos" required value="{{$encargado->Apellidos}}" class="form-control">
            </div>      
        </div>
        
    </div>
 
    <div class="row">
        <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
            <div class="form-group">
                <label for="telefono">Télefono Contacto</label>
                <input type="text" name="telefono" required value="{{$encargado->Telefono}}" class="form-control">
            </div>      
        </div>
         <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
            <div class="form-group">
                <label for="fechav">Vencimiento Licencia</label>
                <input type="date" name="fechav" required value="{{$encargado->Fecha_Vencimiento}}" class="form-control">
            </div>      
        </div>
    </div>

   <div class="row">
     <div class="col-lg-4 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
                <label>Cargo</label>
                <select name="cargo" class="form-control">
                    @foreach ($cargos as $car)
                        @if ($car->id == $encargado->codcargo)
                            <option value="{{$car->id}}" selected>{{$car->nombre}}</option>
                        @else
                            <option value="{{$car->id}}">{{$car->nombre}}</option>
                        @endif
                    @endforeach
                </select>
            </div>
      </div>

        <div class="col-lg-4 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
                <label>Aréa Negocio</label>
                <select name="area" class="form-control">
                    @foreach ($areas as $are)
                        @if ($are->id == $encargado->codarea)
                            <option value="{{$are->id}}" selected>{{$are->nombre}}</option>
                        @else
                            <option value="{{$are->id}}">{{$are->nombre}}</option>
                        @endif
                    @endforeach
                </select>
            </div>
        </div>

    </div>

    <div class="row">
          <div class="col-lg-4 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
                <label>Asignar Usuario</label>
                <select name="usuario" class="form-control">
                    @foreach ($usuarios as $use)
                        @if ($use->id == $encargado->id_users)
                            <option value="{{$use->id}}" selected>{{$use->name}}&nbsp;{{$use->email}}</option>
                        @else
                            <option value="{{$use->id}}">{{$use->name}}&nbsp;{{$use->email}}</option>
                        @endif
                    @endforeach
                </select>
            </div>
      </div>
    </div>

   
    <div class="row">
        <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
           <div class="form-group">
                <label for="imagen">Licencia</label>
                <input type="file" name="licencia"  class="form-control">
                @if (($encargado->licencia)!= "")
                    <img src="{{asset('imagenes/licencias/'.$encargado->licencia)}}" height="200px" width="200px">
                @endif
            </div>
        </div>
    </div>
    <div class="row">
            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                <button class="btn btn-primary" type="submit" onclick="EventoAlert();"">Guardar</button>
                <button class="btn btn-danger" type="reset">Cancelar</button>
            </div>
     </div>   
    {!!Form::close()!!}     
            
    
@endsection