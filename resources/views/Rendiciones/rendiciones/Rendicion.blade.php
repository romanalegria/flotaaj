
<div id="grupoTablas">
  <ul>
    <li><a href="#tab-1">Rendir</a></li>
    <li><a href="#tab-2">Detalle</a></li>  
  </ul>

<div id="tab-1"> <!-- Comienzo Tab-1 -->
<div class="panel panel-primary">
    <div class="panel-heading" style="text-align: center;">
        Rendición de fondos
    </div>

    {!!Form::open(array('method'=>'POST','id' => 'frmA','role'=>'form','autocomplete'=>'off','files'=> 'true'))!!} 
    <meta name="_token" content="{!! csrf_token() !!}"/>
    {{-- {!!Form::open(array('url'=>'Rendiciones/rendiciones','method'=>'POST','id'=>'frmA','autocomplete'=>'off','files'=>'true'))!!}
    <meta name="_token" content="{!! csrf_token() !!}"/> --}}
    <div class="panel-body">               
       
            <div class="row">
                <div class="col-lg-8 col-sm-8 col-md-8 col-xs-12">
                    <div class="form-group">                         
                       <label for="Proyecto">Proyecto:</label>&nbsp;{{$codigoProyecto}}&nbsp;
                       <input type="hidden" name="proyecto" value="{{$codigoProyecto}}" id="proyecto"> 
                       <input type="hidden" name="id_solicitante" value="{{$id_solicitante}}" id="id_solicitante">
                       <input type="hidden" name="codigoSap" value="{{$codigoSap}}" id="codigoSap">
                       <input type="hidden" name="id_solicitud" value="{{$id_solicitud}}" id="id_solicitud">
                   </div>                    
               </div> 
            </div>

            <div class="row">
              <div class="col-lg-8 col-sm-8 col-md-8 col-xs-12">
                <div class="form-group">                         
                   <label for="Solicitud">Nombre:</label>&nbsp;{{$nombreProyecto}}&nbsp;
                   <input type="hidden" name="nombreProyecto" value="{{$nombreProyecto}}" id="nombreProyecto"> 
               </div>                    
              </div>
          </div>
      
       <div class="row">
           <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
             <div class="form-group">
                <label for="foto">Foto</label>  
                <input accept="image/*"  type="file" capture="camera" id="foto" name="foto"/>
                {{-- <input type="file" id="foto" name="foto"/>                             --}}
            </div>
        </div>                                
    </div>

    <div class="row">
       <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
         <div class="form-group">
            <label for="zona">Zona:</label>
            <select class="form-control" name="zona" id="zona">
               <option value="">Zona...</option>     
               @foreach ($zonas as $zona)
                <option value="{{$zona->codigo}}">{{$zona->id}}&nbsp;&nbsp;{{$zona->nombre}}</option>
               @endforeach 
           </select>
       </div>
   </div>

    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
     <div class="form-group">
        <label for="tipodoc">Tipo Documento</label>
        <select name="tipodoc" id="tipodoc" class="form-control">                         
            <option value="FAC">Factura</option>
            <option value="BOL">Boleta</option>
            <option value="VPO">Vale por</option>
        </select>
     </div>
    </div>
  </div>

<div class="row">
     <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
     <div class="form-group">
        <label for="ndoc">Nº Documento</label>
        <input type="number" name="ndoc" id="ndoc" required value="{{old('ndoc')}}" class="form-control" placeholder="Nº Documento...">
    </div>
  </div>

  <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
     <div class="form-group">
        <label for="fechadoc">Fecha Documento</label>
        <input type="date" name="fechadoc" id="fechadoc" required value="{{old('fechadoc')}}" class="form-control pull-left" placeholder="Fecha  documento...">
    </div>
  </div>

</div>

<div class="row">
   <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
     <div class="form-group">
        <label for="concepto">Motivo:</label>
        <select name="concepto" id="concepto" required class="form-control" onclick="tomarID(); "> 
           <option value="">Concepto...</option>                      
           @foreach ($tiposolicitudes as $tiposolicitud)
           <option value="{{$tiposolicitud->id}}">{{$tiposolicitud->concepto}}</option>
           @endforeach 
       </select>
   </div>
