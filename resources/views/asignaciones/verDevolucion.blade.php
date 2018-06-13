

<p><strong>Quien Devolvio:&nbsp;&nbsp;</strong>{{$tdevolucion->nombre}}</p>
<p><strong>Fecha devolucion:&nbsp;&nbsp;</strong>{{date('d-m-Y',strtotime($tdevolucion->fecha_devolucion))}}</p>
<p><strong>Observaciones:&nbsp;&nbsp;</strong>{{$tdevolucion->descripcion}}</p>
<p>
	<h3>Datos del Vehiculo</h3>
</p>
<p><strong>Nombre:&nbsp;&nbsp;</strong>{{$tdevolucion->nomveh}}&nbsp;&nbsp;Marca:&nbsp;&nbsp;{{$tdevolucion->marca}}&nbsp;&nbsp;Modelo:&nbsp;&nbsp;{{$tdevolucion->modelo}}</p>
<p><strong>Año:&nbsp;&nbsp;</strong>{{$tdevolucion->axo}}&nbsp;&nbsp;Patente:&nbsp;&nbsp;{{$tdevolucion->patente}}</p>
<p><strong>Km devolución:&nbsp;&nbsp;</strong>{{$tdevolucion->km_devolucion}}&nbsp;&nbsp;