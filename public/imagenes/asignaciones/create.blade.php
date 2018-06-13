@extends('layouts.app')

@section('htmlheader_title')
	Asignar Vehículo
@endsection



@section('main-content')

<script>

      $(document).ready(function() {
        $('#asignaciones').DataTable();        
    } );
 
    function EventoAlert(d)
    {
        event.preventDefault();
        url = '';
        console.log(url);
        $.post(url,
        {
            _token: "{{ csrf_token() }}",
            encargado: $("select[name='encargado']")[0].value,
            vehiculo: $("select[name='vehiculo']")[0].value,
            fecha_asignacion: $("input[name='fecha_asignacion']")[0].value,
            descripcion: $("textarea[name='descripcion']")[0].value           
        },function(data, status){
            swal(
                'Registro ingresado con exito',
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
        Crear Asignación de Vehículo
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

	{!!Form::open(array('url'=>'asignaciones','method'=>'POST','autocomplete'=>'off','files'=>'true'))!!}
    {{Form::token()}}
    
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
    </div>
    <div class="row">
         <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                <div class="form-group">
                    <label>Vehículo</label>
                     <select name="vehiculo" class="form-control">
                         @foreach ($vehiculos as $veh)
                          <option value="{{$veh->id}}">{{$veh->nombre}}&nbsp;{{$veh->modelo}}</option>
                         @endforeach
                    </select>
                </div>
        </div>
    </div>
    

      <div class="row">
        <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
          <div class="form-group">
                <label for="fecha_asignacion">Fecha Asignación</label>
                <input type="date" name="fecha_asignacion" required value="{{old('fecha_asignacion')}}" class="form-control" placeholder="Fecha Asignación...">                
            </div>      
        </div>
         
  </div>


      <div class="row">
        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-4">
               <label for="modelo">Descripción</label>
            <div class="form-group">             
                <textarea name="descripcion" cols="150"  rows="5" value="{{old('descripcion')}}" placeholder="Descripción..."></textarea>                
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
                        <label for="acta_entrega">Acta de entrega</label>
                        <input type="file" name="acta_entrega"   class="form-control">
                    </div>
                </div>
            </div>
        </div>

    </div>
  

    <div class="row">
            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            	<button class="btn btn-primary" type="submit">Crear Asignación</button>         
                <button class="btn btn-danger" type="reset">Cancelar</button>
            </div>
     </div>

    

	{!!Form::close()!!}		

 </div>
</div>

@endsection