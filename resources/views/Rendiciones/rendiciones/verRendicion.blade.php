

{!!Form::model($tsolicitud,['method'=>'PUT','route'=>['updateSolicitud',$tsolicitud->id],'files'=>'true'])!!}
{{Form::token()}}

<p><strong>Mont original solicitado:&nbsp;&nbsp;</strong>{{$tsolicitud->monto_solicitado}}</p>
<p><strong>Monto autorizado con reparo:&nbsp;&nbsp;</strong>{{$tsolicitud->montoNuevo1}}</p>
<p><strong>Proyecto:&nbsp;&nbsp;</strong>{{$tsolicitud->proyecto}}</p>

 <div class="panel-body">
    	<table class="table-striped">
    		<thead>
		         <tr>	               
		           <th>Motivos</th>		                		               
	            </tr>
		     </thead>
		     <tbody>
		    
		     	 @foreach ($motivos as $mot)
					<tr>						
						<td>{{$mot->nombreMotivo}}</td>
					</tr>

		     	@endforeach
		     </tbody>
    	</table>
    	<br><br>
    	<section>
    		 <div class="form-group">
                    <label>Resolucion</label>
                     <select name="resolucion" id="resolucion" required class="form-control" onclick="tomarID(); ">
                          <option value="">Eligir...</option>
                          <option value="1">Aprobada</option>
                          <option value="2">Aprobada con reparo</option>
                          <option value="3">Rechazada</option>
                       
                    </select>  
              </div>  
              <div id="monto"></div>           
	          <div id="valor"></div>
            
    	</section>
    	<button class="btn btn-primary btn-submit">Guardar</button>              
    	
    </div>	
  {!!Form::close()!!}
  <script>
  	function tomarID()
  	{
  		var valor=document.getElementById("valor");
  		var monto=document.getElementById("monto");
  		var idOpcion=document.getElementById("resolucion").value;

  		if(idOpcion == 2)
  		{
  			monto.innerHTML ='<label>Monto</label>';
  			valor.innerHTML ='<input type="number" name="monto_nuevo">';
  		}

      if(idOpcion == 1)
      {
        monto.innerHTML ='<label>Monto</label>';
        valor.innerHTML ='<input type="hidden" name="monto_nuevo" value="{{$tsolicitud->monto_solicitado}}">';
      }

  	}
  </script>
