
<h1>Solicitud de SSGG</h1>

<p>
	Estimado usuario se genero solicitud de SSGG por <stong>{{$usuario->name}}</stong>,
	favor revisar en Intranet AJ
</p>




<div class="panel panel-primary">
    <div class="panel-heading">
       <p><strong>Solicitud Nº:&nbsp;</strong>{{$incidencia->id}}</p>
		<p><strong>Fecha Solicitud:&nbsp;</strong>{{$incidencia->fecha_creacion}}</p>

		<p><strong>Solicitado Por:</strong>{{$usuario->name}}</p>
		@if ($incidencia->sucursal == 1)
			<p><strong>Sucursal:</strong>La Divisa # 0340</p>
		@else	
			<p><strong>Sucursal:</strong>Holanda # 100</p>
		@endif
		
		@if ($incidencia->severidad == 1)
			<p><strong>Severidad:</strong>Alta</p>	
		@elseif	($incidencia->severidad == 2)
			<p><strong>Severidad:</strong>Media</p>	
		@else
			<p><strong>Severidad:</strong>Baja</p>	
		@endif

		@if ($incidencia->asignado == 1)
			<p><strong>Asignado A:</strong>Mantencion interna</p>	
		@else	
			<p><strong>Asignado A:</strong>Mantencion externa</p>	
		@endif	
		
		
		
		<p><strong>Titulo:</strong>{{$incidencia->resumen}}</p>
		<p><strong>Descripcion:</strong>{{$incidencia->descripcion}}</p>
    </div>
    <div class="panel-body">

    	
    	<br><br>
    	<p>Saludos cordiales</p><br>
		<p>{{$usuario->name}}</p>
    	
    </div>	
</div>