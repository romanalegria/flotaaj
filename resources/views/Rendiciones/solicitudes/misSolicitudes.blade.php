
<h2>Mis Solicitudes</h2>


<table id="versolicitudes" class="display" cellspacing="0" width="100%">
        		<thead style="background-color: #2e2f89; color:#259551; font-weight: bold;">
		            <tr>
		                <th>Id</th>
		                <th>fecha</th>		                
		                <th>Monto</th>
		                <th>Estado</th>		                
		                

		            </tr>
		        </thead>
		        <tfoot>
		        	<tr>
		        		<th>Id</th>
		                <th>fecha</th>		                
		                <th>Monto</th>
		                <th>Estado</th>		                
		        	</tr>
		        </tfoot>
		        <tbody>
			@foreach($tsolicitud as $solicitud)
				<tr>
					<td>{{$solicitud->id}}</td>
					<td>{{date('d-m-Y',strtotime($solicitud->fecha_solicitud))}}</td>
					<td>{{$solicitud->monto_solicitado}}</td>
				</tr>
			@endforeach
</table>

<script>
	$('#versolicitudes').DataTable(); 
</script>