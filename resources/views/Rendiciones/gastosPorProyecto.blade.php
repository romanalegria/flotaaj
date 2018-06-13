

  <p><strong>Nombre Proyecto:&nbsp;&nbsp;</strong>{{$proyecto->PrjName}}</p>  
 
<table id="ver_asignaciones" class="display" cellspacing="0" width="100%">
     		<thead style="background-color: #2e2f89; color:#259551; font-weight: bold;">
		            <tr>
		                <th>Cuenta</th>
		                <th>Descripción</th>
		                <th>Monto</th>
		                
		            </tr>
		        </thead>
		        <tfoot>
		        	<tr>
		        		<th>Cuenta</th>
		                <th>Descripción</th>
		                <th>Monto</th>
		        	</tr>
		        </tfoot>
		        <tbody>
		        	@foreach($solicitadoProyecto as $sp)
				<tr>
					
					<td>{{ $sp->account}}</td>
					<td>{{ $sp->acctname}}</td>
					<td>{{number_format($sp->Solicitado)}}</td>
				</tr>

				@endforeach
				
			
		      </tbody>
    		 </table>   





<script>
	$(document).ready(function() {    
    $('#ver_asignaciones').DataTable();        
} );

</script>