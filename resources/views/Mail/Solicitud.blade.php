
<h1>Solicitud de fondos</h1>

<p>
	Estimado usuario se genero solicitud de fondos de su trabajador <stong>{{$nombre}}</stong>,
	favor revisar en Intranet AJ
</p>


<p><strong>Solicitado Por:&nbsp;</strong>{{$nombre}}</p>
<p><strong>Proyecto:&nbsp;</strong>{{$proyecto}}</p>
<p><strong>Nombre Proyecto:&nbsp;</strong>{{$nombreProyecto}}</p>
<p><strong>Monto Solicitado:&nbsp;</strong>{{$monto}}</p>

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
		    
		     	 @foreach ($conceptos as $con)
					<tr>						
						<td>{{$con->nombreMotivo}}</td>
					</tr>

		     	@endforeach
		     </tbody>
    	</table>
    	<br><br>
    	<p>Saludos cordiales</p><br>
		<p>{{$nombre}}</p>
    	
    </div>	
</div>