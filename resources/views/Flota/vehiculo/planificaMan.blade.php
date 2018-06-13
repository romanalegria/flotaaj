@extends('layouts.app')

@section('htmlheader_title')
	Reportar Mantención Vehículo
@endsection



@section('main-content')




<h3>DETALLE DE MANTENCION A VEHICULO </h3>
<div class="panel panel-primary">
    <div class="panel-heading">
        Crear Mantención: &nbsp; &nbsp; Vehículo:&nbsp;{{$vehiculo->nombre}}&nbsp;{{$vehiculo->modelo}}&nbsp;{{$vehiculo->marca}}&nbsp; &nbsp;Patente: {{$vehiculo->patente}}
                    

         

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
			{!!Form::open(array('url'=>'flota/vehiculo/'.$vehiculo->id.'/planificaMan','method'=>'POST','autocomplete'=>'off','files'=>'true'))!!}
            {{Form::token()}}
         
      <input type="hidden" name="patente" value="{{$vehiculo->patente}}" id="proyecto"> 
            
    <div class="panel panel-primary">
         <div class="panel-heading">
          KILOMETRAJE - MANTENCION
        </div>
        <div class="panel-body">    
            <div class="row">
            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="kilometraje">Kilometraje a declarar *</label>
                <input type="number"  name="km_vehiculo"  required value="{{old('kilometraje')}}" class="form-control" placeholder="Kilometraje del Vehìculo...">
            </div>
            </div>      
            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="kilometraje">Mantención a Aplicar *</label>
                <select id="km_aplicar" name="km_aplicar" class="form-control kilometraje">
                    <option value="5000">Mantención 5000 Km</option>
                    <option value="10000">Mantención 10000 Km</option>
                    <option value="20000">Mantención 20000 Km</option>
                    <option value="30000">Mantención 30000 Km</option>
                    <option value="40000">Mantención 40000 Km</option>
                    <option value="50000">Mantención 50000 Km</option>
                    <option value="60000">Mantención 60000 Km</option>
                    <option value="70000">Mantención 70000 Km</option>
                    <option value="80000">Mantención 80000 Km</option>
                    <option value="90000">Mantención 90000 Km</option>
                    <option value="100000">Mantención 100000 Km</option>
                </select>
            </div>
            </div>
         
        </div>
       {{--  <DIV class="row">
                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                <button class="btn btn-primary" type="button" onclick="Calcular();">Calcular</button>               
              
            </div>      
        </DIV> --}}
    </div>    
  
   


    <div class="panel panel-primary">
         <div class="ver-planificacion">
              
         </div>
         <div class="panel-heading">
            ANOTACIONES DE LA MANTENCION
        </div>
        <div class="panel-body">
             <label for="resumen">Detalle del los trabajos</label>
            <div class="form-group">                        
                <textarea name="observaciones" cols="100" rows="3" placeholder="Detalles..."></textarea>                
            </div>   
              <div class="row">
            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                <button class="btn btn-primary" type="submit">Grabar</button>               
                <button class="btn btn-danger" type="reset">Cancelar</button>
                <a class="btn btn-success ver-mantenciones" data-target="#Mantenciones" data-toggle="modal" data-id="{{$vehiculo->patente}}" >Ver Mantenciones</a> 
            </div>

           

        </div>
    </div>
        
     </div>

  </div>    
          

	{!!Form::close()!!}		
<!-- Modal -->
<div class="modal fade" id='Mantenciones' tabindex='-1' role='dialog' aria-labellebdy='myModalLabel'
  aria-hidden='true'>
  
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
           <h2 class="text-center">Patente:{{$vehiculo->patente}} </h2>
        </div>
        <div class="modal-body modal-mantenciones">
         
        </div>
        <div class="modal-footer">
          <button class="btn btn-primary" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
      
    </div>
  </div>

   <!-- Fin Modal -->


 </div>
</div>


<script>
   
   $('.ver-mantenciones').click(function(event) {
            event.preventDefault();
            $('.modal-mantenciones').html('Cargando...');
            var loc = $(this).attr('href');
            var id= $(this).data('id');

            console.log(id);
            $.ajax({
                  url: '/flota/vehiculo/'+id+'/misMantenciones',
                  method: 'GET'
                }).done(function(view) {
                    $('.modal-mantenciones').html(view);
                    //console.log(data);
                  //$( this ).addClass( "done" );
            });

        });


    function Calcular()
    {
        var id=document.getElementById("kilometraje").value;        
       
            console.log(id);
            event.preventDefault();
             $('.ver-planificacion').html('Cargando...');
            $.ajax({
                  url: '/flota/vehiculo/'+id+'/Planificacion',
                  method: 'GET'
                }).done(function(view) {
                    $('.ver-planificacion').html(view);
                    //console.log(data);
                  //$( this ).addClass( "done" );
            });
        


    }

     @if(Session::has('message'))
        var type = "{{ Session::get('alert-type', 'info') }}";
        switch(type){
            case 'info':
                toastr.info("{{ Session::get('message') }}");
                break;
            
            case 'warning':
                toastr.warning("{{ Session::get('message') }}");
                break;
            case 'success':
                toastr.success("{{ Session::get('message') }}");
                break;
            case 'error':
                toastr.error("{{ Session::get('message') }}");
                break;
        }
     @endif
  
</script>


@endsection