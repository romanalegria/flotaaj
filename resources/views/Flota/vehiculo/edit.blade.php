@extends('layouts.app')

@section('htmlheader_title')
  Vehículos
@endsection

<script>
 
</script>

@section('main-content')
<div class="panel panel-primary">
    <div class="panel-heading">
        Editar Vehículo
    </div>
    <hr style="color: #0056b2;" />
    <div class="panel-heading">
         Vehículo Asignado A:
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
 {!!Form::model($vehiculo,['method'=>'PUT','route'=>['vehiculo.update',$vehiculo->id,$vehiculo->encargado,$vehiculo->tipovehiculo,$vehiculo->estadovehiculo,$vehiculo->areanegocio],'files'=>'true'])!!}
       {{Form::token()}}
        <div class="row">
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text"  name="nombre" required value="{{$vehiculo->nombre}}" class="form-control">
            </div>
        </div>
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="marca">Marca</label>
                <input type="text"  name="marca" required value="{{$vehiculo->marca}}" class="form-control">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-4 col-sm-4 col-md-4 col-xs-4">
            <div class="form-group">
                <label for="modelo">Modelo</label>
                <input type="text"  name="modelo" required value="{{$vehiculo->modelo}}" class="form-control">
            </div>
        </div>
        <div class="col-lg-4 col-sm-4 col-md-4 col-xs-4">
            <div class="form-group">
                <label for="numserie">N° Motor</label>
                <input type="text"  name="numserie" required value="{{$vehiculo->numserie}}" class="form-control">
            </div>
        </div>
        <div class="col-lg-4 col-sm-4 col-md-4 col-xs-4">
            <div class="form-group">
                <label for="axo">Año</label>
                <input type="number"  name="axo" required value="{{$vehiculo->axo}}" class="form-control">
            </div>
        </div>
    </div>

    <div class="row">
     <div class="col-lg-4 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
                <label>Tipo Flota</label>
                <select name="empresa" class="form-control">
                    @foreach ($tipos as $tip)
                        @if ($tip->id == $vehiculo->empresa)
                            <option value="{{$tip->id}}" selected>{{$tip->nombre}}</option>
                        @else
                            <option value="{{$tip->id}}">{{$tip->nombre}}</option>
                        @endif
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-lg-4 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
                <label>Estado Vehículo</label>
                <select name="estadovehiculo" class="form-control">
                    @foreach ($estados as $est)
                        @if ($est->id == $vehiculo->estadovehiculo)
                            <option value="{{$est->id}}" selected>{{$est->nombre}}</option>
                        @else
                            <option value="{{$est->id}}">{{$est->nombre}}</option>
                        @endif
                    @endforeach
                </select>
            </div>
        </div>
         <div class="col-lg-4 col-sm-4 col-md-4 col-xs-4">
            <div class="form-group">
                <label for="kilometros">Kilometraje inicial</label>
                <input type="number" name="kilometraje" required value="{{$vehiculo->kilometraje}}" class="form-control" placeholder="Kilometraje del Vehiculo...">
            </div>      
        </div>

    </div>

   <div class="row">
        <div class="col-lg-4 col-sm-4 col-md-4 col-xs-4">
            <div class="form-group">
                <label for="patente">Patente</label>
                <input type="text"  name="patente" required value="{{$vehiculo->patente}}" class="form-control">
            </div>
        </div>
         <div class="col-lg-4 col-sm-4 col-md-4 col-xs-4">
            <div class="form-group">
                <label for="color">Color</label>
                <input type="text"  name="color" required value="{{$vehiculo->color}}" class="form-control">
            </div>
        </div>
          <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
        <div class="form-group">
                <label>Aréa Negocio</label>
                <select name="areanegocio" class="form-control">
                    @foreach ($areas as $are)
                        @if ($are->id == $vehiculo->areanegocio)
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
                <label>Tipo Vehículo</label>
                <select name="tipovehiculo" class="form-control">
                    @foreach ($categorias as $cat)
                        @if ($cat->id == $vehiculo->tipovehiculo)
                            <option value="{{$cat->id}}" selected>{{$cat->nombre}}</option>
                        @else
                            <option value="{{$cat->id}}">{{$cat->nombre}}</option>
                        @endif
                    @endforeach
                </select>
            </div>
        </div>
         <div class="col-lg-4 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
                <label>Encargado</label>
                <select name="encargado" class="form-control">
                    @foreach ($encargados as $enc)
                        @if ($enc->id == $vehiculo->encargado)
                            <option value="{{$enc->id}}" selected>{{$enc->Nombres}}&nbsp;{{$enc->Apellidos}}</option>
                        @else
                            <option value="{{$enc->id}}">{{$enc->Nombres}}</option>
                        @endif
                    @endforeach
                </select>
            </div>
        </div>
         <div class="col-lg-4 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
                <label>Tipo Combustible</label>
                <select name="tipovehiculo" class="form-control">
                       @if ($vehiculo->tipovehiculo == 1)
                            <option value="1" selected>Bencinero</option>
                        @else
                            <option value="2">Petrolero</option>
                        @endif
                   
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
                    <label for="inspeccion">Inspecciones</label>
                    <input type="number" name="inspeccion" required value="{{$vehiculo->inspeccion}}" class="form-control" placeholder="Definición traje de inspección...">
                </div>      
            </div>
            <div class="col-lg-4 col-sm-4 col-md-4 col-xs-4">
                <div class="form-group">
                    <label for="kilometros">Mantenciones</label>
                    <input type="number" name="mantencion" required value="{{$vehiculo->mantencion}}" class="form-control" placeholder="Definición traje del mantención...">
                </div>      
            </div>
        </div>
    </div>

  <!-- Fin de definicon inspecciones y mantenciones -->
    <div class="panel panel-primary">
         <div class="panel-heading">
            Fotos
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
                   <div class="form-group">
                        <label for="foto1">Foto N°1</label>
                        <input type="file" name="foto1" class="form-control">
                        @if ($vehiculo->foto1!= "")
                          <img src="{{asset('imagenes/vehiculos/'.$vehiculo->foto1)}}"  height="100px" width="100px">
                        @endif                        
                    </div>
                </div>
                <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
                   <div class="form-group">
                        <label for="foto2">Foto N°2</label>
                        <input type="file" name="foto2"   class="form-control">
                        @if ($vehiculo->foto2!= "")
                            <img src="{{asset('imagenes/vehiculos/'.$vehiculo->foto2)}}" height="100px" width="100px">
                        @endif
                    </div>
                </div>
                <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
                   <div class="form-group">
                        <label for="foto3">Foto N°3</label>
                        <input type="file" name="foto3"   class="form-control">
                        @if ($vehiculo->foto3!= "")
                            <img src="{{asset('imagenes/vehiculos/'.$vehiculo->foto3)}}" height="100px" width="100px">
                        @endif
                    </div>
                </div>
            </div>
            <div class="row">
                 <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
                   <div class="form-group">
                        <label for="foto4">Foto N°4</label>
                        <input type="file" name="foto4"   class="form-control">
                        @if ($vehiculo->foto4!= "")
                            <img src="{{asset('imagenes/vehiculos/'.$vehiculo->foto4)}}" height="100px" width="100px">
                        @endif
                    </div>
                </div>
                <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
                   <div class="form-group">
                        <label for="foto5">Foto N°5</label>
                        <input type="file" name="foto5"   class="form-control">
                        @if ($vehiculo->foto5!= "")
                            <img src="{{asset('imagenes/vehiculos/'.$vehiculo->foto5)}}" height="100px" width="100px">
                        @endif
                    </div>
                </div>
                <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
                   <div class="form-group">
                        <label for="foto6">Foto N°6</label>
                        <input type="file" name="foto6"   class="form-control">
                        @if ($vehiculo->foto6!= "")
                            <img src="{{asset('imagenes/vehiculos/'.$vehiculo->foto6)}}" height="100px" width="100px">
                        @endif
                    </div>
                </div>
            </div>
             <div class="row">
                 <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
                   <div class="form-group">
                        <label for="foto7">Foto N°7</label>
                        <input type="file" name="foto7"   class="form-control">
                        @if ($vehiculo->foto7!= "")
                            <img src="{{asset('imagenes/vehiculos/'.$vehiculo->foto7)}}" height="100px" width="100px">
                        @endif
                    </div>
                </div>
                <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
                   <div class="form-group">
                        <label for="foto8">Foto N°8</label>
                        <input type="file" name="foto8"   class="form-control">
                        @if ($vehiculo->foto8!= "")
                            <img src="{{asset('imagenes/vehiculos/'.$vehiculo->foto8)}}" height="100px" width="100px">
                        @endif
                    </div>
                </div>
                <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
                   <div class="form-group">
                        <label for="foto9">Foto N°9</label>
                        <input type="file" name="foto9"   class="form-control">
                        @if ($vehiculo->foto9!= "")
                            <img src="{{asset('imagenes/vehiculos/'.$vehiculo->foto9)}}" height="100px" width="100px">
                        @endif
                    </div>
                </div>
            </div>
            <div class="row">
                 <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
                   <div class="form-group">
                        <label for="foto10">Foto N°10</label>
                        <input type="file" name="foto10"   class="form-control">
                        @if ($vehiculo->foto10!= "")
                            <img src="{{asset('imagenes/vehiculos/'.$vehiculo->foto10)}}" height="100px" width="100px">
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>    
   
    <div class="row">
            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                <button class="btn btn-primary" type="submit">Guardar</button>
                <button class="btn btn-danger" type="reset">Cancelar</button>
            </div>            
     </div>   
    {!!Form::close()!!}     
</div>
</div>            
    
@endsection