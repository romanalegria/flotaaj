

<table id="ver_asignaciones" class="display" cellspacing="0" width="100%">
        		<thead style="background-color: #2e2f89; color:#259551; font-weight: bold;">
		            <tr>
		                <th>#Asig</th>
		                <th>Fecha</th>
		                <th>Asignado A:</th>
		                <th>#Dev</th>
		                <th>Fecha Dev.</th>
		            </tr>
		        </thead>
		        <tfoot>
		        	<tr>
		        		<th>#Asig</th>
		                <th>Fecha</th>
		                <th>Asignado A:</th>
		                <th>#Dev</th>
		                <th>Fecha Dev.</th>
		        	</tr>
		        </tfoot>
		        <tbody>
		        	@foreach($tasignacion as $asignacion)
				<tr>
					
					<td>{{ $asignacion->id}}</td>
					<td>{{date('d-m-Y',strtotime($asignacion->fecha_asignacion))}}</td>
					<td>{{ $asignacion->encargado}}&nbsp;{{ $asignacion->apellidos}}</td>
					<td>{{ $asignacion->id_devolucion}}</td>
				    <td>{{date('d-m-Y',strtotime($asignacion->fecha_devolucion))}}</td>
				</tr>

				@endforeach
				
			
		      </tbody>
    		 </table>   





<script>
	$(document).ready(function() {    
    $('#ver_asignaciones').DataTable();        
} );

</script>