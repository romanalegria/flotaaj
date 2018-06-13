@extends('layouts.app')

@section('htmlheader_title')
 Asignaciones
@endsection





@section('main-content')

<script>

function Guardar() {
    swal(
     'Registro modificado con exito',
    'Presione el boton OK!',
    'success'
    )
}
    
 //  function Guardar()
 // {
   
 //    $.ajax({
 //        url:'',
 //        method:'PUT',
 //        data: {
 //            encargado: $("select[name='encargado']")[0].value,
 //            vehiculo: $("select[name='vehiculo']")[0].value,
 //            fecha_asignacion: $("input[name='fecha_asignacion']")[0].value,
 //            descripcion: $("textarea[name='descripcion']")[0].value ,
 //            acta_entrega: $("input[name='acta_entrega']")[0].value
 //        },success: function(response)
 //        {
 //            alert('entre');
 //            swal(
 //                    'Registro modificado con exito',
 //                    'Presione el boton OK',
 //                    'success'
 //                ).then(function (){
 //                    location.reload();
 //                })
 //        }      
 //    });
 //  }  
    

</script>

<h1>ACTA DEVOLUCION DE VEHICULO</h1>
<div class="panel panel-primary">
    <div class="panel-heading">
        Vehiculo a Devolver : {{$asignacion->id}}&nbsp; Patente: {{$asignacion->patente}} &nbsp; Nombre: {{$asignacion->nombre}} &nbsp; Marca: {{$asignacion->marca}}&nbsp; Modelo: {{$asignacion->modelo}}  
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
 {!!Form::open(array('url'=>'devoluciones','method'=>'POST','autocomplete'=>'off','files'=>'true'))!!}
       {{Form::token()}}
  
  <input type="hidden" value="{{$asignacion->id}}" name="id_asignacion">
 <div class="row">
      <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
        <div class="form-group">
                <label>Encargado</label>
                {{$asignacion->encargado}}&nbsp;{{$asignacion->apellidos}}
            </div>
        </div>
 </div>
 

 <div class="row">
     <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
            <div class="form-group">
                <label for="fecha_devolucion">Fecha Devolución</label>
               <input type="date" name="fecha_devolucion" required value="{{old('fecha_devolucion')}}" class="form-control" placeholder="Fecha Devolución...">  
            </div>      
     </div>
     <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
            <div class="form-group">
                <label for="km_devolucion">Kilometraje devolución</label>
               <input type="number" name="km_devolucion" required value="{{old('km_devolucion')}}" class="form-control" placeholder="Kilometraje Devolución...">  
            </div>      
     </div>
 </div>      

 <div class="row">
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="descripcion">Observaciones de devolución</label>
                <textarea name="descripcion" cols="90"  rows="5" value="{{old('descripcion')}}" placeholder="Descripción..."></textarea>
            </div>
        </div>
     
  </div>

        <div class="panel panel-primary">
         <div class="panel-heading" style="text-align: center;">
            Documentos
        </div>
        <div class="panel-body">
            <div class="row">
                 <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
                   <div class="form-group">
                        <label for="acta_devolucion">Seleccionar Documento</label>
                        <input type="file" name="acta_entrega"   class="form-control">                       
                    </div>
                </div>
            </div>
        </div>

    </div>
 
 
    
     <div class="row">
            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                <button class="btn btn-primary" type="submit" onclick="EventoAlert();">Crear Devolución</button>         
                <button class="btn btn-danger" type="reset">Cancelar</button>
            </div>
     </div>

 
    {!!Form::close()!!}     
</div>
</div>

@endsection