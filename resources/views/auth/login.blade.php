@extends('layouts.auth')

@section('htmlheader_title')
    Log in
@endsection

@section('content')
<body>
    <div class="mytop-content" >        
        <div class="container" > 
          
               
                <div class="col-sm-12 " style="background-color:rgba(0, 0, 0, 0.35); height: 60px; " >
                   <a class="mybtn-social pull-right" href="{{ url('/register')}}">
                       Registrar
                  </a>

                  <a class="mybtn-social pull-right" href="{{ url('/login')}}">
                       Login
                  </a>
               
                </div>
                <div class="col-sm-12 ">
                  @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <strong>Error!</strong>Error de Acceso<br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
               </div> 
            
            <div class="row">
              <div class="col-sm-6 col-sm-offset-3 myform-cont" >
                    <div class="myform-top">
                        <div class="myform-top-left">
                         <img  src="{{ url('img/ajota_mec.png') }}" class="img-responsive logo" />
                          <h3>Sistema Intranet AJ</h3> 
                            <p>Digita tu email y contraseña:</p>
                        </div>
                        <div class="myform-top-right">
                          <i class="fa fa-key"></i>
                        </div>
                    </div>
                    <div class="myform-bottom">

                      <form role="form" action="{{ url('/login') }}" method="post">
                       <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group">
                            <input type="text" name="email" value="{{old('email')}}" placeholder="Usuario..." class="form-control" id="form-username">
                        </div>
                        <div class="form-group">
                            <input type="password" name="password" placeholder="Contraseña..." class="form-control" id="form-password">
                        </div>
                        <button type="submit" class="mybtn">Entrar</button>
                      </form>

                    </div>
              </div>
            </div>
            <div class="row">
                <div class="col-sm-12 mysocial-login">
                    <h3>...Visitanos en nuestro Sitio Web...</h3>
                    <h1><strong>www.aj.cl</strong>.cl</h1>
                    
                </div>
            </div>
        </div>
      </div>

    <!-- Enlazamos el js de Bootstrap, y otros plugins que usemos siempre al final antes de cerrar el body -->
    <script src="{{ url('js/bootstrap.min.js') }}"></script>
</body>
@endsection

