<p><strong>Quien Solicito:&nbsp;&nbsp;</strong>{{$tasignacion->encargado}}&nbsp;&nbsp;{{$tasignacion->apellidos}}</p>
<p><strong>Fecha Asignaciòn:&nbsp;&nbsp;</strong>{{date('d-m-Y',strtotime($tasignacion->fecha_asignacion))}}</p>
<p><strong>Observaciones:&nbsp;&nbsp;</strong>{{$tasignacion->descripcion}}</p>
<p>
	<h3>Datos del Vehiculo</h3>
</p>
<p><strong>Nombre:&nbsp;&nbsp;</strong>{{$tasignacion->nomveh}}&nbsp;&nbsp;Marca:&nbsp;&nbsp;{{$tasignacion->marca}}&nbsp;&nbsp;Modelo:&nbsp;&nbsp;{{$tasignacion->modelo}}</p>
<p><strong>Año:&nbsp;&nbsp;</strong>{{$tasignacion->axo}}&nbsp;&nbsp;Patente:&nbsp;&nbsp;{{$tasignacion->patente}}</p>
<p><strong>Km entrega:&nbsp;&nbsp;</strong>{{$tasignacion->km_entrega}}&nbsp;&nbsp;
<br/>
 <td>  <a href="{{asset('imagenes/asignaciones/'.$tasignacion->acta_entrega)}}">Ver Acta Entrega</a></td>