@extends('layouts.app')

@section('htmlheader_title')
	Home
@endsection


@section('main-content')

	{{--  <div class="container spark-screen">
		  <div class="row">
			<div class="col-md-10 col-md-offset-1">
				<div class="panel panel-default">
					<div class="panel-heading">Solicitud y rendiciones de fondos</div>

					<div class="panel-body">
						<div class="col-md-6 col-sm-6 col-xs-12">
							<div class="info-box">
								<a href="flota/vehiculo">
								<span class="info-box-icon bg-red">
									<i class="fa fa-money">
										
									</i>
								</span>
								<div class="info-box-content">
										<span class="info-box-text">Solicitudes por aprobar</span>
										<span class="info-box-number">{{$solicitudes}}</span>
								</div>	
								</a>
							</div>
						</div>	
						<div class="col-md-6 col-sm-6 col-xs-12">
							<div class="info-box">
								<a href="flota/vehiculo">
								<span class="info-box-icon bg-red">
									<i class="fa fa-money">
										
									</i>
								</span>
								<div class="info-box-content">
										<span class="info-box-text">Rendiciones por aprobar</span>
										<span class="info-box-number">{{$rendiciones}}</span>
								</div>	
								</a>
							</div>
						</div>	
					</div>
				</div>
			</div>
		</div>    --}}

	<!-- Jefe directo--> 
	 @if (Auth::User()->idrol == 2 || Auth::User()->idrol == 1) 
	
	<div class="row">
	<div class="col-md-12 col-md-offset-0">
		<div class="panel panel panel-primary">
					<div class="panel-heading" style="text-align:center;">Solicitudes de fondos pendientes por autorizar</div>

		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">		
			<table id="incidencias" class="display" cellspacing="0" width="100%">
        		<thead style="background-color: #2e2f89; color:#259551; font-weight: bold;">
		            <tr>
		            	<th><input type="checkbox" id="select_all"/>All</th>
		                <th>Id</th>
		                <th>Fecha</th>
		                <th>Nombre</th>	
		                <th>Proyecto</th>		                
		                <th>Monto</th>
		                <th>Σ Proyecto</th>
		                <th>Σ Proyecto y AN</th>
		                <th>Σ Gtos Proyecto</th>
		                <th>Σ Usuario</th>
		                <th>Acciones</th>
		            </tr>
		        </thead>
		        <tfoot>
		        	<tr>
		        		<th><input type="checkbox" id="select_all"/>All</th>
		        		<th>Id</th>
		        		<th>Fecha</th>
		                <th>Nombre</th>		                
		                <th>Proyecto</th>		                
		                <th>Monto</th>
		                <th>Σ Proyecto</th>
		                <th>Σ Proyecto y AN</th>
		                <th>Σ Gtos Proyecto</th>
		                <th>Σ Usuario</th>
		                <th>Acciones</th>
		        	</tr>
		        </tfoot>
		        <tbody>
		       


		         @foreach ($misSolicitudes as $mis)
				<tr>					
					<td><input class="checkbox" type="checkbox" name="check[]" value="{{$mis->id}}"></td>
					<td id="id_">{{ $mis->id}}</td>
					<td>{{date('d-m-Y',strtotime($mis->fecha_solicitud))}}</td>
					<td>{{ $mis->name}}</td>					
					<td data-toggle="tooltip" class="nombreProyecto" title="{{ $mis->nombreProyecto}}">{{ $mis->proyecto}}</td>		
					<td>{{ $mis->monto_solicitado}} </td>						
					<!-- aqui va le valor por proyecto -->
					 @if (isset($mis->Solicitado))					 	
							<td>{{number_format($mis->Solicitado)}}</td>				
					@else					 	
					 		<td>0</td>												 		
					 @endif
				 	
				
					<!-- aqui va le valor por proyecto y area de negocio -->
					@if (isset($mis->SolicitadoxAN))					 	
							<td>{{number_format($mis->SolicitadoxAN)}}</td>						
					 	
					 @else					 	
					 		<td>0</td>						
					 	
					 @endif
				
					<!-- aqui va le valor por total proyecto  -->
					@if (isset($mis->totalProyecto))					 	
							<td><a class="fa fa-arrow-right ver-detalle-proyecto" data-target="#detalleProyecto" data-toggle="modal" data-id="{{ $mis->proyecto}}"></a>{{number_format($mis->totalProyecto)}}</td>						
					 	
					 @else					 	
					 		<td>0</td>						
					 	
					 @endif				
					
					
					<!-- aqui va le valor por persona -->					
					 @if (isset($mis->Saldo))					 	
							<td>{{number_format($mis->Saldo)}}</td>										
					 @else					 
					 		<td>0</td>						
					 @endif
					
							
										
					<td>
					<a class="btn btn-success ver-solicitud" data-target="#Solicitudes" data-toggle="modal" data-id="{{$mis->id}}" >Ver</a>

					</td>
				</tr>			
			
				@endforeach  <!-- fin de las incidencias abierta --> 

		      </tbody>
    		 </table>       	
		 {{-- {{$misSolicitudes->render()}}   --}}
	 </div>
	 </div>
		<div><a class="btn btn-success" onclick="Todos();">Autorizar</a></div>
	</div>
	</div>
	<hr>
	<!-- Rendiciones de fondos por revisar y autorizar --> 	
	<div class="row">
		<div class="col-md-12 col-md-offset-0">
			<div class="panel panel panel-primary">
					<div class="panel-heading" style="text-align:center;">Rendiciones de fondos pendientes por autorizar</div>

		<div class="col-lg-24 col-md-24 col-sm-24 col-xs-24">		
			<table id="rendiciones" class="display" cellspacing="0" width="100%">
        		<thead style="background-color: #2e2f89; color:#259551; font-weight: bold;">
		            <tr>
		            	<th><input type="checkbox" id="select_all"/>All</th>
		                <th>Id</th>
		                <th>Fecha</th>
		                <th>Nombre</th>	
		                <th>Proyecto</th>		                		               
		                <th>Solicitud</th>
		                <th>Detalle</th>		                
		                
		            </tr>
		        </thead>
		        <tfoot>
		        	<tr>
						<th><input type="checkbox" id="select_all"/>All</th>
		                <th>Id</th>
		                <th>Fecha</th>
		                <th>Nombre</th>	
		                <th>Proyecto</th>		                		             
		                <th>Solicitud</th>
		                <th>Detalle</th>		                
		              
		        	</tr>
		        </tfoot>
		        <tbody>
		       


		         @foreach ($misRendiciones as $mis)
				<tr>					
					<td><input class="checkbox" type="checkbox" name="check[]" value="{{$mis->id_rendicion}}"></td>
					<td id="id_">{{ $mis->id_rendicion}}</td>
					<td>{{date('d-m-Y',strtotime($mis->fecha))}}</td>
					<td>{{ $mis->name}}</td>										
					<td data-toggle="tooltip" class="nombreProyecto" title="{{ $mis->nombreProyecto}}">{{ $mis->proyecto}}</td>
					
					<td>{{ $mis->nSolicitud}}</td>
					<td>
						<a class="btn btn-success ver-rendicion" data-target="#Rendiciones" data-toggle="modal" data-id="{{$mis->id_rendicion}}" >Ver</a>	
					</td>
					
				</tr>			
			
				@endforeach  <!-- fin de las rendiciones por autorizar --> 

		      </tbody>
    		 </table>       	
		{{-- {{$misRendiciones->render()}}  --}}
	</div>	
	</div>
			<div><a class="btn btn-success" onclick="TodosRendiciones();">Autorizar</a></div>
	</div>
	</div>

	<!-- Fin rendiciones de fondos por revisar y autorizar --> 	

 @endif
 <!-- Fin Jefe Directo--> 

