
<h1>Solicitud Mantenciòn de Vehìculo</h1>

<p>
	Estimado usuario se acaba de generar una solicitude de mantencion,
	detalle de lo solicitado :
</p>

<p><strong>Solicitud Nº:&nbsp;</strong>{{$solicitud}}</p>
<p><strong>Solicitado Por:&nbsp;</strong>{{$solicitante}}</p>
<p><strong>Vehiculo:&nbsp;</strong>{{$vehiculo->nombre}}&nbsp;{{$vehiculo->marca}}&nbsp;{{$vehiculo->modelo}}</p>
<p><strong>Kilometraje:&nbsp;</strong>{{$solicitudes->kilometraje}}</p>



<div class="panel panel-primary">
    <div class="panel-heading">
        <h1>Detalle de lo solicitado</h1>
    </div>
    <div class="panel-body">
    	

    	  <div class="panel-heading">
         	<h3>SISTEMA LUCES</h3> 
        </div>
        <div class="panel-body"> 
        	@if ($solicitudes->slu_estacionamiento)          
        		<li>Luces de Estationamiento</li>
        	@endif
            @if ($solicitudes->slu_bajas)          
        		<li>Luces Bajas</li>
        	@endif
			@if ($solicitudes->slu_altas)          
        		<li>Luces Altas</li>
        	@endif
			@if ($solicitudes->slu_freno)          
        		<li>Luces de Frenos</li>
        	@endif
        	@if ($solicitudes->slu_matras)          
        		<li>Luces Marcha Atras</li>
        	@endif
            @if ($solicitudes->slu_vderecha)          
        		<li>Luz Virar Derecha</li>
        	@endif
            @if ($solicitudes->slu_vizquierda)          
        		<li>Luz Virar Izquierda</li>
        	@endif
            @if ($solicitudes->slu_patente)          
        		<li>Luz Patente</li>
        	@endif
            @if ($solicitudes->slu_tluz)          
        		<li>Tercera Luz</li>
        	@endif           
          
        </div>
    </div>

    <div class="panel panel-primary">
         <div class="panel-heading">
            <h3>NEUMÁTICOS</h3> 
        </div>
        <div class="panel-body">
        	@if ($solicitudes->dderecho)          
        		<li>Neumàtico delantero derecho</li>
        	@endif
            @if ($solicitudes->dizquierdo)          
        		<li>Neumàtico delantero izquierdo</li>
        	@endif
            @if ($solicitudes->tderecho)          
        		<li>Neumàtico trasero derecho</li>
        	@endif
            @if ($solicitudes->tizquierdo)          
        		<li>Neumàtico trasero izquierdo</li>
        	@endif
             @if ($solicitudes->repuesto)          
        		<li>Repuesta</li>
        	@endif
            
        </div>
    </div>


     <div class="panel panel-primary">
         <div class="panel-heading">
           <h3>NIVELES / MOTOR</h3>  
        </div>
        <div class="panel-body">
        	@if ($solicitudes->amotor)          
        		<li>Repuesta</li>
        	@endif
            @if ($solicitudes->aradiador)          
        		<li>Radiador</li>
        	@endif
            @if ($solicitudes->lfrenos)          
        		<li>Liquìdo de frenos</li>
        	@endif
            @if ($solicitudes->lhidraulico)          
        		<li>Liquído Hidraulico</li>
        	@endif
            @if ($solicitudes->ebateria)          
        		<li>Estado Batería</li>
        	@endif
            
        </div>
    </div>

     <div class="panel panel-primary">
         <div class="panel-heading">
            <h3>ACCESORIOS</h3> 
        </div>
        <div class="panel-body">
        	@if ($solicitudes->extintor)          
        		<li>Extentir</li>
        	@endif
            @if ($solicitudes->chaleco)          
        		<li>Chaleco Reflectante</li>
        	@endif
            @if ($solicitudes->botiquin)          
        		<li>Botiquín</li>
        	@endif
            @if ($solicitudes->gata)          
        		<li>gata</li>
        	@endif
            @if ($solicitudes->lruedas)          
        		<li>LLave Ruedas</li>
        	@endif
            @if ($solicitudes->triangulo)          
        		<li>Triángulo</li>
        	@endif
            @if ($solicitudes->lparabrisa)          
        		<li>Limpia Parabrisa</li>
        	@endif
            @if ($solicitudes->cseguridad)          
        		<li>Cinturón de Seguridad</li>
        	@endif
            @if ($solicitudes->elaterales)          
        		<li>Espejos Laterales</li>
        	@endif
            @if ($solicitudes->einterior)          
        		<li>Espejo Interior</li>
        	@endif
            @if ($solicitudes->bretroceso)          
        		<li>Bocina tresoceso</li>
        	@endif
            @if ($solicitudes->antena)          
        		<li>Antena</li>
        	@endif
                
                
            </div>

        </div>
    </div>

     <div class="panel panel-primary">
         <div class="panel-heading">
            <h3>DOCUMENTOS</h3> 
        </div>
        <div class="panel-body">
        	@if ($solicitudes->pcirculacion)          
        		<li>Permiso Circulación</li>
        	@endif
            @if ($solicitudes->rtecnica)          
        		<li>Revisión Técnica</li>
        	@endif
            @if ($solicitudes->sobligatorio)          
        		<li>Seguro Obligatorio</li>
        	@endif            
        </div>
    </div>
        
      <div class="panel panel-primary">
         <div class="panel-heading">
            <h3>ESTADO GENERAL</h3> 
        </div>
        <div class="panel-body">
        	@if ($solicitudes->techo)          
        		<li>Techo</li>
        	@endif 
            @if ($solicitudes->capot)          
        		<li>Capot</li>
        	@endif 
            @if ($solicitudes->puertas)          
        		<li>Puertas</li>
        	@endif 
            @if ($solicitudes->vidrios)          
        		<li>Vidrios</li>
        	@endif 
            @if ($solicitudes->tapabarros)          
        		<li>Tapabarros</li>
        	@endif 
            @if ($solicitudes->parachoques)          
        		<li>Parachoques</li>
        	@endif 
            @if ($solicitudes->tescape)          
        		<li>Tubo Escape</li>
        	@endif 
			@if ($solicitudes->limpieza)          
        		<li>Limpieza</li>
        	@endif            
            
        </div>
    </div>

     <div class="panel panel-primary">
         <div class="panel-heading">
             <h3>OBSERVACIONES</h3>
        </div>
        <div class="panel-body">
				{{$solicitudes->observaciones}}	        	
        </div>
    </div>    
    	
    </div>	
