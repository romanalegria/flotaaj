@extends('layouts.app')

@section('htmlheader_title')
	Asignar Vehículo
@endsection



@section('main-content')

<script>

  function EventoAlert() {
   swal(
     'Registro modificado con exito',
     'Presione el boton OK!',
     'success'
    )
}
    
  
</script>

<h1>ACTA ENTREGA DE VEHICULO</h1>
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
         <div class="col-lg-4 col-sm-4 col-md- col-xs-12">
                <div class="form-group">
                    <label>Encargado</label>
                     <select name="encargado" class="form-control">
                         @foreach ($encargados as $enc)
                          <option value="{{$enc->id}}">{{$enc->Nombres}}&nbsp;{{$enc->Apellidos}}</option>
                         @endforeach
                    </select>
                </div>
        </div>
        <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
                <div class="form-group">
                    <label>Vehículo</label>
                     <select name="vehiculo" class="form-control">
                         @foreach ($vehiculos as $veh)
                          <option value="{{$veh->id}}">&nbsp;{{$veh->patente}}&nbsp;{{$veh->nombre}}&nbsp;{{$veh->modelo}}</option>
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
		 <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
          <div class="form-group">
                <label for="km_entrega">Kilometraje de entrega</label>
                <input type="number" name="km_entrega" required value="{{old('km_entrega')}}" class="form-control" placeholder="Kilometraje entrega...">                
            </div>      
        </div>		
	</div>
	<div class="row">
	
         <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
               <label for="modelo">Descripción</label>
            <div class="form-group">             
                <textarea name="descripcion" cols="88"  rows="5" value="{{old('descripcion')}}" placeholder="Descripción..."></textarea>                
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
                        <label for="acta_entrega">Acta Entrega</label>
                        <input type="file" name="acta_entrega"   class="form-control">
                    </div>
                </div>
                 <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
                   <div class="form-group">
                        <label for="anexo_contrato">Anexo Contrato</label>
                        <input type="file" name="anexo_contrato"   class="form-control">
                    </div>
                </div>
                 <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
                   <div class="form-group">
                        <label for="foto1">Foto N° 1</label>
                        <input type="file" name="foto1"   class="form-control">
                    </div>
                </div>
               
            </div>
            <div class="row">
                 <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
                   <div class="form-group">
                        <label for="foto2">Foto N° 2</label>
                        <input type="file" name="foto2"   class="form-control">
                    </div>
                </div>
                 <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
                   <div class="form-group">
                        <label for="foto3">Foto N° 3</label>
                        <input type="file" name="foto1"   class="form-control">
                    </div>
                </div>
                <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
                   <div class="form-group">
                        <label for="foto4">Foto N° 4</label>
                        <input type="file" name="foto2"   class="form-control">
                    </div>
                </div>
            </div>
        </div>

    </div>
  
   <!--- <div class="panel panel-primary">
         <div class="panel-heading" style="text-align: center;">
            Check-List de entrega
        </div>
        <div class="panel-body">
            <div class="row">
                 <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12"> 
                    <div class="btn-group">
                       <table class="table table-bordered"" >
                         <tr>
                           <th colspan="5" style="text-align: center;"">SISTEMA LUCES</th>
                         </tr>
                         <tr>
                           <th>ITEM</th>
                           <th>BUENO</th>
                           <th>REGULAR</th>
                           <th>MALO</th>
                           <th>OBSERVACIONES</th>
                         </tr>
                         <tr>
                           <td>Estacionamiento</td>
                           <td><input type="radio" name="estacionamiento" value="bueno">Bueno</td>
                           <td><input type="radio" name="estacionamiento" value="regular">Regular</td>
                           <td><input type="radio" name="estacionamiento" value="malo">Malo</td> 
                           <td><input type="text" name="txt_estacionamiento" value="{{old('txt_estacionamiento')}}" class="form-control"></td>                          
                         </tr>
                         <tr>
                           <td>Bajas</td>
                           <td><input type="radio" name="bajas" value="bueno">Bueno</td>
                           <td><input type="radio" name="bajas" value="regular">Regular</td>
                           <td><input type="radio" name="bajas" value="malo">Malo</td>  
                           <td><input type="text" name="txt_bajas" value="{{old('txt_bajas')}}" class="form-control"></td>  
                         </tr>
                         <tr>
                           <td>Altas</td>
                           <td><input type="radio" name="altas" value="bueno">Bueno</td>
                           <td><input type="radio" name="altas" value="regular">Regular</td>
                           <td><input type="radio" name="altas" value="malo">Malo</td> 
                           <td><input type="text" name="txt_altas" value="{{old('txt_altas')}}" class="form-control"></td>  
                         </tr>
                         <tr>
                           <td>Freno</td>
                           <td><input type="radio" name="freno" value="bueno">Bueno</td>
                           <td><input type="radio" name="freno" value="regular">Regular</td>
                           <td><input type="radio" name="freno" value="malo">Malo</td> 
                           <td><input type="text" name="txt_frenos"  value="{{old('txt_frenos')}}" class="form-control"></td>  
                         </tr>
                         <tr>
                           <td>Marcha Atrás</td>
                           <td><input type="radio" name="matras" value="bueno">Bueno</td>
                           <td><input type="radio" name="matras" value="regular">Regular</td>
                           <td><input type="radio" name="matras" value="malo">Malo</td> 
                           <td><input type="text" name="txt_matras"  value="{{old('txt_matras')}}" class="form-control"></td>  
                         </tr>
                         <tr>
                           <td>Viraje Derecha</td>
                           <td><input type="radio" name="vderecha" value="bueno">Bueno</td>
                           <td><input type="radio" name="vderecha" value="regular">Regular</td>
                           <td><input type="radio" name="vderecha" value="malo">Malo</td> 
                           <td><input type="text" name="txt_vderecha"  value="{{old('txt_vderecha')}}" class="form-control"></td>  
                         </tr>
                         <tr>
                           <td>Viraje Izquierda</td>
                           <td><input type="radio" name="vizquierda" value="bueno">Bueno</td>
                           <td><input type="radio" name="vizquierda" value="regular">Regular</td>
                           <td><input type="radio" name="vizquierda" value="malo">Malo</td> 
                           <td><input type="text" name="txt_vizquierda"  value="{{old('txt_vizquierda')}}" class="form-control"></td>  
                         </tr>
                         <tr>
                           <td>Patente</td>
                           <td><input type="radio" name="patente" value="bueno">Bueno</td>
                           <td><input type="radio" name="patente" value="regular">Regular</td>
                           <td><input type="radio" name="patente" value="malo">Malo</td> 
                           <td><input type="text" name="txt_patente"  value="{{old('txt_patente')}}" class="form-control"></td>  
                         </tr>
                         <tr>
                           <td>Tercera Luz</td>
                           <td><input type="radio" name="tluz" value="bueno">Bueno</td>
                           <td><input type="radio" name="tluz" value="regular">Regular</td>
                           <td><input type="radio" name="tluz" value="malo">Malo</td> 
                           <td><input type="text" name="txt_tluz"  value="{{old('txt_t_luz')}}" class="form-control"></td>  
                         </tr>
                       </table>
                    </div>
                 
                </div>
                 <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12"> 
                    <div class="btn-group">
                       <table class="table table-bordered"" >
                         <tr>
                           <th colspan="5" style="text-align: center;"">NEUMÁTICOS</th>
                         </tr>
                         <tr>
                           <th>ITEM</th>
                           <th>BUENO</th>
                           <th>REGULAR</th>
                           <th>MALO</th>
                           <th>OBSERVACIONES</th>
                         </tr>
                         <tr>
                           <td>Delantero Der.</td>
                           <td><input type="radio" name="dder" value="bueno">Bueno</td>
                           <td><input type="radio" name="dder" value="regular">Regular</td>
                           <td><input type="radio" name="dder" value="malo">Malo</td>  
                           <td><input type="text" name="txt_dder"  value="{{old('txt_dder')}}" class="form-control"></td>                           
                         </tr>
                         <tr>
                           <td>Delantero Izq.</td>
                           <td><input type="radio" name="dizq" value="bueno">Bueno</td>
                           <td><input type="radio" name="dizq" value="regular">Regular</td>
                           <td><input type="radio" name="dizq" value="malo">Malo</td>
                           <td><input type="text" name="txt_dizq"  value="{{old('txt_dizq')}}" class="form-control"></td>    
                         </tr>
                         <tr>
                           <td>Trasero Der.</td>
                           <td><input type="radio" name="tder" value="bueno">Bueno</td>
                           <td><input type="radio" name="tder" value="regular">Regular</td>
                           <td><input type="radio" name="tder" value="malo">Malo</td> 
                           <td><input type="text" name="txt_tder"  value="{{old('txt_tder')}}" class="form-control"></td>  
                         </tr>
                         <tr>
                           <td>Trasero Izq.</td>
                           <td><input type="radio" name="tizq" value="bueno">Bueno</td>
                           <td><input type="radio" name="tizq" value="regular">Regular</td>
                           <td><input type="radio" name="tizq" value="malo">Malo</td> 
                           <td><input type="text" name="txt_tizq"  value="{{old('txt_tizq')}}" class="form-control"></td>  
                         </tr>
                         <tr>
                           <td>Repuesto</td>
                           <td><input type="radio" name="repuesto" value="bueno">Bueno</td>
                           <td><input type="radio" name="repuesto" value="regular">Regular</td>
                           <td><input type="radio" name="repuesto" value="malo">Malo</td>
                           <td><input type="text" name="txt_repuesto"  value="{{old('txt_repuesto')}}" class="form-control"></td>   
                         </tr>
                        
                       </table>
                    </div>
                 
                </div>
            </div>

            {{-- Segunda Parte Check List --}}
              <div class="row">
                 <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12"> 
                    <div class="btn-group">
                       <table class="table table-bordered"" >
                         <tr>
                           <th colspan="5" style="text-align: center;"">NIVELES / MOTOR</th>
                         </tr>
                         <tr>
                           <th>ITEM</th>
                           <th>BUENO</th>
                           <th>REGULAR</th>
                           <th>MALO</th>
                           <th>OBSERVACIONES</th>
                         </tr>
                         <tr>
                           <td>Aceite Motor</td>
                           <td><input type="radio" name="amotor" value="bueno">Bueno</td>
                           <td><input type="radio" name="amotor" value="regular">Regular</td>
                           <td><input type="radio" name="amotor" value="malo">Malo</td> 
                           <td><input type="text" name="txt_amotor" value="{{old('txt_amotor')}}" class="form-control"></td>                          
                         </tr>
                         <tr>
                           <td>Agua Radiador</td>
                           <td><input type="radio" name="aradiador" value="bueno">Bueno</td>
                           <td><input type="radio" name="aradiador" value="regular">Regular</td>
                           <td><input type="radio" name="aradiador" value="malo">Malo</td>  
                           <td><input type="text" name="txt_aradiador" value="{{old('txt_aradiador')}}" class="form-control"></td>  
                         </tr>
                         <tr>
                           <td>Liquído Frenos </td>
                           <td><input type="radio" name="lfrenos" value="bueno">Bueno</td>
                           <td><input type="radio" name="lfrenos" value="regular">Regular</td>
                           <td><input type="radio" name="lfrenos" value="malo">Malo</td> 
                           <td><input type="text" name="txt_lfrenos" value="{{old('txt_lfrenos')}}" class="form-control"></td>  
                         </tr>
                         <tr>
                           <td>Liquído Hidraulico</td>
                           <td><input type="radio" name="lhidraulico" value="bueno">Bueno</td>
                           <td><input type="radio" name="lhidraulico" value="regular">Regular</td>
                           <td><input type="radio" name="lhidraulico" value="malo">Malo</td> 
                           <td><input type="text" name="txt_lhidraulico"  value="{{old('txt_lhidraulico')}}" class="form-control"></td>  
                         </tr>
                         <tr>
                           <td>Estado Bateria</td>
                           <td><input type="radio" name="ebateria" value="bueno">Bueno</td>
                           <td><input type="radio" name="ebateria" value="regular">Regular</td>
                           <td><input type="radio" name="ebateria" value="malo">Malo</td> 
                           <td><input type="text" name="txt_ebateria"  value="{{old('txt_ebateria')}}" class="form-control"></td>  
                         </tr>                                           
                       </table>
                    </div>
                 
                </div>
                 <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12"> 
                    <div class="btn-group">
                       <table class="table table-bordered"" >
                         <tr>
                           <th colspan="5" style="text-align: center;"">ACCESORIOS</th>
                         </tr>
                         <tr>
                           <th>ITEM</th>
                           <th>BUENO</th>
                           <th>REGULAR</th>
                           <th>MALO</th>
                           <th>OBSERVACIONES</th>
                         </tr>
                         <tr>
                           <td>Extintor</td>
                           <td><input type="radio" name="extintor" value="bueno">Bueno</td>
                           <td><input type="radio" name="extintor" value="regular">Regular</td>
                           <td><input type="radio" name="extintor" value="malo">Malo</td>  
                           <td><input type="text" name="txt_extintor"  value="{{old('txt_extintor')}}" class="form-control"></td>                           
                         </tr>
                         <tr>
                           <td>Chaleco Reflectante</td>
                           <td><input type="radio" name="creflectante" value="bueno">Bueno</td>
                           <td><input type="radio" name="creflectante" value="regular">Regular</td>
                           <td><input type="radio" name="creflectante" value="malo">Malo</td>
                           <td><input type="text" name="txt_creflectante"  value="{{old('txt_creflectante')}}" class="form-control"></td>    
                         </tr>
                         <tr>
                           <td>Botiquín</td>
                           <td><input type="radio" name="botiquin" value="bueno">Bueno</td>
                           <td><input type="radio" name="botiquin" value="regular">Regular</td>
                           <td><input type="radio" name="botiquin" value="malo">Malo</td> 
                           <td><input type="text" name="txt_botiquin"  value="{{old('txt_botiquin')}}" class="form-control"></td>  
                         </tr>
                         <tr>
                           <td>Gata</td>
                           <td><input type="radio" name="gata" value="bueno">Bueno</td>
                           <td><input type="radio" name="gata" value="regular">Regular</td>
                           <td><input type="radio" name="gata" value="malo">Malo</td> 
                           <td><input type="text" name="txt_gata"  value="{{old('txt_gata')}}" class="form-control"></td>  
                         </tr>
                         <tr>
                           <td>LLave de Ruedas</td>
                           <td><input type="radio" name="lruedas" value="bueno">Bueno</td>
                           <td><input type="radio" name="lruedas" value="regular">Regular</td>
                           <td><input type="radio" name="lruedas" value="malo">Malo</td>
                           <td><input type="text" name="txt_lruedas"  value="{{old('txt_lruedas')}}" class="form-control"></td>   
                         </tr>
                         <tr>
                           <td>Triángulos</td>
                           <td><input type="radio" name="triangulos" value="bueno">Bueno</td>
                           <td><input type="radio" name="triangulos" value="regular">Regular</td>
                           <td><input type="radio" name="triangulos" value="malo">Malo</td>
                           <td><input type="text" name="txt_triangulos"  value="{{old('txt_triangulos')}}" class="form-control"></td>   
                         </tr>
                          <tr>
                           <td>Limpia Parabrisas</td>
                           <td><input type="radio" name="lparabrisas" value="bueno">Bueno</td>
                           <td><input type="radio" name="lparabrisas" value="regular">Regular</td>
                           <td><input type="radio" name="lparabrisas" value="malo">Malo</td>
                           <td><input type="text" name="txt_lparabrisas"  value="{{old('txt_lparabrisas')}}" class="form-control"></td>   
                         </tr>
                         <tr>
                           <td>Cinturón de Seguridad</td>
                           <td><input type="radio" name="cseguridad" value="bueno">Bueno</td>
                           <td><input type="radio" name="cseguridad" value="regular">Regular</td>
                           <td><input type="radio" name="cseguridad" value="malo">Malo</td>
                           <td><input type="text" name="txt_cseguridad"  value="{{old('txt_cseguridad')}}" class="form-control"></td>   
                         </tr>
                          <tr>
                           <td>Espejos Laterales</td>
                           <td><input type="radio" name="elaterales" value="bueno">Bueno</td>
                           <td><input type="radio" name="elaterales" value="regular">Regular</td>
                           <td><input type="radio" name="elaterales" value="malo">Malo</td>
                           <td><input type="text" name="txt_elaterales"  value="{{old('txt_elaterales')}}" class="form-control"></td>   
                         </tr>
                         <tr>
                           <td>Espejo Interior</td>
                           <td><input type="radio" name="einterior" value="bueno">Bueno</td>
                           <td><input type="radio" name="einterior" value="regular">Regular</td>
                           <td><input type="radio" name="einterior" value="malo">Malo</td>
                           <td><input type="text" name="txt_einterior"  value="{{old('txt_einterior')}}" class="form-control"></td>   
                         </tr>
                         <tr>
                           <td>Bocina Retroceso</td>
                           <td><input type="radio" name="bretroceso" value="bueno">Bueno</td>
                           <td><input type="radio" name="bretroceso" value="regular">Regular</td>
                           <td><input type="radio" name="bretroceso" value="malo">Malo</td>
                           <td><input type="text" name="txt_bretroceso"  value="{{old('txt_bretroceso')}}" class="form-control"></td>   
                         </tr> 
                         <tr>
                           <td>Antena</td>
                           <td><input type="radio" name="antena" value="bueno">Bueno</td>
                           <td><input type="radio" name="antena" value="regular">Regular</td>
                           <td><input type="radio" name="antena" value="malo">Malo</td>
                           <td><input type="text" name="txt_antena"  value="{{old('txt_antena')}}" class="form-control"></td>   
                         </tr> 
                       </table>
                    </div>
                 
                </div>
           
            </div>
            

             {{-- Tercera Parte Check List --}}
              <div class="row">
                 <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12"> 
                    <div class="btn-group">
                       <table class="table table-bordered"" >
                         <tr>
                           <th colspan="5" style="text-align: center;"">DOCUMENTOS</th>
                         </tr>
                         <tr>
                           <th>ITEM</th>
                           <th>BUENO</th>
                           <th>REGULAR</th>
                           <th>MALO</th>
                           <th>OBSERVACIONES</th>
                         </tr>
                         <tr>
                           <td>Permiso de Circulación</td>
                           <td><input type="radio" name="pcirculacion" value="bueno">Bueno</td>
                           <td><input type="radio" name="pcirculacion" value="regular">Regular</td>
                           <td><input type="radio" name="pcirculacion" value="malo">Malo</td> 
                           <td><input type="text" name="txt_pcirculacion" value="{{old('txt_pcirculacion')}}" class="form-control"></td>                          
                         </tr>
                         <tr>
                           <td>Revisión Técnica</td>
                           <td><input type="radio" name="rtecnica" value="bueno">Bueno</td>
                           <td><input type="radio" name="rtecnica" value="regular">Regular</td>
                           <td><input type="radio" name="rtecnica" value="malo">Malo</td>  
                           <td><input type="text" name="txt_rtecnica" value="{{old('txt_rtecnica')}}" class="form-control"></td>  
                         </tr>
                         <tr>
                           <td>Liquído Frenos </td>
                           <td><input type="radio" name="lfrenos" value="bueno">Bueno</td>
                           <td><input type="radio" name="lfrenos" value="regular">Regular</td>
                           <td><input type="radio" name="lfrenos" value="malo">Malo</td> 
                           <td><input type="text" name="txt_lfrenos" value="{{old('txt_lfrenos')}}" class="form-control"></td>  
                         </tr>
                         <tr>
                           <td>Seguro Obligatorio</td>
                           <td><input type="radio" name="sobligatorio" value="bueno">Bueno</td>
                           <td><input type="radio" name="sobligatorio" value="regular">Regular</td>
                           <td><input type="radio" name="sobligatorio" value="malo">Malo</td> 
                           <td><input type="text" name="txt_sobligatorio"  value="{{old('txt_sobligatorio')}}" class="form-control"></td>  
                         </tr>                                                          
                       </table>
                    </div>
                 
                </div>
                 <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12"> 
                    <div class="btn-group">
                       <table class="table table-bordered"" >
                         <tr>
                           <th colspan="5" style="text-align: center;"">ESTADO GENERAL</th>
                         </tr>
                         <tr>
                           <th>ITEM</th>
                           <th>BUENO</th>
                           <th>REGULAR</th>
                           <th>MALO</th>
                           <th>OBSERVACIONES</th>
                         </tr>
                         <tr>
                           <td>Techo</td>
                           <td><input type="radio" name="techo" value="bueno">Bueno</td>
                           <td><input type="radio" name="techo" value="regular">Regular</td>
                           <td><input type="radio" name="techo" value="malo">Malo</td>  
                           <td><input type="text" name="txt_techo"  value="{{old('txt_techo')}}" class="form-control"></td>                           
                         </tr>
                         <tr>
                           <td>Capot</td>
                           <td><input type="radio" name="capot" value="bueno">Bueno</td>
                           <td><input type="radio" name="capot" value="regular">Regular</td>
                           <td><input type="radio" name="capot" value="malo">Malo</td>
                           <td><input type="text" name="txt_capot"  value="{{old('txt_capot')}}" class="form-control"></td>    
                         </tr>
                         <tr>
                           <td>Puertas</td>
                           <td><input type="radio" name="puertas" value="bueno">Bueno</td>
                           <td><input type="radio" name="puertas" value="regular">Regular</td>
                           <td><input type="radio" name="puertas" value="malo">Malo</td> 
                           <td><input type="text" name="txt_puertas"  value="{{old('txt_puertas')}}" class="form-control"></td>  
                         </tr>
                         <tr>
                           <td>Vidrios</td>
                           <td><input type="radio" name="vidrios" value="bueno">Bueno</td>
                           <td><input type="radio" name="vidrios" value="regular">Regular</td>
                           <td><input type="radio" name="vidrios" value="malo">Malo</td> 
                           <td><input type="text" name="txt_vidrios"  value="{{old('txt_vidrios')}}" class="form-control"></td>  
                         </tr>
                         <tr>
                           <td>Tapabarros</td>
                           <td><input type="radio" name="tapabarros" value="bueno">Bueno</td>
                           <td><input type="radio" name="tapabarros" value="regular">Regular</td>
                           <td><input type="radio" name="tapabarros" value="malo">Malo</td>
                           <td><input type="text" name="txt_tapabarros"  value="{{old('txt_tapabarros')}}" class="form-control"></td>   
                         </tr>
                         <tr>
                           <td>Parachoques</td>
                           <td><input type="radio" name="parachoques" value="bueno">Bueno</td>
                           <td><input type="radio" name="parachoques" value="regular">Regular</td>
                           <td><input type="radio" name="parachoques" value="malo">Malo</td>
                           <td><input type="text" name="txt_parachoques"  value="{{old('txt_parachoques')}}" class="form-control"></td>   
                         </tr>
                          <tr>
                           <td>Limpia Parabrisas</td>
                           <td><input type="radio" name="lparabrisas" value="bueno">Bueno</td>
                           <td><input type="radio" name="lparabrisas" value="regular">Regular</td>
                           <td><input type="radio" name="lparabrisas" value="malo">Malo</td>
                           <td><input type="text" name="txt_lparabrisas"  value="{{old('txt_lparabrisas')}}" class="form-control"></td>   
                         </tr>
                         <tr>
                           <td>Tubo de Escape</td>
                           <td><input type="radio" name="tescape" value="bueno">Bueno</td>
                           <td><input type="radio" name="tescape" value="regular">Regular</td>
                           <td><input type="radio" name="tescape" value="malo">Malo</td>
                           <td><input type="text" name="txt_tescape"  value="{{old('txt_tescape')}}" class="form-control"></td>   
                         </tr>
                          <tr>
                           <td>Limpieza</td>
                           <td><input type="radio" name="limpieza" value="bueno">Bueno</td>
                           <td><input type="radio" name="limpieza" value="regular">Regular</td>
                           <td><input type="radio" name="limpieza" value="malo">Malo</td>
                           <td><input type="text" name="txt_limpieza"  value="{{old('txt_limpieza')}}" class="form-control"></td>   
                         </tr>                         
                       </table>
                    </div>
                 
                </div>           
            </div>
        </div>
    </div>-->



    <div class="row">
            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            	<button class="btn btn-primary" type="submit" onclick="EventoAlert();">Crear Asignación</button>         
                <button class="btn btn-danger" type="reset">Cancelar</button>
            </div>
     </div>

    

	{!!Form::close()!!}		

 </div>
