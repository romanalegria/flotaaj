

<h1 style="text-align: center; font-family: helvetica">ACTA DEVOLUCION VEHICULO</h1>

 

 <div class="row">
  	<h3 style="text-align: center; background-color: yellow;">IDENTIFICACION DEL CONDUCTOR</h3>
  	<hr/>
  </div>


 <div class="row">
         <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                <div class="form-group">
                    <label>Fecha Devolución</label>
                    {{date('d-m-Y',strtotime($asignacion->fecha_devolucion))}}
                </div>

        </div>
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                <div class="form-group">
                    <label>Entregado a:</label>
                    <span>{{ $asignacion->encargado}}&nbsp;{{ $asignacion->apellidos}}</span> 
                </div>

        </div>
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                <div class="form-group">
                    <label>Rut:</label>
                    <span>{{ $asignacion->rut}}</span> 
                </div>

        </div>
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                <div class="form-group">
                    <label>Telefo:</label>
                    <span>{{ $asignacion->telefono}}</span> 
                </div>

        </div>

  </div>
  <div class="row">
  	<hr/>
  </div>
  <div class="row">
  	<h3 style="text-align: center;background-color: gray">DETALLES DEL VEHICULO</h3>
  	<hr/>
  </div>

  <div class="row">
  		 <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
  		 	<label>PATENTE:</label>&nbsp;&nbsp;{{$asignacion->patente}}
  		 </div>	
  		 <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
  		 	<label>N° MOTOR:</label>&nbsp;&nbsp;{{$asignacion->numserie}}
  		 </div>
  		 <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
  		 	<label>MARCA:</label>&nbsp;&nbsp;{{$asignacion->marca}}
  		 </div>
  		 <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
  		 	<label>MODELO:</label>&nbsp;&nbsp;{{$asignacion->modelo}}
  		 </div>
  		 <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
  		 	<label>AÑO:</label>&nbsp;&nbsp;{{$asignacion->axo}}
  		 </div>
  		 <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
  		 	<label>COLOR:</label>&nbsp;&nbsp;{{$asignacion->color}}
  		 </div>
  		 <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
  		 	<label>KILOMETRAJE:</label>&nbsp;&nbsp;{{$asignacion->km_devolucion}}
  		 </div>
  </div>
  <hr/>
  <div class="row">
  	<h3 style="text-align: center;background-color: yellow">OBSERVACIONES</h3>
  	<hr/>
  </div>
  <div class="row">
  	<p>
  		{{$asignacion->descripcion}}
  	</p>
  </div>
  <hr/>
  <div class="row">
  	<h3 style="text-align: center;background-color: gray">CHECK-LIST DE DEVOLUCION</h3>
  	<hr/>

    <table border="1" width="100%">
        <tr>
         <td>
           <h3 style="text-align: center;background-color: gray">ITEMS</h3>
         </td> 
         <td colspan="4">
           <h3 style="text-align: center;background-color: gray">ESTADO</h3>
         </td> 
        </tr>
        <tr>
          <td colspan="5">
           <h3 style="text-align: center;background-color: gray">SISTEMA LUCES</h3>
         </td> 
        </tr>
        <tr>
          <td>Estacionamiento</td>
          <td>Bueno</td>
          <td>Regular</td>
          <td>Malo</td>   
          <td width="50%"></td>         
        </tr>
        <tr>
          <td>Bajas</td>
          <td>Bueno</td>
          <td>Regular</td>
          <td>Malo</td>          
          <td width="50%"></td>  
        </tr>
        <tr>
          <td>Altas</td>
          <td>Bueno</td>
          <td>Regular</td>
          <td>Malo</td>          
          <td width="50%"></td>  
        </tr>
        <tr>
          <td>Frenos</td>
          <td>Bueno</td>
          <td>Regular</td>
          <td>Malo</td>          
          <td width="50%"></td>  
        </tr>
        <tr>
          <td>Marcha Atràs</td>
          <td>Bueno</td>
          <td>Regular</td>
          <td>Malo</td>          
          <td width="50%"></td>  
        </tr>
        <tr>
          <td>Viraje Derecha</td>
          <td>Bueno</td>
          <td>Regular</td>
          <td>Malo</td>          
          <td width="50%"></td>  
        </tr>
        <tr>
          <td>Viraje Izquierda</td>
          <td>Bueno</td>
          <td>Regular</td>
          <td>Malo</td>          
          <td width="50%"></td>  
        </tr>
        <tr>
          <td>Patente</td>
          <td>Bueno</td>
          <td>Regular</td>
          <td>Malo</td>          
          <td width="50%"></td>  
        </tr>
        <tr>
          <td>Tercera Luz</td>
          <td>Bueno</td>
          <td>Regular</td>
          <td>Malo</td>          
          <td width="50%"></td>  
        </tr>

        <tr>
          <td colspan="5">
           <h3 style="text-align: center;background-color: gray">NEUMÁTICOS</h3>
         </td> 
        </tr>
        <tr>
          <td>Delantero Derecho</td>
          <td>Bueno</td>
          <td>Regular</td>
          <td>Malo</td>          
          <td width="50%"></td>                      
        </tr>
        <tr>
          <td>Delantero Izquierdo</td>
          <td>Bueno</td>
          <td>Regular</td>
          <td>Malo</td>          
          <td width="50%"></td>            
        </tr>
        <tr>
          <td>Trasero Derecho</td>
          <td>Bueno</td>
          <td>Regular</td>
          <td>Malo</td>          
          <td width="50%"></td>            
        </tr>
        <tr>
          <td>Trasero Izquierdo</td>
          <td>Bueno</td>
          <td>Regular</td>
          <td>Malo</td>          
          <td width="50%"></td>            
        </tr>
        <tr>
          <td>Repuesto</td>
          <td>Bueno</td>
          <td>Regular</td>
          <td>Malo</td>          
          <td width="50%"></td>            
        </tr>

        <tr>
          <td colspan="5">
           <h3 style="text-align: center;background-color: gray">NIVELES / MOTOR</h3>
         </td> 
        </tr>
        <tr>
          <td>Aceite Motor</td>
          <td>Bueno</td>
          <td>Regular</td>
          <td>Malo</td>          
          <td width="50%"></td>            
        </tr>
        <tr>
          <td>Agua Radiador</td>
          <td>Bueno</td>
          <td>Regular</td>
          <td>Malo</td>          
          <td width="50%"></td>            
        </tr>
        <tr>
          <td>Liquìdo Frenos</td>
          <td>Bueno</td>
          <td>Regular</td>
          <td>Malo</td>          
          <td width="50%"></td>            
        </tr>
        <tr>
          <td>Liquìdo Hidraulico</td>
          <td>Bueno</td>
          <td>Regular</td>
          <td>Malo</td>          
          <td width="50%"></td>            
        </tr>
        <tr>
          <td>Estado Bateria</td>
          <td>Bueno</td>
          <td>Regular</td>
          <td>Malo</td>          
          <td width="50%"></td>            
        </tr>

        <tr>
          <td colspan="5">
           <h3 style="text-align: center;background-color: gray">ACCESORIOS</h3>
         </td> 
        </tr>
        <tr>
          <td>Extintor</td>
          <td>Bueno</td>
          <td>Regular</td>
          <td>Malo</td>          
          <td width="50%"></td>            
        </tr>        
        <tr>
          <td>Chaleco Reflectante</td>
          <td>Bueno</td>
          <td>Regular</td>
          <td>Malo</td>          
          <td width="50%"></td>            
        </tr>
        <tr>
          <td>Botiquìn</td>
          <td>Bueno</td>
          <td>Regular</td>
          <td>Malo</td>          
          <td width="50%"></td>            
        </tr>
        <tr>
          <td>Gata</td>
          <td>Bueno</td>
          <td>Regular</td>
          <td>Malo</td>          
          <td width="50%"></td>            
        </tr>
        <tr>
          <td>LLave de Rueda</td>
          <td>Bueno</td>
          <td>Regular</td>
          <td>Malo</td>          
          <td width="50%"></td>            
        </tr>
        <tr>
          <td>Triàngulo</td>
          <td>Bueno</td>
          <td>Regular</td>
          <td>Malo</td>          
          <td width="50%"></td>            
        </tr>
        <tr>
          <td>Limpia Parabrisas</td>
          <td>Bueno</td>
          <td>Regular</td>
          <td>Malo</td>          
          <td width="50%"></td>            
        </tr>
        <tr>
          <td>Cinturon de Seguridad</td>
          <td>Bueno</td>
          <td>Regular</td>
          <td>Malo</td>          
          <td width="50%"></td>            
        </tr>
        <tr>
          <td>Espejos Laterales</td>
          <td>Bueno</td>
          <td>Regular</td>
          <td>Malo</td>          
          <td width="50%"></td>            
        </tr>
        <tr>
          <td>Espejo Interior</td>
          <td>Bueno</td>
          <td>Regular</td>
          <td>Malo</td>          
          <td width="50%"></td>            
        </tr>
        <tr>
          <td>Bocina Retroceso</td>
          <td>Bueno</td>
          <td>Regular</td>
          <td>Malo</td>          
          <td width="50%"></td>            
        </tr>
        <tr>
          <td>Antena</td>
          <td>Bueno</td>
          <td>Regular</td>
          <td>Malo</td>          
          <td width="50%"></td>            
        </tr>

        <tr>
          <td colspan="5">
           <h3 style="text-align: center;background-color: gray">DOCUMENTOS</h3>
         </td> 
        </tr>
         <tr>
          <td>Permiso Circulaciòn</td>
          <td>Bueno</td>
          <td>Regular</td>
          <td>Malo</td>          
          <td width="50%"></td>            
        </tr>
         <tr>
          <td>Revisiòn Tècnica</td>
          <td>Bueno</td>
          <td>Regular</td>
          <td>Malo</td>          
          <td width="50%"></td>            
        </tr>        
         <tr>
          <td>Seguro Obligatorio</td>
          <td>Bueno</td>
          <td>Regular</td>
          <td>Malo</td>          
          <td width="50%"></td>            
        </tr>

        <tr>
          <td colspan="5">
           <h3 style="text-align: center;background-color: gray">ESTADO GENERAL</h3>
         </td> 
        </tr>
        <tr>
          <td>Techo</td>
          <td>Bueno</td>
          <td>Regular</td>
          <td>Malo</td>          
          <td width="50%"></td>            
        </tr>
        <tr>
          <td>Capot</td>
          <td>Bueno</td>
          <td>Regular</td>
          <td>Malo</td>          
          <td width="50%"></td>            
        </tr>
        <tr>
          <td>Puertas</td>
          <td>Bueno</td>
          <td>Regular</td>
          <td>Malo</td>          
          <td width="50%"></td>            
        </tr>
        <tr>
          <td>Vidrios</td>
          <td>Bueno</td>
          <td>Regular</td>
          <td>Malo</td>          
          <td width="50%"></td>            
        </tr>
        <tr>
          <td>Tapabarros</td>
          <td>Bueno</td>
          <td>Regular</td>
          <td>Malo</td>          
          <td width="50%"></td>            
        </tr>
        <tr>
          <td>Parachoques</td>
          <td>Bueno</td>
          <td>Regular</td>
          <td>Malo</td>          
          <td width="50%"></td>            
        </tr>
        <tr>
          <td>Limpia Parabrisas</td>
          <td>Bueno</td>
          <td>Regular</td>
          <td>Malo</td>          
          <td width="50%"></td>            
        </tr>
        <tr>
          <td>Tubo de Escape</td>
          <td>Bueno</td>
          <td>Regular</td>
          <td>Malo</td>          
          <td width="50%"></td>            
        </tr>
        <tr>
          <td>Limpieza</td>
          <td>Bueno</td>
          <td>Regular</td>
          <td>Malo</td>          
          <td width="50%"></td>            
        </tr>
    </table> 
  </div>