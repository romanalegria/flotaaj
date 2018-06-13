@extends('layouts.app')

@section('htmlheader_title')
  Incidencias
@endsection


@section('main-content')

<script>


     function GuardarAlert(d)
    {
        event.preventDefault();
        url = '';
        console.log(url);
        $.post(url,
        {
            _token: "{{ csrf_token() }}",
            sucursal: $("select[name='sucursal']")[0].value,
            severidad: $("select[name='severidad']")[0].value,
            asignado: $("select[name='asignado']")[0].value,
            resumen: $("textarea[name='resumen']")[0].value,
            descripcion: $("textarea[name='descripcion']")[0].value,
            fechac: $("input[name='fechac']")[0].value,
            observaciones: $("textarea[name='observaciones']")[0].value
        },function(data, status){
            swal(
                'Registro modificado con exito',
                'Presione el boton OK!',
                'success'
            ).then(function () {
              location.reload();
            })



        });
    }
    
</script>


<div class="panel panel-primary">
    <div class="panel-heading">
        Editar Incidencia : {{ $incidencia->id}} {{ $incidencia->resumen}}&nbsp;&nbsp; Solicitada por:&nbsp;&nbsp;{{ $usuario->name}}
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
 {!!Form::model($incidencia,['method'=>'PUT','route'=>['ssgg.update',$incidencia->id],'files'=>'true'])!!}
       {{Form::token()}}
   
   <div class="row">
      <div class="col-lg-4 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
                <label>Sucursal</label>
                <select name="sucursal" class="form-control">
                       @if ($incidencia->sucursal == 1)
                            <option value="1" selected>La Divisa 0340</option>
                            <option value="2">Holanda 100</option>
                       @else
                            <option value="1" >La Divisa 0340</option>
                            <option value="2" selected>Holanda 100</option>
                        @endif
                   
                </select>
            </div>
        </div> 
   </div>    
 
   <div class="row">
      <div class="col-lg-4 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
                <label>Severidad</label>
                <select name="severidad" class="form-control">
                       @if ($incidencia->severidad == 1)
                            <option value="1" selected>Alta</option>
                            <option value="2">Media</option>
                            <option value="3">Baja</option>
                       @elseif ($incidencia->severidad == 2)
                            <option value="1" Alta</option>
                            <option value="2" selected>Media</option>
                            <option value="3">Baja</option>
                        @else
                            <option value="1">Alta</option>
                            <option value="2">Media</option>
                            <option value="3" selected>Baja</option>
                        @endif
                   
                </select>
            </div>
        </div> 
   </div>  


<div class="row">
      <div class="col-lg-4 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
                <label>Asignado A:</label>
                <select name="asignado" class="form-control">
                       @if ($incidencia->asignado == 1)
                            <option value="1" selected>Mantencion Interna</option>
                            <option value="2">Mantencion Externa</option>                            
                       @elseif ($incidencia->asignado == 2)
                           <option value="1">Mantencion Interna</option>
                            <option value="2" selected>Mantencion Externa</option>                         
                       
                        @endif
                   
                </select>
            </div>
        </div> 
 </div>

  <div class="row">
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="resumen">Resumen</label>
                <textarea  cols="150" rows="3"   name="resumen" required  class="form-control">{{$incidencia->resumen}}</textarea>  
            </div>
        </div>
     
    </div>

 <div class="row">
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="descripcion">Descripción</label>
                <textarea  cols="150" rows="3"   name="descripcion" required  class="form-control">{{$incidencia->descripcion}}</textarea>  
            </div>
        </div>
     
  </div>
  <div class="row">
     <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
            <div class="form-group">
                <label for="fechac">Fecha Cierre</label>
                <input type="date" name="fechac" required value="{{$incidencia->fecha_cierre}}" class="form-control" placeholder="Fecha Cierre...">
            </div>      
        </div>
         <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="observaciones">Observaciones de Cierre</label>
                <textarea  cols="150" rows="3"   name="observaciones" required  class="form-control">{{$incidencia->observaciones}}</textarea>  
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
            
</div>
</div>
@endsection