</div>
</div>

<div class="row">
  <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    <label for="consumo">Detalle:</label>
    <div class="form-group" id="consumo" name="consumo"> 
       <select name="subconsumo" id="subconsumo" required class="form-control"> 
          <option value="">SubConcepto...</option>                        
          @foreach ($tipogastos as $tipogasto)
           <option value="{{$tipogasto->id}}">{{$tipogasto->detalle}}</option>
          @endforeach                                                                        
    </select>
</div>
</div>      
</div>


<div class="row">
   <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
     <div class="form-group">
        <label for="monto">Monto:</label>
        <input type="number" name="monto" id="monto" required value="{{old('monto')}}" class="form-control" placeholder="Monto a rendir...">
    </div>
  </div>
    <div class="col-lg-3 col-sm-3 col-md-3 col-xs-3">
     <div class="form-group">
        <label for="monto">Dias:</label>
        <input type="number" name="dias" id="dias" required value="{{old('dias')}}" class="form-control" placeholder="Dias a rendir...">
    </div>
    </div>   
</div>

<div class="row">
   <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
     <div class="form-group">
        <label for="observaciones">Observaciones</label>                        
        <textarea name="observaciones" id="observaciones" required cols="64"  rows="5" placeholder="Observaciones..."></textarea>       
    </div>
</div>
</div>

<div class="row">
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">                       
      <button id="BtnEnviar" class="btn btn-primary" type="button"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;&nbsp;Agregar</button>
      <button class="btn btn-danger" type="reset">Cancelar</button>
  </div>
</div>
{!!Form::close()!!}  
</div>
</div>    
</div> <!-- Fin Tab-1 -->

<div id="tab-2"> <!-- Comienzo Tab-2 -->
    <h3>Detalle Rendición</h3>
    <div class="row">
       <table width="100%" class="display"  id="rendicion" name="rendicion">      
       <thead style="background-color: #2e2f89; color:#259551; font-weight: bold;">
          <tr>
            <th>Documento</th>
            <th>Tipo</th>
            <th>Monto</th> 
            <th>Foto</th> 
            <th>Acción</th>         
          </tr>
       </thead> 
        <tbody> 
          @if (isset($datos))             
              @foreach($datos as $dato)           
               <tr>
                <td>{{$dato->numeroDocumento}}</td>
                <td>{{$dato->tipoDocumento}}</td>
                <td>{{$dato->monto}}</td>
                <td><a id="photo" href="#">Ver</a></td>
                <td> 
                  <button id="eliminar" class="btn btn-danger" type="button"><i class="fa fa-trash" aria-hidden="true"></i>&nbsp;&nbsp;Eliminar</button>
                </td>            
               </tr>
            @endforeach          
          @endif            
        </tbody>     
    </table>
    </div>

    <div class="row">
      <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">                 
        <button class="btn btn-primary" type="button" id="BtnGenerar">Generar Rendición</button>        
      </div>
  </div>

</div>  <!-- Fin Tab-2 --> 

