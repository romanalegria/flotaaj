
<h2>Mis Rendiciones</h2>


<table id="verrendiciones" class="display" cellspacing="0" width="100%">
        		<thead style="background-color: #2e2f89; color:#259551; font-weight: bold;">
		            <tr>
		                <th>Id</th>
		                <th>fecha</th>
		                <th>Proyecto</th>          
		                <th>Monto</th>
		                <th>Estado</th>	
		                <th>Acciones</th>	                
		                

		            </tr>
		        </thead>
		        <tfoot>
		        	<tr>
		        		<th>Id</th>
		                <th>fecha</th>
		                <th>Proyecto</th>          
		                <th>Monto</th>
		                <th>Estado</th>
		                <th>Acciones</th>
		        	</tr>
		        </tfoot>
		        <tbody>
			@foreach($trendicion as $rendicion)
				<tr>
					<td>{{$rendicion->id_rendicion}}</td>
					<td>{{date('d-m-Y',strtotime($rendicion->fecha))}}</td>
					<td>{{$rendicion->proyecto}}</td>
					<td>{{$rendicion->rendido}}</td>
					<td>{{$rendicion->totalRendido}}</td>
					<td><a id="rendicion" href="#">Ver</a></td>
				</tr>
			@endforeach
</table>

<script>
	$('#verrendiciones').DataTable(); 

	  $('#rendicion').click(function(){
          alert('ver Rendicion');
     });
</script>