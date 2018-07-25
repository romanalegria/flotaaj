


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

<div class="row" id="consumo" name="consumo">
  <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    <label for="consumo">Detalle:</label>
    <div class="form-group" > 
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


<div name="mensaje" id="mensaje">
    
</div>

{!!Form::close()!!}  
</div>
</div>    
</div> <!-- Fin Tab-1 -->

<div id="tab-2"> <!-- Comienzo Tab-2 -->
    <h3>Detalle Rendición</h3>
    <div class="row">
       <table width="100%" class="table table-bordered table-hover"  id="rendicion" name="rendicion">      
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
               <tr data-id="{{ $dato->id }}">                                
                <td>{{$dato->numeroDocumento}}</td>
                <td>{{$dato->tipoDocumento}}</td>
                <td>{{$dato->monto}}</td>
                <td><a id="photo" href="#">Ver</a></td>
                <td> 
                  <button class="btn btn-danger" type="button" onclick="eliminar({{ $dato->id }});"><i class="fa fa-trash" aria-hidden="true"></i></button>
                   <button class="btn btn-warning" type="button" onclick="editar({{ $dato->id }});"><i class="fa fa-pencil" aria-hidden="true"></i></button>
                  {{-- <button class="btn btn-warning form-editar" type="button" data-target="#Editar" data-toggle="modal" data-id="{{ $dato->id }}"><i class="fa fa-pencil" aria-hidden="true"></i></button> --}}
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

<!-- Modal editar fila pre-rendicion --> 
 {!!Form::open(array('method'=>'POST','id' => 'frmM','role'=>'form','autocomplete'=>'off','files'=> 'true'))!!} 
    <meta name="_token" content="{!! csrf_token() !!}"/>
<div class="modal fade" id='Editar' tabindex='-1' role='dialog' aria-labellebdy='myModalLabel'
  aria-hidden='true'>
  
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
           <h3 class="text-center">Editando fila: </h3>           
        </div>

        <div class="modal-body modal-editar">
          <div class="row">
           <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
             <div class="form-group">
                <label for="fotom">Foto</label>  
                <input accept="image/*"  type="file" capture="camera" id="fotom" name="fotom"/>                
               
            </div>
           </div>     
        </div>

       <div class="row">
       <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
         <div class="form-group">
            <label for="zona">Zona:</label>
            <select class="form-control" name="zonam" id="zonam">
               <option value="">Zona...</option>     
               @foreach ($zonas as $zona)
                <option value="{{$zona->codigo}}">{{$zona->id}}&nbsp;&nbsp;{{$zona->nombre}}</option>
               @endforeach 
           </select>
       </div>
        </div>
          <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
           <div class="form-group">
              <label for="tipodocm">Tipo Documento</label>
              <select name="tipodocm" id="tipodocm" class="form-control">                         
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
              <input type="number" name="ndocm" id="ndocm" required  class="form-control" placeholder="Nº    Documento...">
            </div>
        </div>

        <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
           <div class="form-group">
              <label for="fechadoc">Fecha Documento</label>
              <input type="date" name="fechadocm" id="fechadocm" required  class="form-control pull-left" placeholder="Fecha  documento...">
          </div>
        </div>

        </div>

        <div class="row">
           <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
             <div class="form-group">
                <label for="concepto">Motivo:</label>
                <select name="conceptom" id="conceptom" required class="form-control" onclick="tomarIDM(); "> 
                   <option value="">Concepto...</option>                      
                   @foreach ($tiposolicitudes as $tiposolicitud)
                   <option value="{{$tiposolicitud->id}}">{{$tiposolicitud->concepto}}</option>
                   @endforeach 
               </select>
            </div>
          </div>
        </div>

        <div class="row" id="consumom" name="consumom">
            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
              <label for="consumo">Detalle:</label>
              <div class="form-group" > 
                 <select name="subconsumom" id="subconsumom" required class="form-control"> 
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
                <input type="number" name="montom" id="montom" required  class="form-control" placeholder="Monto a rendir...">
            </div>
          </div>
            <div class="col-lg-3 col-sm-3 col-md-3 col-xs-3">
             <div class="form-group">
                <label for="monto">Dias:</label>
                <input type="number" name="diasm" id="diasm" required  class="form-control" placeholder="Dias a rendir...">
            </div>
            </div>   
       </div>



       <div class="row">
         <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
           <div class="form-group">
              <label for="observaciones">Observaciones</label>                        
              <textarea name="observacionesm" id="observacionesm" required cols="64"  rows="5" placeholder="Observaciones..."></textarea>       
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">                       
          <button id="BtnEnviarModificar" class="btn btn-primary" type="button"><i class="fa fa-pencil" aria-hidden="true"></i>&nbsp;&nbsp;Modificar</button>
          <button class="btn btn-danger" type="reset">Cancelar</button>
      </div>
    </div>

        <div class="modal-footer">
          <button class="btn btn-primary" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
      
    </div>
  </div>
  {!!Form::close()!!} 