</div>

 
<script>     
    
    $(document).ready(function() 
    {
        // $('.js-example-basic-single').select2();
        // $('.js-example-basic-multiple').select2();  
        $('#rendicion').DataTable(); 
        $('#grupoTablas').tabs();
        var capa = document.getElementById("consumo");
        capa.style.display ='none';


        $.ajaxSetup
        ({
            headers: {'X-CSRF-Token': $('meta[name=_token]').attr('content')}
        });




        $('#BtnEnviar').on('click',function()        
        {   
            alert("entro al click");         
            validar_existe(function(_noexiste)
            {
                alert('entro');
              if(_noexiste)
              {
                validar(function(resp)
                {
                  if(resp)
                  {
                    //enviamos informacion                                                                                   
                           
                            $id_zona = $('#zona').val();                                                   
                            $foto = $('#foto');

                            var formData = new FormData(frmA);
                            formData.append('foto',$foto[0].files[0]);
                            formData.append('id_zona',$id_zona);
                            var id_solicitud = $('#id_solicitud').val();                            

                             $.ajax
                            ({
                                type: "post",
                                url: "/Rendiciones/pasorendicion",  
                                data: formData,
                                processData: false,
                                contentType: false,
                                success: function (Respuesta)                                                
                                 {                                    
                                      //limpiamos los input
                                       document.getElementById('ndoc').value = '';
                                       document.getElementById('fechadoc').value = '';
                                       document.getElementById('monto').value = '';
                                       document.getElementById('observaciones').value = '';
                                       document.getElementById('foto').value = '';
                                       document.getElementById('dias').value = '';
                                       capa = document.getElementById('consumo');
                                       capa.style.display ='none';                                
                                       recargar_detalle(id_solicitud);
                                   }
                                });

                               

                  }
                });
              }
            });
     
        });

        
            $('#BtnGenerar').on('click',function() 
             {                   
                    
                    var id_solicitante = $('#id_solicitante').val();                                       
                    var proyecto = $('#proyecto').val();
                    var nombreProyecto = $('#nombreProyecto').val();
                    var id_solicitud = $('#id_solicitud').val();

                    $.ajax({
                        type: "post",
                        url: "/Rendiciones/rendiciones-final",
                        data: {
                            id_solicitante: id_solicitante,
                            proyecto: proyecto,
                            nombreProyecto: nombreProyecto,
                            id_solicitud: id_solicitud
                        }, success: function (msg)                                                
                        {

                           //alert("Se ha realizado el POST con exito "+msg);
                            swal(
                                'Registro ingresado con exito',
                                 'Presione el boton OK!',
                                'success'
                            );

                            //limpiamos los input
                            

                         }
                    });
              });
        




 
   

//Recargamos el detalle de la rendicion de paso
function recargar_detalle(id)
{
    $.ajax
    ({
         url: '/Rendiciones/recargarDetalle/'+id+,
         method: 'GET'
         data :{
        }, success: function (msg)
        {

        }
          
     });    
  
}


 function validar_existe(callback)
{
   var existe = false
   var tipoDocumento = $('#tipodoc').val();
   var numeroDocumento = $('#ndoc').val();
   var concepto = $('#concepto').val();
   var monto = $('#monto').val();

   $.ajax({
     url: '/Rendiciones/validarExiste',
            type : 'get',              
            data: {
             tipoDocumento: tipoDocumento,
             numeroDocumento: numeroDocumento,
             concepto: concepto,
             monto: monto   

            },success: function (Respuesta)    
            { 
                
                if (Respuesta.estado)                  
                {
                   existe = true;                
                   
                }else
                {
                    swal("Rendición de fondos", Respuesta.mensaje, "warning");
                    existe =  false;                    
                    
                }                          
                
               callback(existe); 
            },error: function()
            {
               alert("Hubo algun problema en la validacion");
               
            }

   });
}

//Validación de monto autorizado 
  function validar(my_callback)
  {                             
          var resultado = false;
          var monto = $("#monto").val();
          var concepto = $("#concepto").val();
          var subconsumo = $("#subconsumo").val();
          var zona = $("#zona").val();
          var dias = $("#dias").val();
          if( subconsumo == ""){
            subconsumo = 0;
          }

          $.ajax({            
            url: '/Rendiciones/validarMonto',
            type : 'get',              
            data: {
             monto: monto,
             concepto: concepto,
             subconsumo: subconsumo,
             zona: zona,
             dias: dias   

            },success: function (Respuesta)    
            { 
                
                if (Respuesta.estado)                  
                {
                   resultado = true;                
                   
                }else
                {
                    swal("Rendición de fondos", Respuesta.mensaje, "warning");
                    resultado =  false;                    
                    
                }                          
                
               my_callback(resultado); 
            },error: function()
            {
               //alert("Hubo algun problema en la validacion");
               
            }

          });       

          return resultado;          
  } 

  function tomarID()
    {


        var idOpcion=document.getElementById("concepto").value;


        if(idOpcion == 1)
        {            
        capa = document.getElementById('consumo');
        capa.style.display ='block';

    }

    if(idOpcion == 2 || idOpcion == 3 || idOpcion == 4 || idOpcion == 5 || idOpcion == 6 || idOpcion == 7 || idOpcion == 8 || idOpcion == 9)
    {
        consumo.innerHTML = "";
    }

    }

});  //fin document.ready 

</script>

