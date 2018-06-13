@extends('layouts.app')

@section('htmlheader_title')
	Reportar Mantención Vehículo
@endsection



@section('main-content')

<script>

      $(document).ready(function() {
        $('#incidencias').DataTable();
        $("[name='my-checkbox']").bootstrapSwitch();   
    } );   
    
    // function EventoAlert()
    // {
    //     swal(
    //         'Registro creado con exito',
    //         'Presione el boton OK!',
    //         'success'
    //      )
    // }
</script>


<h1>SOLICITUD DE MANTENCION A VEHICULO CON CARGO</h1>
<div class="panel panel-primary">
    <div class="panel-heading">
        Crear Mantención &nbsp;Usuario :&nbsp;{{$id}}&nbsp; Nombre:&nbsp;{{$nombre}} &nbsp; Vehículo:&nbsp;{{$vehiculo->nombre}}&nbsp;{{$vehiculo->modelo}}&nbsp;{{$vehiculo->marca}}            
                    

            &nbsp;&nbsp;<a href="{{url('mismantenciones', ['idusuario' => $id,'nombreuser' => $nombre, 'idvehiculo' => $vehiculo->id, 'vehiculonombre' => $vehiculo->nombre])}}"><button type="button" class="btn btn-success fa fa-search">&nbsp;Mis Solicitudes</button></a>

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
			{!!Form::open(array('url'=>'flota/vehiculo/'.$vehiculo->id.'/mantencion','method'=>'POST','autocomplete'=>'off','files'=>'true'))!!}
            {{Form::token()}}
            <input type="hidden" name="usuario" value={{$id}}>

    
            
    <div class="panel panel-primary">
         <div class="panel-heading">
          KILOMETRAJE
        </div>
        <div class="panel-body">    
            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="kilometraje">Kilometraje a declarar *</label>
                <input type="number" id="kilometraje" name="kilometraje" required value="{{old('kilometraje')}}" class="form-control" placeholder="Kilometraje del Vehìculo...">
            </div>
        </div>       
        </div>
    </div>    


    <div class="panel panel-primary">
         <div class="panel-heading">
          SISTEMA LUCES
        </div>
        <div class="panel-body">           
            <input name="slu_estacionamiento" type="checkbox" value="1">Estacionamiento&nbsp;           
            <input name="slu_bajas" type="checkbox" value="2">Bajas&nbsp;
            <input name="slu_altas" type="checkbox" value="3">Altas&nbsp;
            <input name="slu_freno" type="checkbox" value="4">Freno&nbsp;
            <input name="slu_matras" type="checkbox" value="5">Marcha Atrás&nbsp;
            <input name="slu_vderecha" type="checkbox" value="6">Viraje Derecha&nbsp;
            <input name="slu_vizquierda" type="checkbox" value="7">Viraje Izquierda&nbsp;
            <input name="slu_patente" type="checkbox" value="8">Patente&nbsp;
            <input name="slu_tluz" type="checkbox" value="9">Tercera Luz&nbsp;
        </div>
    </div>

    <div class="panel panel-primary">
         <div class="panel-heading">
            NEUMÁTICOS
        </div>
        <div class="panel-body">
            <input name="dderecho" type="checkbox" value="10">Delantero Der.&nbsp;
            <input name="dizquierdo" type="checkbox" value="11">Delantero Izq.&nbsp;
            <input name="tderecho" type="checkbox" value="12">Trasero Der.&nbsp;
            <input name="tizquierdo" type="checkbox" value="13">Trasero Izq.&nbsp;
            <input name="repuesto" type="checkbox" value="14">Repuesto&nbsp;
        </div>
    </div>


     <div class="panel panel-primary">
         <div class="panel-heading">
            NIVELES / MOTOR
        </div>
        <div class="panel-body">
            <input name="amotor" type="checkbox" value="15">Aceite Motor&nbsp;
            <input name="aradiador" type="checkbox" value="16">Agua Radiador&nbsp;
            <input name="lfrenos" type="checkbox" value="17">Liquído Frenos&nbsp;
            <input name="lhidraulico" type="checkbox" value="18">Liquído Hidraulico&nbsp;
            <input name="ebateria" type="checkbox" value="19">Estado Batería&nbsp;
        </div>
    </div>

     <div class="panel panel-primary">
         <div class="panel-heading">
            ACCESORIOS
        </div>
        <div class="panel-body">
            <input name="extintor" type="checkbox" value="20">Extintor&nbsp;
            <input name="chaleco" type="checkbox" value="21">Chaleco Reflectante&nbsp;
            <input name="botiquin" type="checkbox" value="22">Botiquín&nbsp;
            <input name="gata" type="checkbox" value="23">Gata&nbsp;
            <input name="lruedas" type="checkbox" value="24">LLave Ruedas&nbsp;
            <input name="triangulo" type="checkbox" value="25">Triángulos&nbsp;
            <input name="lparabrisa" type="checkbox" value="26">Limpia Parabrisa&nbsp;
            <input name="cseguridad" type="checkbox" value="27">Cinturón de Seguridad&nbsp;
            <div>
                <input name="elaterales" type="checkbox" value="28">Espejos Laterales&nbsp;
                <input name="einterior" type="checkbox" value="29">Espejo Interior&nbsp;
                <input name="bretroceso" type="checkbox" value="30">Bencina Tresoceso&nbsp;
                <input name="antena" type="checkbox" value="31">Antena&nbsp;           
            </div>

        </div>
    </div>

     <div class="panel panel-primary">
         <div class="panel-heading">
            DOCUMENTOS
        </div>
        <div class="panel-body">
            <input name="pcirculacion" type="checkbox" value="32">Permiso Circulación&nbsp;            
            <input name="rtecnica" type="checkbox" value="33">Revisión Técnica&nbsp;            
            <input name="sobligatorio" type="checkbox" value="34">Seguro Obligatorio&nbsp;            
        </div>
    </div>
        
      <div class="panel panel-primary">
         <div class="panel-heading">
            ESTADO GENERAL
        </div>
        <div class="panel-body">
            <input name="techo" type="checkbox" value="35">Techo&nbsp;
            <input name="capot" type="checkbox" value="36">Capot&nbsp;
            <input name="puertas" type="checkbox" value="37">Puertas&nbsp;
            <input name="vidrios" type="checkbox" value="38">vidrios&nbsp;
            <input name="tapabarros" type="checkbox" value="39">Tapabarros&nbsp;
            <input name="parachoques" type="checkbox" value="40">Parachoques&nbsp;
            <input name="tescape" type="checkbox" value="41">Tubo Escape&nbsp;
            <input name="limpieza" type="checkbox" value="42">Limpieza&nbsp;
        </div>
    </div>


    <div class="panel panel-primary">
         <div class="panel-heading">
            OBSERVACIONES
        </div>
        <div class="panel-body">
             <label for="resumen">Observaciones</label>
            <div class="form-group">                        
                <textarea name="observaciones" cols="100" rows="3" placeholder="Otras Observaciones..."></textarea>                
            </div>      
        </div>
    </div>     




           <div class="row">
            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12s">
                <button class="btn btn-primary" type="submit">Solicitar Mantención</button>               
                <button class="btn btn-danger" type="reset">Cancelar</button>
            </div>
     </div>

  </div> 

     
        


  

 

    

	{!!Form::close()!!}		

 </div>
</div>
@endsection