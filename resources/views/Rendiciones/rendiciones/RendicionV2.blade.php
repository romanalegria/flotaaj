<div class="container">
  <div class="row">
      <button id="mostrarHtml" class="btn btn-primary" type="button"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;&nbsp;Agregar Fila</button> 
  </div>
</div>
<br>
<div class="contenido">
{{-- {!!Form::open(['method' => 'post','files' => true])!!}  --}}
{!!Form::open(array('method'=>'POST','role'=>'form','autocomplete'=>'off','files'=> 'true'))!!}


  <meta name="_token" content="{!! csrf_token() !!}"/>
  <div class="row"> 
        <div class="col-lg-3 col-sm-3 col-md-3 col-xs-3">
          <label>Proyecto:</label> {{$codigoProyecto}}
           <input type="hidden" name="proyecto" value="{{$codigoProyecto}}" id="proyecto"> 
         </div>
         <div class="col-lg-6 col-sm-6 col-md- col-xs-6">
          <label id="nombreProyecto">Nombre:</label> {{$nombreProyecto}}
           <input type="hidden" name="nameProyecto" value="{{$nombreProyecto}}" id="nameProyecto"> 
         </div>
         <div class="col-lg-3 col-sm-3 col-md- col-xs-3">
          <label>Solicitud:</label> {{$id_solicitud}}
           <input type="hidden" name="id_solicitud" value="{{$id_solicitud}}" id="id_solicitud">
            <input type="hidden" name="id_solicitante" value="{{$id_solicitante}}" id="id_solicitante">
         </div>
  </div>
<div class="row">
   
  <div class="col-lg-3 col-sm-3 col-md-3 col-xs-3">
    <div class="form-group">
      <label for="zona">Zona:</label>
      <select class="form-control" name="zona" id="zona">
        <option value="">Zona...</option>     
                  @foreach ($zonas as $zona)
                   <option value="{{$zona->codigo}}">{{$zona->nombre}}</option>
                   @endforeach  
               </select>
                
           </div>
       </div>
        <div class="col-lg-3 col-sm-3 col-md-3 col-xs-3">
         <div class="form-group">
            <label for="tipodoc">Tipo Documento</label>
            <select name="tipodoc" id="tipodoc" class="form-control">                         
                <option value="FAC">Factura</option>
                <option value="BOL">Boleta</option>
                <option value="VPO">Vale por</option>
            </select>

        </div>
      </div> 
       <div class="col-lg-3 col-sm-3 col-md-3 col-xs-3">
         <div class="form-group">
            <label for="ndoc">Nº Documento</label>
            <input type="number" name="ndoc" id="ndoc" required value="{{old('ndoc')}}" class="form-control" placeholder="Nº Documento...">
        </div>
      </div>
      <div class="col-lg-3 col-sm-3 col-md-3 col-xs-3">
         <div class="form-group">
            <label for="fechadoc">Fecha Documento</label>
            <input type="date" name="fechadoc" id="fechadoc" required value="{{old('fechadoc')}}" class="form-control" placeholder="Fecha  documento...">         
        </div>
      </div>
