@extends('layouts.app')

@section('htmlheader_title')
   Asignar Documentos
@endsection


@section('main-content')

<script>
     $(document).ready(function() {
        $('#documentacion').DataTable();        
    } );

    function EventoAlert(d) {
    
      $("#Form").on("submit", function(e){
        e.preventDefault();
        var form = $(this);
        var url = form.attr('action');
        var formData = new FormData(document.getElementById("Form"));
        //formData.append("dato", "valor");
        //formData.append(f.attr("name"), $(this)[0].files[0]);
        $.ajax({
            url: url,
            type: "post",
            dataType: "html",
            data: formData,
            cache: false,
            contentType: false,
            processData: false
        })
            .done(function(result){
            console.log(result);
            });
    });
       
        
}
</script> 

 <div class="panel panel-primary">
         <div class="panel-heading">
            Control de Documentos
        </div>
  <div class="panel-body">


    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
          
            @if (count($errors)>0)
            <div class="alert alert-danger">
                <ul>
                @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
                </ul>
            </div>
            @endif
        </div>
         {!!Form::open(array('url'=>'flota/vehiculo/'.$vehiculos->id.'/documentos','method'=>'POST','autocomplete'=>'off','files'=>'true','enctype' => 'multipart/form-data'))!!}
          {{Form::token()}}   
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">            
              <h4>Vehículo : <h3>{{$vehiculos->id}}&nbsp;{{$vehiculos->nombre}}&nbsp;Patente:&nbsp;{{$vehiculos->patente}}  </h3> </h4>
             <input type="hidden" value="{{$vehiculos->id}}" name="id_vehiculo" class="id_vehiculo">
        </div>
    </div>
   
    
    <div class="row">
        <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
                <div class="form-group">
                    <label>Documento</label>
                     <select name="documento" class="form-control">
                         @foreach ($documentos as $doc)
                          <option value="{{$doc->id}}">{{$doc->nombre}}</option>
                         @endforeach
                    </select>
                </div>
        </div>  

       <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
            <div class="form-group">
                <label for="fechav">Vencimiento Documento</label>
                <input type="date" name="fechav" required value="{{old('fecha_vencimiento')}}" class="form-control" placeholder="Vencimiento Licencia...">
            </div>      
        </div>        
    </div>

    

      <div class="row" >
         <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
            <div class="form-group">
                <label for="poliza">N° Poliza</label>
                <input type="text" name="poliza" required value="{{old('poliza')}}" class="form-control" placeholder="Poliza...">
            </div>  
        </div>   
        <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
            <div class="form-group">
                <label for="item">N° Item</label>
                <input type="text" name="item" required value="{{old('item')}}" class="form-control" placeholder="Item de la poliza...">
            </div>  
        </div>   
        <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
             <div class="form-group">
                 <label for="archivo">Documento</label>
                 <input type="file" name="archivo" class="form-control">
             </div>
          </div>
    </div>
   
    <div class="row">
            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                <button class="btn btn-primary" type="submit" onclick="EventoAlert();">Guardar</button>               
            </div>
     </div>
 {!!Form::close()!!}
</div>
</div>

 <div class="panel panel-primary">
         <div class="panel-heading">
           Documentos Asignados
        </div>
  <div class="panel-body">

  <div class="row">
    <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
        <div class="table-responsive">  
            <table id="documentacion" class="display" cellspacing="5" width="100%">
                <thead style="background-color: #2e2f89; color:#259551; font-weight: bold;">
                    <tr>
                        <th>Id</th>
                        <th>Documento</th>
                        <th>Vencmiento</th> 
                        <th>Ver</th> 
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Id</th>
                        <th>Documento</th>
                        <th>Vencimiento</th>
                        <th>Ver</th> 
                        <th>Acciones</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach ($documentacion as $doc)
                <tr>
                   <td>{{$doc->id}}</td>
                   <td>{{$doc->nombre}}</td>
                 
                   @if($doc->fecha_vencimiento > date('Y-m-d'))
                        <td style="background-color: green; color: white ">{{date('d-m-Y',strtotime($doc->fecha_vencimiento))}}</td>
                    @else
                        <td style="background-color: red; color: white">{{date('d-m-Y',strtotime($doc->fecha_vencimiento))}}</td>
                    @endif
                  
                   <td>  <a href="{{asset('imagenes/vehiculos/documentacion/'.$doc->archivo)}}">Ver Documento</a></td>
                    <td>
                        <a href="" data-target="#modal-delete-{{$doc->id}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
                    </td>
                </tr>                
                @include('flota.vehiculo.modalDocumento')
                @endforeach
              </tbody>
             </table>   
        </div>
       
    </div>
</div>
</div>
</div>

    

      



@endsection