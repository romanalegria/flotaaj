
<h2>Mis Mantenciones</h2>


<table id="vermantenciones" class="display" cellspacing="0" width="100%">
        		<thead style="background-color: #2e2f89; color:#259551; font-weight: bold;">
		            <tr>
		                <th>Id</th>
		                <th>fecha</th>		                
		                <th>km_vehiculo</th>
		                <th>km_aplicado</th>
		                <th>Trabajos</th>
		                

		            </tr>
		        </thead>
		        <tfoot>
		        	<tr>
		        		<th>Id</th>
		                <th>fecha</th>		                
		                <th>km_vehiculo</th>
		                <th>km_aplicado</th>
		                <th>Trabajos</th>	                
		        	</tr>
		        </tfoot>
		        <tbody>
			@foreach($tmantencion as $mantencion)
				<tr>
					<td>{{$mantencion->id}}</td>
					<td>{{date('d-m-Y',strtotime($mantencion->fecha))}}</td>
					<td>{{$mantencion->km_vehiculo}}</td>
					<td>{{$mantencion->km_aplicar}}</td>
					<td>{{$mantencion->trabajos}}</td>
				</tr>
			@endforeach
</table>

<script>
	$('#vermantenciones').DataTable(); 
</script>