@extends('layouts.app')

@section('content')
  <section class="content">
    <div class="error-page">
      <h2 class="headline text-red">500</h2>
      <div class="error-content">
        <h3><i class="fa fa-warning text-red"></i> Oops! su sesión a espirado</h3>
        <p>
          Por seguridad su sesión a terminado por favor vuelva a ingresar sus credenciales
          Link para acceso <a href="{{route('/')}}">Volver a la página principal</a>.
        </p>
      </div>
    </div><!-- /.error-page -->
  </section><!-- /.content -->
@stop
