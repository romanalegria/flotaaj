@extends('layouts.app')

@section('htmlheader_title')
  Control de Arriendos
@endsection



@section('main-content')
<div class="panel panel-primary">
    <div class="panel-heading">
        Control de Arriendos
    </div>  
<div class="panel-body">
    <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
              
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
    </div>
 {!!Form::model($arriendo,['method'=>'PUT','route'=>['arriendos.update',$arriendo->id,$arriendo->id_solicitante,$arriendo->proyecto],'files'=>'true'])!!}
       {{Form::token()}}
    <div class="row">
     <div class="col-lg-4 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
                <label>Solicitante</label>
                <select name="usuario" class="form-control">
                    @foreach ($usuarios as $usu)
                        @if ($usu->id == $arriendo->id_solicitante)
                            <option value="{{$usu->id}}" selected>{{$usu->name}}</option>
                        @else
                            <option value="{{$usu->id}}">{{$usu->name}}</option>
                        @endif
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-lg-4 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
                <label>Proyecto</label>
                <select name="proyecto" class="form-control">
                    @foreach ($proyectos as $proy)
                        @if ($proy->PrjCode == $arriendo->proyecto)
                            <option value="{{$proy->PrjCode}}" selected>{{$proy->PrjName}}</option>
                        @else
                            <option value="{{$proy->PrjCode}}">{{$proy->PrjName}}</option>
                        @endif
                    @endforeach
                </select>
            </div>
        </div>
         <div class="col-lg-4 col-sm-4 col-md-4 col-xs-4">
            <div class="form-group">
                <label for="monto">Monto Cancelado(con IVA)</label>
                <input type="number" name="monto_cancelado" required value="{{$arriendo->valorCancelado}}" class="form-control" placeholder="Valor cancelado...">
            </div>      
        </div>

    </div>
      <div class="row">
        <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
            <div class="form-group">
                 <label for="factura">N° Documento</label>
                  <input type="number" name="factura" required value="{{$arriendo->factura}}" class="form-control" placeholder="N° Factura...">
             </div>
        </div>
        <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
            <div class="form-group">
                 <label for="fecha">Fecha del documento</label>
                  <input type="date" name="fecha" required value="{{$arriendo->fecha}}" class="form-control" placeholder="N° Fecha factura...">
             </div>
        </div>
    </div>


    <div class="panel panel-default">
     <div class="panel-heading">
        <h3 class="panel-title">Datos del vehículo</h3>
         
    </div>
    <div class="panel-body">
         <div class="row">
          <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
           <div class="form-group">
                 <label for="marca">Marca</label>
                  <input type="text" name="marca" required value="{{$arriendo->marca}}" class="form-control" placeholder="marca vehículo...">
            </div>
          </div> 
          <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
           <div class="form-group">
                 <label for="modelo">Modelo</label>
                  <input type="text" name="modelo" required value="{{$arriendo->modelo}}" class="form-control" placeholder="modelo vehículo...">
            </div>
          </div> 
          <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
           <div class="form-group">
                 <label for="axo">Año</label>
                  <input type="number" name="axo" required value="{{$arriendo->axo}}" class="form-control" placeholder="modelo vehículo...">
            </div>
          </div> 
        </div>
        <div class="row">
           <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
           <div class="form-group">
                 <label for="color">Color</label>
                  <input type="text" name="color" required value="{{$arriendo->color}}" class="form-control" placeholder="color vehículo...">
            </div>
          </div> 
           <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
           <div class="form-group">
                 <label for="color">Patente</label>
                  <input type="text" name="patente" required value="{{$arriendo->patente}}" class="form-control" placeholder="patente vehículo...">
            </div>
          </div> 
        </div>
        <div class="row">
            <div class="col-lg-12 col-sm-12 col-md-12 col-xs-4">
            <label for="observaciones">Observaciones</label>
            <div class="form-group">             
                <textarea name="observaciones" cols="120"  rows="5"  required value="{{$arriendo->observaciones}}"placeholder="observaciones..."></textarea>                
            </div>      
        </div>
        </div>

    </div>
</div>
       
   <div class="row">
            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                <button class="btn btn-primary" type="submit">Guardar</button>
                <button class="btn btn-danger" type="reset">Cancelar</button>
            </div>            
     </div>   
  
      
    
 </div>    
   
 
    {!!Form::close()!!}     
</div>
</div>            
    
<script>
   
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
    
@endsection