</div>
<div class="row">
   <div class="col-lg-3 col-sm-3 col-md-3 col-xs-3">
     <div class="form-group">
        <label for="concepto">Motivo:</label>
        <select name="concepto" id="concepto" required class="form-control" onclick="tomarID()";> 
           <option value="">Concepto...</option>                      
           @foreach ($tiposolicitudes as $tiposolicitud)
           <option value="{{$tiposolicitud->id}}">{{$tiposolicitud->concepto}}</option>
           @endforeach 
       </select>

   </div>
  </div>
  <div class="col-lg-3 col-sm-3 col-md-3 col-xs-3">
    <label for="concepto">Detalle:</label>
    <div class="form-group" id="consumo" name="consumo"> 
       <select name="subconsumo" id="subconsumo" class="form-control"> 
        <option value="">SubConcepto...</option>                        
        @foreach ($tipogastos as $tipogasto)
        <option value="{{$tipogasto->id}}">{{$tipogasto->detalle}}</option>
        @endforeach                                                                        
    </select>
  </div>
  </div> 
   <div class="col-lg-3 col-sm-3 col-md-3 col-xs-3">
     <div class="form-group">
        <label for="monto">Monto:</label>
        <input type="number" name="monto" id="monto" required value="{{old('monto')}}" class="form-control" placeholder="Monto a rendir...">
    </div>
  </div>
   <div class="col-lg-3 col-sm-3 col-md-3 col-xs-3">
     <div class="form-group">
        <label for="observaciones">Observaciones</label>                        
        <textarea name="observaciones" id="observaciones" required cols="3"  rows="1" class="form-control" placeholder="Observaciones..."></textarea>       
    </div>
  </div>  
 </div>
 <div class="row">     
    <div class="col-lg-3 col-sm-3 col-md-3 col-xs-3">
     <div class="form-group">
        <label for="monto">Dias:</label>
        <input type="number" name="dias" id="dias" required value="{{old('dias')}}" class="form-control" placeholder="Dias a rendir...">
    </div>
    </div>   

    <div class="col-lg-3 col-sm-3 col-md-3 col-xs-3">
             <div class="form-group">
                <label for="foto">Foto</label>  
                <input accept="image/*"  type="file" capture="camera" id="foto" name="foto[]"/>
               {{-- <input type="file" name="images[]" multiple/>                 --}}
           </div>
   
  </div>  
 </div>
 


    <button id="add" class="btn btn-primary" type="button"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;&nbsp;Agregar</button> 
    <button id="addRow" class="btn btn-primary" type="button"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;&nbsp;Agregar2</button> 
    <button id="del" class="btn btn-danger" type="button"><i class="fa fa-trash" aria-hidden="true"></i>&nbsp;&nbsp;Eliminar</button> 
    
{!!Form::close()!!}

 
 

</div> <!-- fin div contenido -->
<div class="tabla">
    

    <table width="100%" class="table display compact"  id="rendiciones">      
       <thead style="background-color: #2e2f89; color:#259551; font-weight: bold;">
        <tr>
          <th>Fila</th>
          <th>IDZona</th>
          <th>Zona</th>
          <th>Tipo Doc.</th>
          <th>Numero</th>
          <th>Fecha</th>
          <th>IDGasto</th>
          <th>Tipo Gasto</th>                    
          <th>Detalle</th>
          <th>Monto</th> 
          <th>Observaciones</th> 
          <th>Foto</th> 
          <th>Dias</th>         
        </tr>
        <tbody>
          
        </tbody>
      </thead> 
    </table>
    <div class="row">
      <div class="pull right">
        
        {{-- <label>Acumulado:</label>&nbsp;&nbsp;<label class="acumulado"></label> --}}
      </div>
    </div>
  <div class="row">
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">                 
      <button class="btn btn-primary" type="submit" id="BtnEnviar">Generar Rendición</button>      
    </div>
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 pull right">
      <button id="button" class="btn btn-danger" type="button"><i class="fa fa-trash" aria-hidden="true"></i>&nbsp;&nbsp;Seleccionar fila</button>  
    </div>
  </div>
</div>




<script>
  
