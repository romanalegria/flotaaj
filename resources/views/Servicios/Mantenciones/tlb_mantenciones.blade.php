@extends('layouts.app')

@section('htmlheader_title')
	Flota AJ
@endsection

@section('main-content')

<script>
    $(document).ready(function() {
        $('#tabla_mantencion').DataTable({
        	
        });        
    } );
</script>

<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Tabla Mantenciones :</h3>
</div>
<div class="row">
	<div  class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
			
	</div>	
	<div  class="col-lg-6 col-md-6 col-sm-6 col-xs-6">		
		<a href="{{Route('mismantenciones_excel')}}"><button class="fa fa-file-excel-o btn btn-success">&nbsp;Excel</button></a>
		
	</div>	

</div> 
<br>


<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">	
			<table id="tabla_mantencion" class="display" cellspacing="0" width="99%">
        		<thead style="background-color: #2e2f89; color:#259551; font-weight: bold;">
		            <tr>
		                <th>Mantención</th>
		                <th>5000</th>
		                <th>10000</th>		                
		                <th>20000</th>
		                <th>30000</th>
		                <th>40000</th>
		                <th>50000</th>
		                <th>60000</th>
		                <th>70000</th>
		                <th>80000</th>
		                <th>90000</th>
		                <th>100000</th>
		            </tr>
		        </thead>
		        <tfoot>
		        	<tr>
		        		<th>Mantención</th>
		                <th>5000</th>
		                <th>10000</th>		                
		                <th>20000</th>
		                <th>30000</th>
		                <th>40000</th>
		                <th>50000</th>
		                <th>60000</th>
		                <th>70000</th>
		                <th>80000</th>
		                <th>90000</th>
		                <th>100000</th>
		        	</tr>
		        </tfoot>
		        <tbody>		        	
		        	  @foreach ($tabla_mantencion as $tman)
		        	  <td>{{$tman->nombre }}</td>  
		        	  <td>{{$tman->k5000 }}</td>  
		        	  <td>{{$tman->k10000 }}</td>  
		        	  <td>{{$tman->k20000 }}</td>  
		        	  <td>{{$tman->k30000 }}</td>  
		        	  <td>{{$tman->k40000 }}</td>  
		        	  <td>{{$tman->k50000 }}</td>  
		        	  <td>{{$tman->k60000 }}</td>  
		        	  <td>{{$tman->k70000}}</td>  
		        	  <td>{{$tman->k80000 }}</td>  
		        	  <td>{{$tman->k90000 }}</td>  
		        	  <td>{{$tman->k100000 }}</td>  
				<tr>
					
				</tr>			
			
				 @endforeach 
		      </tbody>
    		 </table>  
    		 <h2>C: Cambio</h2> 
    		 <h2>I: Inspección </h2> 
    	</div>
		 {{$tabla_mantencion->render()}} 
	</div>
</div>


 

@endsection