<!-- Fin editar fila pre-rendicion --> 


 
 {{Form::Open(array('action'=>array('RendicionController@eliminarFilaPaso',':USER_ID'),'method'=>'DELETE','id' => 'form-delete'))}}
 {!! Form::close() !!} 

 
</div>



<script>         
 
      $(function (){
        esconde_div();  
         $('#rendicion').dataTable({
            "language":{
                  "sProcessing": "Procesanso...",
                  "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                  "oPaginate": {
                    "sFirst": "Primero",
                    "sLost": "Último",
                    "sNext": "Siguiente",
                    "sPrevious": "Anterior"
                  }
            },
            "processing": true,
            "serviceSide": true
         }); 
         $('#grupoTablas').tabs();
         $('#mensaje').hide();
      });

      
        $.ajaxSetup
        ({
            headers: {'X-CSRF-Token': $('meta[name=_token]').attr('content')}
        });



        //editar fila pre-rendicion
        $('.form-editar').click(function(event)
         {
                  event.preventDefault();                                
                  var loc = $(this).attr('href');
                  var id= $(this).data('id');  
                  
              
              $.ajax({
                 type: "get",
                 url: "/Rendiciones/editarFilaPaso/"+id,
                 data: 
                 {
                    
                 },success: function (Result)                                                
                 {              
                    console.log(Result.filaPaso[0].codigoZona);
                    
                 }
              });      
                 
          });




         $('#BtnEnviar').on('click',function()        
        {              
          
            validar_existe(function(_noexiste)
            {
                
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
                                    recargar_detalle(id_solicitud);

                                      //limpiamos los input
                                       document.getElementById('ndoc').value = '';
                                       document.getElementById('fechadoc').value = '';
                                       document.getElementById('monto').value = '';
                                       document.getElementById('observaciones').value = '';
                                       document.getElementById('foto').value = '';
                                       document.getElementById('dias').value = '';
                                       //capa = document.getElementById('consumo');
                                       //capa.style.display ='none';
                                       esconde_div(); 
                                       
                                       
                                       
                                   }
                                });                               

                     }
                });
              }else
              {
                
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
                        }, success: function (data)                                                
                        {
                            if(data.status)
                            {                               
                                $('#mensaje').show(0,function() {
                                    alert(data.message);
                                });                             
                           }else
                            {
                                 
                                 //si el resultdo es false
                             
                             }
                            //limpiamos los input
                            

                         }
                    });
         }); 

         $('.btn-delete').on('click',function (e) 
         {
            e.preventDefault();
            var row = $(this).parents('tr');
            var id = row.data('id');         
            var form = $('#form-delete');
            var url = form.attr('action').replace(':USER_ID', id);
            var data = form.serialize();
          
            row.fadeOut();            
            
            $.post(url, data, function (result) {
                alert(result);
             }).fail(function () {
                $('#mensaje').show(0,function() {
                    alert('La fila no fue elimnada');
                    row.show();
                });
             });   
                     
           
         });
        
         $('.btn-edit').on('click',function (e) 
         {
            e.preventDefault();
            var row = $(this).parents('tr');            
            var id = row.data('id');  
             alert(id);
         });





function eliminar(id)
{
            var row = $(this).parents('tr');
            //var id = row.data('id');         
            var form = $('#form-delete');
            var url = form.attr('action').replace(':USER_ID', id);
            var data = form.serialize();        
            var id_solicitud = $('#id_solicitud').val();          

            alert(id_solicitud);
            
            $.post(url, data, function (result) {                                  
                 alert(result);  
                 recargar_detalle(id_solicitud);              
             }).fail(function () {
                $('#mensaje').show(0,function() {
                    alert('La fila no fue elimnada');
                    
                });
             });   
            
           
            

            //row.fadeOut();            

           //$.ajax({
           //      type: "delete",
           //      url: "/Rendiciones/eliminarFilaPaso/"+id,
           //      data: 
           //      {
                    
           //      },success: function (Result)                                                
           //      {      
                    
           //        alert(Result);
           //     }
           //  });            
             
}