<!-- Gerencia General--> 
 @if (Auth::User()->idrol == 4) 
	
	<div class="row">
			<div class="col-md-24 col-md-offset-24">
		<div class="panel panel panel-primary">
					<div class="panel-heading" style="text-align:center;">Solicitudes de fondos pendientes por autorizar</div>
					
		<div class="col-lg-24 col-md-24 col-sm-16 col-xs-24">
		 <div class="table-responsive">	
		 <form id="testForm">
			<table id="incidencias" class="display" cellspacing="0" width="100%">
        		<thead style="background-color: #2e2f89; color:#259551; font-weight: bold;">
		            <tr>
		            	<th><input type="checkbox" id="select_all"/>All</th>
		                <th>Id</th>
		                <th>Nombre</th>	
		                <th>Jefatura</th>	
		                <th>Proyecto</th>						
		                <th>Monto</th>
		                <th>Σ Proyecto</th>
		                <th>Σ Proyecto y AN</th>
		                <th>Σ Gtos Proyecto</th>
		                <th>Σ Usuario</th>
		                <th>Acciones</th>
		            </tr>
		        </thead>
		        <tfoot>
		        	<tr>
		        		<th><input type="checkbox" id="select_all"/>All</th>
		        		<th>Id</th>
		                <th>Nombre</th>
		                <th>Jefatura</th>			                
		                <th>Proyecto</th>		                              		                               
		                <th>Monto</th>
		                <th>Σ Proyecto</th>
		                <th>Σ Proyecto y AN</th>
		                <th>Σ Gtos Proyecto</th>
		                <th>Σ Usuario</th>
		                <th>Acciones</th>
		        	</tr>
		        </tfoot>
		        <tbody>
		       
			

		         @foreach ($misSolicitudes as $mis)
				<tr>
					<td><input class="checkbox" type="checkbox" name="check[]" value="{{$mis->id}}"></td>
					<td id_="id">{{ $mis->id}}</td>
					<td>{{ $mis->name}}</td>
					<td>{{ $mis->nombreJefe}}</td>					
					<td data-toggle="tooltip"  title="{{ $mis->nombreProyecto}}">{{ $mis->proyecto}}</td>
					<input type="hidden" id="nombreProyecto" value="{{$mis->nombreProyecto}}">

					<td>{{ $mis->montoNuevo1}} </td>
					<!-- aqui va le valor por proyecto -->
					 @if (isset($mis->Solicitado))					 	
							<td>{{number_format($mis->Solicitado)}}</td>				
					@else					 	
					 		<td>0</td>												 		
					 @endif					
				
					<!-- aqui va le valor por proyecto y area de negocio -->
					@if (isset($mis->SolicitadoxAN))					 	
							<td>{{number_format($mis->SolicitadoxAN)}}</td>						
					 	
					 @else					 	
					 		<td>0</td>						
					 	
					 @endif			
					
					<!-- aqui va le valor por total proyecto  -->
					@if (isset($mis->totalProyecto))					 	
							<td><a class="fa fa-arrow-right ver-detalle-proyecto" data-target="#detalleProyecto" data-toggle="modal" data-id="{{ $mis->proyecto}}"></a>{{number_format($mis->totalProyecto)}}</td>						
					 	
					 @else					 	
					 		<td>0</td>						
					 	
					 @endif
					
					<!-- aqui va le valor por persona -->					
					 @if (isset($mis->Saldo))					 	
							<td>{{number_format($mis->Saldo)}}</td>										
					 @else					 
					 		<td>0</td>						
					 @endif

										
					<td>
						<a class="btn btn-success ver-solicitud" data-target="#Solicitudes" data-toggle="modal" data-id="{{$mis->id}}" >Ver</a>                       

					</td>
				</tr>			
			
				@endforeach  <!-- fin de las incidencias abierta --> 

		      </tbody>
    		 </table>   
    	</form>
    	</div>
		{{$misSolicitudes->render()}}  
			</div>
		</div>
		<div><a class="btn btn-success" onclick="Todos();">Autorizar</a></div>
	</div>
	</div>
 @endif
