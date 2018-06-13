
<h1>Autorizaciòn de Fondos</h1>

<p>
	Estimado usuario se acaba de generar autorizacion de fondo a rendir,
	detalle de autorizacion :
</p>

<p><strong>Solicitud Nº:&nbsp;</strong>{{$variable}}</p>
<p><strong>Solicitado Por:&nbsp;</strong>{{$tsolicitud->nombre}}</p>
<p><strong>Proyecto:&nbsp;</strong>{{$solicitud->proyecto}}</p>
@if($solicitud->montoNuevo2 == null)
	<p><strong>Monto Autorizado:&nbsp;</strong>Su solicitud ha sido rechazada</p>
@else
	<p><strong>Monto Autorizado:&nbsp;</strong>{{$solicitud->montoNuevo2}}</p>
@endif

<p><strong>Autorizado Por:&nbsp;</strong>{{$solicitud->nombreGerente}}</p>
<p><strong>Fecha Autorizacion:&nbsp;</strong>{{$solicitud->fechaAutorizacion2}}</p>

<div class="panel panel-primary">
    <div class="panel-heading">
        Motivos de la solicitud
    </div>
    <div class="panel-body">
    	<table class="table-striped">
    		<thead>
		         <tr>	               
		           <th>Conceptos</th>		                		               
	            </tr>
		     </thead>
		     <tbody>
		    	 @foreach ($cargarMotivos as $con)
					<tr>						
						<td>{{$con->nombreMotivo}}</td>
					</tr>

		     	@endforeach
		     </tbody>
		     	
		     </tbody>
    	</table>
    	<br><br>
    	<p>Saludos cordiales</p><br>
		<p></p>
    	
    </div>	
</div>