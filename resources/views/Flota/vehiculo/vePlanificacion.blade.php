<h3>ver planificaciòn</h3>

<table id="planificacion" class="display" cellspacing="0" width="100%">
        		<thead style="background-color: #2e2f89; color:#259551; font-weight: bold;">
		            <tr>
		                <th>id</th>
		                <th>nombre</th>
		                <th>tipo mantención</th>		               
		            </tr>
		        </thead>
		        <tfoot>
		        	<tr>
		        		<th>id</th>
		                <th>nombre</th>
		                <th>tipo mantención</th>	
		        	</tr>
		        </tfoot>
		        <tbody>
		        	@foreach($mantenciones as $man)
				<tr>
					
					<td>{{ $man->id}}</td>
					<td>{{ $man->nombre}}</td>
					<td>{{ $man->k5000}}</td>
				</tr>

				@endforeach
				
			
		      </tbody>
    		 </table>   





<script>
	$(document).ready(function() {    
    $('#planificacion').DataTable();        
} );

</script>