<!-- fin Gerencia General--> 

	</div><!-- clase container no eliminar -->

<!-- Modal de solicitudes -->
@if (Auth::User()->idrol == 2 || Auth::User()->idrol == 4 || Auth::User()->idrol == 1) 

<div class="modal fade" id='Solicitudes' tabindex='-1' role='dialog' aria-labellebdy='myModalLabel'
  aria-hidden='true'>
  
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
           <h2 class="text-center">Solicitante:&nbsp;&nbsp;{{$mis->name}} </h2>
        </div>
        <div class="modal-body modal-solicitudes">
         	
        </div>
        <div class="modal-footer">         
          <button class="btn btn-primary" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
      
    </div>
  </div>
@endif
 <!-- Fin Modal solicitud -->

 <!-- Modal detalle de un proyecto -->
@if (Auth::User()->idrol == 2 || Auth::User()->idrol == 4 || Auth::User()->idrol == 1) 

<div class="modal fade" id='detalleProyecto' tabindex='-1' role='dialog' aria-labellebdy='myModalLabel'
  aria-hidden='true'>
  
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
           <h3 class="text-center">Proyecto:&nbsp;&nbsp;<label class="proyecto"></h3>
        </div>      
        <div class="modal-body modal-detalle-gasto-proyecto">
         	
        </div>
        <div class="modal-footer">         
          <button class="btn btn-primary" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
      
    </div>
  </div>
