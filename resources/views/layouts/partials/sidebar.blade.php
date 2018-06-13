<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        @if (! Auth::guest())
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="{{asset('/img/user2-160x160.jpg')}}" class="img-circle" alt="User Image" />
                </div>
                <div class="pull-left info">
                    <p>{{ Auth::user()->name }}</p>
                    <!-- Status -->
                    <a href="#"><i class="fa fa-circle text-success"></i> {{ trans('adminlte_lang::message.online') }}</a>
                </div>
            </div>
        @endif

        <!-- search form (Optional) -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="{{ trans('adminlte_lang::message.search') }}..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
        </form>
        <!-- /.search form -->
        <!-- Sidebar Menu separado -->
         <ul class="sidebar-menu">
            @if (\Auth::user()->idrol == 2 || \Auth::user()->idrol == 3 || \Auth::user()->idrol == 4 || \Auth::user()->idrol == 5)  <!-- jefe de area - gerencia - coordinadores - trabajadores  -->
                <li class="header">{{ trans('adminlte_lang::message.header') }}</li>
                <!-- Optionally, you can add icons to the links -->
                <li class="active"><a href="{{ url('home') }}"><i class='fa fa-home fa-lg'></i> <span>&nbsp; {{ trans('adminlte_lang::message.home') }}</span></a></li>
                
                 <li class="treeview">
                    <a href="#"><i class='fa fa-usd fa-lg'></i> <span>&nbsp; Rendiciones de fondos</span> <i class="fa fa-angle-left pull-right"></i></a>
                    <ul class="treeview-menu">
                        <li><a href="/rendiciones/solicitudes"><i class="fa fa-pencil"></i>Crear solicitud de fondos</a></li>                        
                        <li><a href="{{url('rendiciones/solicitudes/'.Auth::User()->id.'/misSolicitudesRendir')}}"><i class="fa fa-pencil"></i>Rendir fondos</a></li>
                        
                        <li><a href="#"><i class="fa fa-pencil"></i>Informes</a></li>
                    </ul>
                </li>
                 <li class="treeview">
                    <a href="#"><i class='fa fa-ticket fa-lg'></i> <span>&nbsp; Ticket</span> <i class="fa fa-angle-left pull-right"></i></a>
                    <ul class="treeview-menu">
                        <li><a href="/flota/vehiculo/mantencion"><i class="fa fa-pencil"></i>Gestionar Mantención Vehículo</a></li>
                        <li><a href="/Tickets/ssgg"><i class="fa fa-pencil"></i>Gestionar SS. GG.</a></li>
                       
                    </ul>
                </li>
            @endif <!-- fin jefe de area-->
         </ul>><!-- Sidebar Menu separado -->
        <!-- Sidebar Menu -->    
        @if (Auth::User()->idrol == 1 ) 
         <!-- Sidebar Menu -->

        <ul class="sidebar-menu">
            <li class="header">{{ trans('adminlte_lang::message.header') }}</li>
            <!-- Optionally, you can add icons to the links -->
            <li class="active"><a href="{{ url('home') }}"><i class='fa fa-home fa-lg'></i> <span>&nbsp; {{ trans('adminlte_lang::message.home') }}</span></a></li>
            
             <li class="treeview">
                <a href="#"><i class='fa fa-usd fa-lg'></i> <span>&nbsp; Rendiciones de fondos</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="/rendiciones/solicitudes"><i class="fa fa-pencil"></i>Crear solicitud de fondos</a></li>
                    
                    <li><a href="{{url('rendiciones/solicitudes/'.Auth::User()->id.'/misSolicitudesRendir')}}"><i class="fa fa-pencil"></i>Rendir fondos</a></li>                  
                    
                    <li><a href="#"><i class="fa fa-pencil"></i>Informes</a></li>
                </ul>
            </li>

             <li class="treeview">
                <a href="#"><i class='fa fa-car fa-lg'></i> <span>&nbsp; Vehículos</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="/flota/vehiculo"><i class="fa fa-pencil"></i>Listado</a></li>
                    <li><a href="/flota/vehiculo/documentos"><i class="fa fa-pencil"></i>Documentación</a></li>
                    <li><a href="/asignaciones"><i class="fa fa-pencil"></i>Asignaciones/Devoluciones</a></li>
                    <li><a href="/arriendos"><i class="fa fa-pencil"></i>Control Arriendo Ocacional</a></li>

                </ul>
            </li>
              <li class="treeview">
                <a href="#"><i class='fa fa-briefcase fa-lg'></i> <span>&nbsp; Servicios</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="#"><i class="fa fa-calendar"></i>Bitacora</a></li>
                    <li><a href="/Servicios/Mantenciones"><i class="fa fa-pencil"></i>Tabla Mantenciones</i></a></li>
                    <li><a href="#"><i class="fa fa-pencil"></i></a></li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#"><i class='fa fa-th-large fa-lg'></i> <span>&nbsp;Maestros</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="/maestros/areas"><i class="fa fa-pencil"></i>Area de Negocios</a></li>
                    <li><a href="/maestros/encargados"><i class="fa fa-pencil"></i>Encargados </a></li>   
                    <li><a href="/maestros/estados"><i class="fa fa-pencil"></i>Estados Vehículo</a></li>  
                    <li><a href="/maestros/categorias"><i class="fa fa-pencil"></i>Categorías</a></li>  
                    <li><a href="/maestros/flotas"><i class="fa fa-pencil"></i>Tipo Flota</a></li>  
                    <li><a href="/maestros/documentos"><i class="fa fa-pencil"></i>Tipo Documento</a></li>  
                    <li><a href="/maestros/cargos"><i class="fa fa-pencil"></i>Cargos</a></li>
                    <li><a href="/maestros/zonas"><i class="fa fa-pencil"></i>Zonas</a></li>
                    <li><a href="/maestros/gastos"><i class="fa fa-pencil"></i>Tipo Gasto</a></li>
                    <li><a href="/maestros/topes"><i class="fa fa-pencil"></i>Topes Gastos</a></li>
                </ul>
            </li>

             <li class="treeview">
                <a href="#"><i class='fa fa-ticket fa-lg'></i> <span>&nbsp; Ticket</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="/flota/vehiculo/mantencion"><i class="fa fa-pencil"></i>Gestionar Mantención Vehículo</a></li>
                    <li><a href="/Tickets/ssgg"><i class="fa fa-pencil"></i>Gestionar SS. GG.</a></li>
                   
                </ul>
            </li>

            <li class="treeview">
                <a href="#"><i class='fa fa-user fa-lg'></i> <span>&nbsp; Administraciòn</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="/maestros/usuarios"><i class="fa fa-users"></i>Usuarios</a></li>
                                       
                </ul>
            </li>



        </ul><!-- /.sidebar-menu -->
        @endif<!-- fin sidebar-menu adminiostrador -->
    </section>
    <!-- /.sidebar -->
</aside>
