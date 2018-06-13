@extends('layouts.app')

@section('htmlheader_title')
	Reportar Mantención Vehículo
@endsection



@section('main-content')

<script>

      $(document).ready(function() {
        $('#incidencias').DataTable();        
    } );
 
    function EventoAlert(d)
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
        Crear Incidencia
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
			{!!Form::open(array('url'=>'Tickets/vehiculo','method'=>'POST','autocomplete'=>'off','files'=>'true'))!!}
            {{Form::token()}}
   
    <div class="panel panel-primary">
         <div class="panel-heading">
            SISTEMA LUCES
        </div>
        <div class="panel-body">
        </div>
    </div>

  </div> 

      <div class="row">
        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-4">
               <label for="modelo">Descripción</label>
            <div class="form-group">             
                <textarea name="descripcion" cols="150"  rows="5" placeholder="Descripción..."></textarea>                
            </div>      
        </div>

    </div>     
        


  

    <div class="row">
            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            	<button class="btn btn-primary" type="button" onclick="EventoAlert();"">Crear Incidencia</button>               
            	<button class="btn btn-danger" type="reset">Cancelar</button>
            </div>
     </div>

    

	{!!Form::close()!!}		

 </div>
</div>
@endsection