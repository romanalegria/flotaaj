
 <h2 class="text-left">Detalle rendición de fondos Nº{{$id}}</h2>
<div class="contenido">	
	 <div class="row"> 
        <div class="col-lg-3 col-sm-3 col-md-3 col-xs-3">
          	<label>Proyecto:</label>
         </div>
         <div class="col-lg-6 col-sm-6 col-md- col-xs-6">
         	 <label id="nombreProyecto">
         </div>
        
  </div>

  	<table width="100%" class="table"  id="rendiciones" cellpadding="0">
			 <thead>
				<tr>
					<th><input type="checkbox" id="select_all"/>All</th>
					<th>Fila</th>
					<th style="display: none;">IDZona</th>
					<th>Zona</th>
					<th>Tipo Doc.</th>
					<th>Numero</th>
					<th>Fecha</th>
					<th style="display: none;">IDGasto</th>
					<th>Tipo Gasto</th>                    
					<th>Detalle</th>
					<th>Monto</th> 
					<th>Observaciones</th> 
					<th>Foto</th> 
          			<th>Dias</th>
          			<th>Acciones</th> 
				</tr>
				<tbody>
					  @foreach ($miRendicion as $mir)
					  	<tr>
					  		<td><input class="checkbox" type="checkbox" name="check[]" value="{{$mir->fila}}"></td>
					  		<td>{{$mir->fila}}</td>
					  		<td>{{$mir->codigoZona}}</td>
					  		<td>{{$mir->tipoDocumento}}</td>
					  		<td>{{$mir->numeroDocumento}}</td>
					  		<td>{{date('d-m-Y',strtotime($mir->fechaDocumento))}}</td>
					  		<td>{{$mir->concepto}}</td>
					  		<td>{{$mir->detalle}}</td>
					  		<td>{{$mir->monto}}</td>
					  		<td>{{$mir->observaciones}}</td>
					  		<td>
					  			@if ($mir->foto != "")
                            		<img src="{{asset('imagenes/rendiciones/'.$mir->foto)}}" height="100px" width="100px">
                        		@endif
					  		</td>
					  		<td>{{$mir->dias}}</td>
					  		<td>
					  			<button class="btn btn-warning">
					  				<span class="glyphicon glyphicon-ok"></span>
					  			</button>	
					  			<button class="btn btn-danger">
					  				<span class="glyphicon glyphicon-remove"></span>
					  			</button>
					  			<button class="btn btn-danger">
					  				<span class="glyphicon glyphicon-pencil"></span>
					  			</button>
					  		</td>
					  		
					  	</tr>
					  @endforeach
					
				</tbody>
			</thead> 
	</table>


</div>






<style>
	#contenido {
		position: absolute;
		min-height: 50%;
		width: 80%;
		top:20%;
		left: 5;
	}

	.selected {
		cursor: pointer;
	}

	.selected:hover{
		background-color: #0585C0;
		color: white;
	}

	.seleccionada{
		background-color: #0585C0;
		color: white;

	}
</style>