function editar(id)
{

      var $id = id;
      
      $.ajax({
       type: "get",
       url: "/Rendiciones/editarFilaPaso/"+$id,
        data: 
        {
           
        },success: function (Result)                                                
        {                              
         $('#fotom').val(Result.filaPaso[0].foto);         
         $('#zonam').val(Result.filaPaso[0].codigoZona);
         $('#ndocm').val(Result.filaPaso[0].numeroDocumento);

         $('#fechadocm').val(Result.filaPaso[0].fechaDocumento);
         $('#montom').val(Result.filaPaso[0].monto);
         $('#diasm').val(Result.filaPaso[0].dias);
         $('#tipodocm').val(Result.filaPaso[0].tipoDocumento);
         $('#conceptom').val(Result.filaPaso[0].codigoGasto);         
         if(Result.filaPaso[0].codigoGasto == 1)
         {
            tomarIDM();
         }
         $('#subconsumom').val(Result.filaPaso[0].codigoDetalle);
         $('#observacionesm').val(Result.filaPaso[0].observaciones);
         $('#diasm').val(Result.filaPaso[0].dias);         

          $('#Editar').modal('show');




         }
      }); 

       $('#BtnEnviarModificar').on('click',function() {
             
            validar_existe(function(_noexiste)
            {
                
              if(_noexiste)
              {
                validar(function(resp)
                {
                  if(resp)
                  {
                    //enviamos informacion                                                                                   
                         
                            $id_zona = $('#zonam').val();                                                   
                            $foto = $('#fotom');

                            var formData = new FormData(frmM);
                            formData.append('fotom',$foto[0].files[0]);
                            formData.append('id_zonam',$id_zona);                            
                            var id_solicitud = $('#id_solicitud').val();

                             $.ajax
                            ({
                                type: "post",
                                url: "/Rendiciones/pasorendicion/"+id,  
                                data: formData,
                                processData: false,
                                contentType: false,
                                success: function (Respuesta)                                                
                                 {       
                                    recargar_detalle(id_solicitud);

                                      //limpiamos los input
                                       document.getElementById('ndocm').value = '';
                                       document.getElementById('fechadocm').value = '';
                                       document.getElementById('montom').value = '';
                                       document.getElementById('observacionesm').value = '';
                                       document.getElementById('fotom').value = '';
                                       document.getElementById('diasm').value = '';
                                       //capa = document.getElementById('consumo');
                                       //capa.style.display ='none';
                                       esconde_div(); 
                                       
                                       
                                       
                                   }
                                });                               

                     }
                });
              }else
              {
                
              }
            });
        });     


 
}


 function esconde_div()
 {
    var capa = document.getElementById("consumo");
    capa.style.display ='none';
    var capam = document.getElementById("consumom");
    capam.style.display ='none';
 }  
  

//Recargamos el detalle de la rendicion de paso
function recargar_detalle(id)
{
    $.ajax({
         url: '/Rendiciones/recargarDetalle/'+id,
         method: 'GET',
         data :{
        }, success: function(response)
        {
          $.each(response, function(index, value){
            llenar(response,index,value);
          });
           
        }
          
    });    

    //segunda opcion

    // $('#rendicion > tbody:last-child').append('<tr class="selected">'+             
    //    '<td>'+$("#ndoc").val()+
    //    '</td><td>'+$("#tipodoc").val()+             
    //    '</td><td>'+$("#monto").val()+       
    //    '</td><td>'+'<a id="photo" href="#">Ver</a>'+        
    //    '</td><td><button class="btn btn-danger btn-delete" type="button"><i class="fa fa-trash" aria-hidden="true"></i></button>'+
    //    '<button class="btn btn-warning btn-edit"><span class="glyphicon glyphicon-pencil"></span></button>'+
    //    '</td></tr>');
    
       
         
  
}

function llenar(response, index, value)
{  
  $('#rendicion').DataTable({
     "destroy": true,
     "data": response,
     "columns":[
        {"data": "numeroDocumento"},
        {"data": "tipoDocumento"},
        {"data": "monto"},
        {"data": "foto"}       
     ] 
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
                    //swal("Rendición de fondos", Respuesta.mensaje, "warning");
                    $('#mensaje').show(0,function() {
                        alert(Respuesta.mensaje);
                    });
                    existe =  false;                    
                    
                }                          
                
               callback(existe); 
            },error: function()
            {
               alert("Hubo algun problema en la validacion");
               
            }

   });
}


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
}


function tomarIDM()
{
        var idOpcion=document.getElementById("conceptom").value;

        if(idOpcion == 1)
        {            
          capam = document.getElementById('consumom');
          capam.style.display ='block';
        }
}


</script>

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