</div>

<div id="luces" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Sistema Luces</h4>
      </div>
      <div class="modal-body">
       <div class="panel panel-primary">
         <div class="panel-heading" style="text-align: center;">
            Estacionamiento
        </div>                 
        <div class="panel-body">           
            <input name="slu_estacionamiento" type="checkbox" value="1">Bueno&nbsp;           
            <input name="slu_bajas" type="checkbox" value="2">Regular&nbsp;
            <input name="slu_altas" type="checkbox" value="3">Malo&nbsp;            
        </div>
    </div>
     
    <div class="panel panel-primary">
         <div class="panel-heading" style="text-align: center;">
            Bajas
        </div>                 
        <div class="panel-body">           
            <input name="slu_estacionamiento" type="checkbox" value="1">Bueno&nbsp;           
            <input name="slu_bajas" type="checkbox" value="2">Regular&nbsp;
            <input name="slu_altas" type="checkbox" value="3">Malo&nbsp;            
        </div>
    </div>

    <div class="panel panel-primary">
         <div class="panel-heading" style="text-align: center;">
           Altas
        </div>                 
        <div class="panel-body">           
            <input name="slu_estacionamiento" type="checkbox" value="1">Bueno&nbsp;           
            <input name="slu_bajas" type="checkbox" value="2">Regular&nbsp;
            <input name="slu_altas" type="checkbox" value="3">Malo&nbsp;            
        </div>
    </div>
    
       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

@endsection