@endif
 <!-- Fin Modal detalle -->

<!-- Modal de revision rendiciones -->
@if (Auth::User()->idrol == 2 || Auth::User()->idrol == 4 || Auth::User()->idrol == 1) 

<div class="modal fullscreen-modal fade" id='Rendiciones' tabindex='-1' role='dialog' aria-labellebdy='myModalLabel'
  aria-hidden='true'>
  
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button class="close" data-dismiss="modal" aria-hidden="true">&times;</button>          
        </div>
        <div class="modal-body modal-rendiciones">
         	
        </div>
        <div class="modal-footer">         
          <button class="btn btn-primary" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
      
    </div>
  </div>
@endif


	<script>

 	    $(document).ready(function() 
	 	  {
	 	  
	 	  	$('#incidencias').DataTable();
	 	  	$('#rendiciones').DataTable();        	        	
        	$('[data-toggle="tooltip"]').tooltip();
        	$('[data-toggle="tooltip1"]').tooltip();
   		 });



 	    	//ventana modal detalle gastos de un proyecto
 	    	  $('.ver-detalle-proyecto').click(function(event) 
 	    	  {
				event.preventDefault();
				$('.modal-detalle-gasto-proyecto').html('Cargando...');
			    var loc = $(this).attr('href');
			    var id= $(this).data('id'); 			   
			    $('.proyecto').html(id);		    
          		 		    
			    

			    console.log(id);
			    $.ajax({
				  url: '/detalle/'+id+'/gastos',				  
				  method: 'GET'
				}).done(function(view) {				
					$('.modal-detalle-gasto-proyecto').html(view);
					//console.log(data);
				  //$( this ).addClass( "done" );
				});

			});


 	    	  //ventana modal para autorizar linea a linea una rendicion de fondos
 	    	   $('.ver-rendicion').click(function(event) {
				event.preventDefault();
				$('.modal-rendiciones').html('Cargando...');
			    var loc = $(this).attr('href');
			    var id= $(this).data('id');
			    
			    $.ajax({
				  url: '/rendiciones/'+id+'/validaRendicionJefe',				  
				  method: 'GET'
				}).done(function(view) {				
					$('.modal-rendiciones').html(view);
					//console.log(data);
				  //$( this ).addClass( "done" );
				});

			});



	 	    function Todos()	 	    
	 	    {	   			
			 	   	
				
			  	 var ids = '';   

			        $('[name="check[]"]').each(function(){
			            if (this.checked) {
			                ids += $(this).val()+',';
			            }
			        }); 

						  $.ajax({
						        type: "get",
						        dataType: 'json',
						        data: { 'id': $("#id_").val(),						        		
						                //'ids': JSON.stringify($('[name="check[]"]').serializeArray())
						                'ids': ids
						              },
						        url: "/autorizacion/autorizar",
						        success : function(data) 						        
						        {
						        	 if(data.status)
						        	 {		
						        	 	swal("Autorización de fondos", data.message, "success")				        	 
						         	 	setTimeout(function(){
			                        	window.location.assign('/home')
			                        }, 2000) // 1000 equivale a 1 segundo, 2000 equivale a dos segundos y así...
			                        
			                    	}else
			                      	{
			                      		
				                      	//si el resultdo es false
				                      
			                       	}
			                   },error: function(data){
			                   		swal("Autorización de fondos", "Favor revisar, hubo algun problema al generar autorizaciones", "warning");	
			                   }

									      
						    });
													
	 	    	
	 	    }





	 	  //jquery para checkbox seleccionar todos
			//select all checkboxes
			$("#select_all").change(function(){  //"select all" change 				
			    var status = this.checked; // "select all" checked status			     
			    $('.checkbox').each(function(){ //iterate all listed checkbox items
			        this.checked = status; //change ".checkbox" checked status	
			        if (status == true){
			           $('#elegido').attr('disabled',false); //habilitamos el boton autorizar todos
			        }else{
			        	$('#elegido').attr('disabled',true); //deshabilitamos el boton autorizar todos
			        }
			       	
			    });			    
			});

			$('.checkbox').change(function(){ //".checkbox" change 
			    //uncheck "select all", if one of the listed checkbox item is unchecked
			    if(this.checked == false){ //if this item is unchecked
			        $("#select_all")[0].checked = false; //change "select all" checked status to false
			       		       
			    }
			    
			    //check "select all" if all checkbox items are checked
			    if ($('.checkbox:checked').length == $('.checkbox').length ){ 
			        $("#select_all")[0].checked = true; //change "select all" checked status to true			       		       
			    }
			});	 	  

			 	   


         $('.ver-solicitud').click(function(event) {
            event.preventDefault();
            $('.modal-solicitudes').html('Cargando...');
            var loc = $(this).attr('href');
            var id= $(this).data('id');
           
            $.ajax({
                  url: '/rendiciones/solicitudes/'+id+'/verSolicitud',
                  method: 'GET'
                }).done(function(view) {
                    $('.modal-solicitudes').html(view);
                    //console.log(data);
                  //$( this ).addClass( "done" );
            });

        });

         function Guardar() {
         	alert('Guardado');
         }       
       
        @if(Session::has('message'))
        var type = "{{ Session::get('alert-type', 'info') }}";
        switch(type){
            case 'info':
                toastr.info("{{ Session::get('message') }}");
                break;
            
            case 'warning':
                toastr.warning("{{ Session::get('message') }}");
                break;
            case 'success':
                toastr.success("{{ Session::get('message') }}");
                break;
            case 'error':
                toastr.error("{{ Session::get('message') }}");
                break;
        }
    	@endif

    </script>
  <style>
    	.nombreProyecto,.nombreProyecto1 {
    		display: inline-block;
    		width: 5em;
    	}
    	.nombreProyecto1 {
    		display: inline-block;
    		width: 5em;
    	}


 

		  .fullscreen-modal .modal-dialog {
		  margin: 0;
		  margin-right: auto;
		  margin-left: auto;
		  width: 100%;
		  }
		  @media (min-width: 768px) {
		  .fullscreen-modal .modal-dialog {
		    width: 750px;
		  }
		  }
		  @media (min-width: 992px) {
		  .fullscreen-modal .modal-dialog {
		    width: 970px;
		  }
		  }
		  @media (min-width: 1200px) {
		  .fullscreen-modal .modal-dialog {
		     width: 1170px;
		  }
		  }


    </style>
@endsection
