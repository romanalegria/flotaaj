@extends('layouts.auth')

@section('htmlheader_title')
    Registrar
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
            <div class="row">
              <div class="col-sm-6 col-sm-offset-3 myform-cont" >
                    <div class="myform-top">
                        <div class="myform-top-left">
                          <img  src="{{ url('img/ajota_mec.png')}}" class="img-responsive logo" />
                          <h3>Regístro en plataforma AJ</h3>
                            <p>Ingre datos del usuario</p>
                        </div>
                        <div class="myform-top-right">
                          <i class="fa fa-user"></i>
                        </div>
                    </div>

                     <div class="col-sm-12 ">
                          @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <strong>Error!</strong>Error al Registrar<br><br>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                          @endif
                     </div> 
                    <div class="myform-bottom">
                      
                      <form role="form" action="{{url('/register')}}" method="post" class="">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group">
                            <input type="text" name="name" placeholder="Nombres..." class="form-control" id="form-firtsname" value="{{old('name')}}">
                        </div>
                     
                        <div class="form-group">
                            <input type="text" name="email" placeholder="Email..." class="form-control" id="form-email" value="{{old('email')}}">
                        </div>



                        <div class="form-group">
                            <input type="password" name="password" placeholder="Password..." class="form-control" id="form-password">
                        </div>


                         <div class="form-group">
                            <input type="password" name="password_confirmation" placeholder="Password..." class="form-control" id="form-password">
                        </div>

                        <div class="form-group">
                            <input type="text" name="codigo_sap" placeholder="codigo SAP" class="form-control" id="form-codigosap">
                        </div>

                        <button type="submit" class="mybtn">Registrarme</button>
                      </form>
                    </div>
              </div>
            </div>
            <div class="row">
             <div class="col-sm-12 mysocial-login">
                    <h3>...Visitanos en nuestro blog...</h3>
                    <h1><strong>AJ</strong>.CL</h1>
                    
                </div>
            </div>
        </div>
      </div>

    <!-- Enlazamos el js de Bootstrap, y otros plugins que usemos siempre al final antes de cerrar el body -->
    <script src="{{ url('js/bootstrap.min.js') }}"></script>
  </body>
@endsection