$(document).ready(function(){

   Dropzone.options.myAwesomeDropzone = 
   {

                autoProcessQueue: false,
                uploadMultiple: true,
                parallelUploads: 100,
                maxFiles: 100,

                // Dropzone settings
                init: function() {
                    var myDropzone = this;

                    this.element.querySelector("button[type=submit]").addEventListener("click", function(e) {
                        e.preventDefault();
                        e.stopPropagation();
                        myDropzone.processQueue();
                    });
                    this.on("sendingmultiple", function() {
                    });
                    this.on("successmultiple", function(files, response) {
                    });
                    this.on("errormultiple", function(files, response) {
                    });
                }

    }



     var cont=0;
     
    //ocultamos la table detalle y mostramos solo la de detalle
     $(".contenido").css("display", "none");
     $(".tabla").css("display", "block");
    //monstramos el contenido al hacer clik en agregar linea
    $("#mostrarHtml").click(function()
    {      
       $(".contenido").css("display", "block");       
   });


    //funcion para eliminar linea del detalle
   $(document).on('click', '.borrar', function (event) 
   {
      event.preventDefault();
      $(this).closest('tr').remove();
      if(cont == 1)
      {
        cont = 0;
      }else{
        cont--;
      }
    });


    //Tabla rendiciones la generamos con atributos datatable
      // $(document).ready(function() {
      //     var t = $('#rendiciones').DataTable({});        
      // });

    //controlamos la paginacion
   

      capa = document.getElementById('consumo');
      capa.style.display ='none';
    
       $.ajaxSetup
           ({
             headers: {'X-CSRF-Token': $('meta[name=_token]').attr('content')}
       });


       

         
       var t = $('#rendiciones').DataTable();      
    

       $('#addRow').on('click',function()
       {
             var comboZona = document.getElementById("zona");
             var nombreZona = comboZona.options[comboZona.selectedIndex].text;
             var comboConcepto = document.getElementById("concepto");
             var nombreConcepto = comboConcepto.options[comboConcepto.selectedIndex].text;
           
           validar_existe(function(_noexiste)
           {
              if(_noexiste)
              {
                validar(function(resp)
                {
                  if(resp)
                  {
                     cont++;
                      // llenamos el datatable con la captura de arriba
                      t.row.add([
                          cont,
                          $("#zona").val(),
                          nombreZona,
                          $("#tipodoc").val(),
                          $("#ndoc").val(),
                          $("#fechadoc").val(),
                          $("#concepto").val(),
                          nombreConcepto,
                          $("#subconsumo").val(),
                          $("#monto").val(),
                          $("#observaciones").val(),
                          //$("#foto").val(),
                          $('input:file[name=foto]').val(),
                          $("#dias").val()                         
                      ]).draw(false);   
                   
                      //limipiamos variablses
                        document.getElementById('ndoc').value = '';
                        document.getElementById('fechadoc').value = '';
                        document.getElementById('monto').value = '';
                        document.getElementById('observaciones').value = '';
                        document.getElementById('foto').value = '';
                        document.getElementById('dias').value = '';
                        capa = document.getElementById('consumo');
                        capa.style.display ='none';
                       document.getElementById('zona').focus();    

                       //actualizamos el paginador
                       //grabamos datos en base de prueba  
                  }
                  else
                  {
                   alert("Hubo algun problema al agregar la linea"); 
                  }
                });           
              }else
              {
               
              }
             });    
            //ocultamos la cabecera
             $(".contenido").css("display", "none");  
             
     }); 

       //BORRANDO REGISTRO SELECCIONADO DEL DATATABLE
        $(document).ready(function() {
          var table = $('#rendiciones').DataTable();
       
          $('#rendiciones tbody').on( 'click', 'tr', function () {
              if ( $(this).hasClass('selected') ) {
                  $(this).removeClass('selected');
              }
              else {
                  table.$('tr.selected').removeClass('selected');
                  $(this).addClass('selected');
              }
          });
       
          $('#button').click( function () {
              table.row('.selected').remove().draw( false );
          });
      });       


      
       //$(document).on('click', '.eliminaFila', function (event) 
       //{           
            //event.preventDefault();                       
            //$(this).closest('tr').remove();            
           
        //});

        

       //$('#addRow').click();
     
       $('#add').click(function(){           

          //validamos que todos los campos esten con sus datos correspondientes para almacenar        

            //cabecera de la rendiciòn

             var comboZona = document.getElementById("zona");
             var nombreZona = comboZona.options[comboZona.selectedIndex].text;
             var comboConcepto = document.getElementById("concepto");
             var nombreConcepto = comboConcepto.options[comboConcepto.selectedIndex].text;
           
             //antes de agregar la linea debemos validar que el movimiento no se encuentre registrado
             validar_existe(function(_noexiste)
             {
              if(_noexiste)
              {
                validar(function(resp)
                {
                  if(resp)
                  {
                     

                     cont++;
                   $('#rendiciones > tbody:last-child').append('<tr class="selected" id="fila'+cont+'" onclick="seleccionar(this.id);"><td>'+
                      + cont +'</td><td style="display: none;">'+$("#zona").val()+'</td><td>'
                     +nombreZona+'</td><td>'+$("#tipodoc").val()+
                     '</td><td>'+$("#ndoc").val()+
                     '</td><td>'+$("#fechadoc").val()+
                     '</td><td style="display: none;">'+$("#concepto").val()+
                     '</td><td>'+nombreConcepto+
                     '</td><td>'+$("#subconsumo").val()+
                     '</td><td>'+$("#monto").val()+
                     '</td><td>'+$("#observaciones").val()+
                     '</td><td>'+$("#foto").val()+ 
                     '</td><td>'+$("#dias").val()+
                     '</td><td><button class="btn btn-danger borrar"><i class="fa fa-trash" aria-hidden="true"></i>&nbsp;&nbsp;Eliminar</button>'+
                     '</td></tr>');
                      //limipiamos variablses
                        document.getElementById('ndoc').value = '';
                        document.getElementById('fechadoc').value = '';
                        document.getElementById('monto').value = '';
                        document.getElementById('observaciones').value = '';
                        document.getElementById('foto').value = '';
                        document.getElementById('dias').value = '';
                        capa = document.getElementById('consumo');
                        capa.style.display ='none';
                       document.getElementById('zona').focus();    

                       //actualizamos el paginador
                       //grabamos datos en base de prueba  
                  }
                  else
                  {
                   alert("Hubo algun problema al agregar la linea"); 
                  }
                });           
              }else
              {
               
              }
             });          
              
              //ocultamos la cabecera
                 $(".contenido").css("display", "none");
            
        });   


        $('#del').click(function()
        {
          eliminar(id_fila_selected);
       });

        $('#BtnEnviar').click(function()
        {
          var arreglo = [];          
          
         
          //recorremos el DataTable para grabar las filas de la rendicion de fondos
          $('#rendiciones tr').each(function()                       
          {          
            var fotos = $(this).find("td");
             var fila = $(this).find("td").eq(0).html();
             if(fila > 0)
             {
                arreglo.push({
                  filaa: $(this).find("td").eq(0).html(),
                  zona: $(this).find("td").eq(1).html(),
                  tipoDocumento: $(this).find("td").eq(3).html(),
                  numeroDocumento: $(this).find("td").eq(4).html(),
                  fechaDocumento: $(this).find("td").eq(5).html(),
                  tipoGasto: $(this).find("td").eq(6).html(),
                  detalleGasto: $(this).find("td").eq(8).html(),
                  monto: $(this).find("td").eq(9).html(),
                  observaciones: $(this).find("td").eq(10).html(),
                  foto: $(this).find("td").eq(11).html(),                  
                  dias: $(this).find("td").eq(12).html()                 
                });
             }             
          });

          //creamos el ajax correpondiente para insertar la informacion
           
           var proyecto = $('#proyecto').val();
           var nameProyecto = $('#nameProyecto').val();
           var id_solicitante = $('#id_solicitante').val();
           var id_solicitud = $('#id_solicitud').val();
           $.ajax
           ({                
                type: "post",
                url: "/Rendiciones/rendiciones",
                data: {

                   'array' : JSON.stringify(arreglo),
                   proyecto : proyecto,
                   nombreProyecto : nameProyecto,
                   id_solicitante : id_solicitante,
                   id_solicitud : id_solicitud                    

                }, success: function (msg)                                                
                {
                         
                           swal(
                            'Registro ingresado con exito',
                            'Presione el boton OK!',
                            'success')
                             setTimeout(function(){
                                window.location.assign('/home')
                             }, 2000)


                            //limpiamos los input
                            document.getElementById('ndoc').value = '';
                            document.getElementById('fechadoc').value = '';
                            document.getElementById('monto').value = '';
                            document.getElementById('observaciones').value = '';
                            document.getElementById('foto').value = '';
                            document.getElementById('dias').value = '';
                            capa = document.getElementById('consumo');
                            capa.style.display ='none';

                            document.getElementById('proyecto').focus();


                        }
                });

       });       

});
   

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

  

  var id_fila_selected=[];
  function seleccionar(id_fila)
  {
    if($('#'+id_fila).hasClass('seleccionada')){
      $('#'+id_fila).removeClass('seleccionada');
    }
    else{
      $('#'+id_fila).addClass('seleccionada');
    }
    //2702id_fila_selected=id_fila;
    id_fila_selected.push(id_fila);
  }

  function eliminar(id_fila)
  {
    /*$('#'+id_fila).remove();
    reordenar();*/
    for(var i=0; i<id_fila.length; i++){
      $('#'+id_fila[i]).remove();
    }
    reordenar();
  }

  function reordenar()
  {
    var num=1;
    $('#rendiciones tbody tr').each(function(){
      $(this).find('td').eq(0).text(num);
      num++;
    });
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
         capa = document.getElementById('consumo');
         capa.style.display ='none';
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

