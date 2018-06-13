@extends('layouts.app')

@section('htmlheader_title')
    Encargados
@endsection

<script>
function EventoAlert() {
swal(
     'Registro modificado con exito',
    'Presione el boton OK!',
    'success'
    )
}
    
</script>


@section('main-content')
<div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <h3>Editar Tope: {{ $tope->concepto}}</h3>
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
 {!!Form::model($tope,['method'=>'PUT','route'=>['topes.update',$tope->id,$tope->codigozona,$tope->subconcepto,$tope->concepto],'files'=>'true'])!!}
 {{Form::token()}}
     

   <div class="row">
     <div class="col-lg-4 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
                <label>Zonas</label>
                <select name="zona" class="form-control">
                    @foreach ($zonas as $zon)
                        @if ($zon->codigo == $tope->codigozona)
                            <option value="{{$zon->codigo}}" selected>{{$zon->nombre}}</option>
                        @else
                            <option value="{{$zon->codigo}}">{{$zon->nombre}}</option>
                        @endif
                    @endforeach
                </select>
            </div>
      </div>

        <div class="col-lg-4 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
                <label>Concepto</label>
                <select name="concepto" class="form-control">                    
                    @foreach ($conceptos as $con)
                        @if ($con->id == $tope->concepto)
                            <option value="{{$con->id}}" selected>{{$con->concepto}}</option>
                        @else
                            <option value="{{$con->id}}">{{$con->concepto}}</option>
                        @endif
                    @endforeach
                </select>
            </div>
        </div>

    </div>

    <div class="row">
        <div class="col-lg-4 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
                <label>Detalle</label>
                <select name="subconcepto" class="form-control">
                    <option value=0>SIN SUB CONCEPTO</option>
                    @foreach ($gastos as $gas)
                        @if ($gas->id == $tope->subconcepto)
                            <option value="{{$gas->id}}" selected>{{$gas->detalle}}</option>
                        @else
                            <option value="{{$gas->id}}">{{$gas->detalle}}</option>
                        @endif
                    @endforeach
                </select>
            </div>
      </div>
       <div class="col-lg-4 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
                <label>Autorización</label>
                <select name="autoriza" class="form-control">
                        
                        @if ($tope->autoriza == 0)
                            <option value=0 selected>NO AUTORIZA</option>
                            <option value=1>SI AUTORIZA</option>
                        @else
                            <option value=1>SI AUTORIZA</option>
                            <option value=0 selected>NO AUTORIZA</option>
                        @endif
                    
                </select>
            </div>
      </div>
    </div>

      <div class="row">
        <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
            <div class="form-group">
                <label for="monto">monto</label>
                <input type="text"  name="monto" required value="{{$tope->tope}}" class="form-control">
            </div>
        </div>
    </div>
    
   
    <div class="row">
            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                <button class="btn btn-primary" type="submit" onclick="EventoAlert();"">Guardar</button>
                <button class="btn btn-danger" type="reset">Cancelar</button>
            </div>
     </div>   
    {!!Form::close()!!}     
            
    
@endsection