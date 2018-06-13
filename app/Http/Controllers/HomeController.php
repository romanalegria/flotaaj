<?php

/*
 * Taken from
 * https://github.com/laravel/framework/blob/5.2/src/Illuminate/Auth/Console/stubs/make/controllers/HomeController.stub
 */

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Incidencia_Ssgg;
use Illuminate\Support\Facades\Auth;
use DB;
use Carbon\Carbon;

/**
 * Class HomeController
 * @package App\Http\Controllers
 */
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return Response
     */
    public function index()
    {
        //cargamos las solicitudes pendientes de un jefe de area por autorizar
        //id usuario
        //$idJefe=Auth::User()->idJefe;
        $tipoJefe=Auth::User()->idrol; 
        $idU=Auth::User()->id;
     
      
        if ($tipoJefe == 2 || $tipoJefe == 1) //Jefes de areas
        {
            $idJefe=DB::table('fnd_jefe_area as f')
                ->join('users as u','u.id','=','f.idUser')
                ->select('f.id')
                ->where('u.id','=',$idU)->first();
               
            
            //dd($idJefe->id);
            //vamo a buscar los datos
            // $misSolicitudes=DB::table('fnd_solicitud as a')
            // ->join('users as t','a.id_solicitante','=','t.id')        
            // ->select('a.id','t.name', 'a.monto_solicitado','a.proyecto','a.codigoSap')   
            // ->where('a.estado','=',0)                              
            // ->orderBy('a.id','desc')
            // ->paginate(7);


            //Solicitudes de fondos
            $dateActual = Carbon::now(); 

            $misSolicitudes=DB::table('users as u')
             ->join('fnd_solicitud as s','s.id_solicitante','=','u.id')
            ->select('s.id','u.name', 's.monto_solicitado','s.proyecto','s.codigoSap','s.fecha_solicitud','s.idAreaNegocio')
            ->where('u.idJefe','=',$idJefe->id) 
            ->Where('s.estado','=',0)
            ->where('fecha_solicitud','<=',$dateActual)
            ->orderBy('s.id','asc')->get()->all();
            //->paginate(5);

            //Rendiciones de fondos
             $misRendiciones=DB::table('fnd_rendicion_cabecera as c')
            ->leftjoin('users as u', 'c.usuario','=','u.id')
            ->leftjoin('fnd_rendicion_detalle as r','c.id_rendicion','=','r.id_rendicion')
            ->select('c.id_rendicion','c.fecha','u.name','c.proyecto','c.nombreProyecto','c.nSolicitud',DB::raw('sum(r.monto) as rendido'))
            ->where('u.idJefe','=',$idJefe->id)
            ->orderBy('c.id_rendicion','asc')
             ->groupBy('c.id_rendicion','c.fecha','u.name','c.proyecto','c.nombreProyecto','c.nSolicitud')->get()->all();
            //->paginate(5)


            $solicitudes = count($misSolicitudes);
            $rendiciones = count($misRendiciones);


            //validamos que no tenga 0 elementos los array
             if (empty($solicitudes) || empty($rendiciones))
             {                
                 return view("vacias.sinSolicitudes",["solicitudes"=>$solicitudes,"rendiciones"=>$rendiciones]);
             }


                   


             //vamos a cargar el nombre de cada proyecto
            foreach($misSolicitudes as $proy)
             {
               $nombreProyecto = DB::connection('sqlsrv')->select("select PrjCode,PrjName from OPRJ WHERE PrjCode=?",[$proy->proyecto]);
                $nProyectos[] = $nombreProyecto;

             }

             if (count($nProyectos)==0)
              {
                 $nProyectos = array (
                    'PrjCode' => 0,
                    'PrjName' => 0,
                 );
             }



              foreach ($nProyectos as $key => $value)
            {
                foreach ($misSolicitudes as $key2 => $value2) 
                {
                    if (isset($value2->proyecto) && isset($value[0]->PrjCode))
                    {
                        if ($value2->proyecto == $value[0]->PrjCode)
                        {
                            $misSolicitudes[$key]->nombreProyecto = $value[0]->PrjName;
                            
                        }
                    }
                }
            }


            //vamos a calcular el total de gastos de proyecto desde SAP
            foreach($misSolicitudes as $tproy)
             {
               $totalProyecto = DB::connection('sqlsrv')->select("select JDT1.project, sum(debit-credit) as Saldo from jdt1
              where substring(account,1,1) in (5,6) and JDT1.project=? group by JDT1.project",[$tproy->proyecto]);
                $tProyectos[] = $totalProyecto;

             }

             //dd($tProyectos);

             if (count($tProyectos) == 0)
             {
                    $sProyectos = array(
                    'project' => 0,                    
                    'saldo' => 0,
                ); 
             }

             

            foreach ($tProyectos as $key => $value)
            {
                foreach ($misSolicitudes as $key2 => $value2) 
                {
                    if (isset($value2->proyecto) && isset($value[0]->project))
                    {
                        if ($value2->proyecto == $value[0]->project)
                        {
                            $misSolicitudes[$key]->totalProyecto = $value[0]->Saldo;                            
                        }
                    }
                }
            }

            

            //vamos a cargar todo lo solicitado a ese proyecto desde Sap
             foreach($misSolicitudes as $mis1)
             {
               $solicitadoProyecto = DB::connection('sqlsrv')->select("select sum(debit) as Solicitado,project as proyecto,account from jdt1 where account=? and  project=? group by project,account",['1-01-06-02-03',$mis1->proyecto]);
                   $sProyectos[] = $solicitadoProyecto; 
               

             }

            
          
             if (count($sProyectos) == 0)
             {
                    $sProyectos = array(
                    'Solicitado' => 0,
                    'project' => 0,
                    'account' => 0,
                ); 
             }            
          


            foreach ($sProyectos as $key => $value)
            {
                foreach ($misSolicitudes as $key2 => $value2) 
                {
                    if (isset($value2->proyecto) && isset($value[0]->proyecto))
                    {
                        if ($value2->proyecto == $value[0]->proyecto)
                        {
                            $misSolicitudes[$key]->Solicitado = $value[0]->Solicitado;
                            $misSolicitudes[$key]->account = $value[0]->account;
                        }
                    }
                }
            }
  
          

              //vamos a cargar todo lo solicitado por proyecto y area de negocio

             foreach($misSolicitudes as $mis3)
             {
               $solicitadoProyecto = DB::connection('sqlsrv')->select("select sum(debit) as Solicitado,project as proyecto,account,profitcode from jdt1 where account=? and  project=? and profitcode=? group by project,account,profitcode",['1-01-06-02-03',$mis3->proyecto,$mis3->idAreaNegocio]);
                   $sProyectosAN[] = $solicitadoProyecto; 
               

             }           

            foreach ($sProyectosAN as $key => $value)
            {
                foreach ($misSolicitudes as $key2 => $value2) 
                {
                    if (isset($value2->proyecto) && isset($value[0]->proyecto))
                    {
                        if ($value2->proyecto == $value[0]->proyecto)
                        {
                            $misSolicitudes[$key]->SolicitadoxAN = $value[0]->Solicitado;                           
                        }
                    }
                }
            }
            

           
             //vamos a el saldo de la persona al momento de generar la solicitud
            foreach($misSolicitudes as $mis2)
             {
               
               $solicitadoPersona = DB::connection('sqlsrv')->select("select sum(debit-credit) as Saldo, shortname,account from jdt1 where account=? and  shortname=?  group by account,shortname",['1-01-06-02-03',$mis2->codigoSap]);
                  $sPersonas[]= $solicitadoPersona;
 
                  
             }

             
             if (count($sPersonas)==0)
             {
                $sPersonas = array(
                    'Saldo' => 0,
                    'shortname' => 0,
                    'account' => 0,
                );   
             }

             foreach ($sPersonas as $key => $value)
            {
                foreach ($misSolicitudes as $key2 => $value2) 
                {
                    if (isset($value2->codigoSap) && isset($value[0]->shortname))
                    {
                        if ($value2->codigoSap == $value[0]->shortname)
                        {
                            $misSolicitudes[$key]->Saldo = $value[0]->Saldo;
                            
                        }
                    }
                }
            }   

            
           

            return view("home",["misSolicitudes"=>$misSolicitudes,"solicitado"=>$sProyectos,"solicitadop"=>$sPersonas,"misRendiciones"=>$misRendiciones,"solicitudes"=>$solicitudes,"rendiciones"=>$rendiciones]);    
            

            
        }elseif ($tipoJefe == 4) //Gerencia
        {
             $idJefe=DB::table('fnd_jefe_area as f')
                ->join('users as u','u.id','=','f.idUser')
                ->select('f.id')
                ->where('u.id','=',$idU)->first();
               
            //dd($idJefe);
            //vamo a buscar los datos
            // $misSolicitudes=DB::table('fnd_solicitud as a')
            // ->join('users as t','a.id_solicitante','=','t.id')        
            // ->select('a.id','t.name', 'a.monto_solicitado','a.proyecto','a.codigoSap')   
            // ->where('a.estado','=',0)                              
            // ->orderBy('a.id','desc')
            // ->paginate(7);

            //capturamos la fecha actual
            $dateActual = Carbon::now();   

            $misSolicitudes=DB::table('users as u')
             ->join('fnd_solicitud as s','s.id_solicitante','=','u.id')
             ->join('fnd_jefe_area as f','u.idJefe','=','f.id')
            ->select('s.id','u.name', 's.montoNuevo1','s.proyecto','s.codigoSap','f.nombreJefe','s.idAreaNegocio')            
            ->Where('s.estado','>',0)  
            ->Where('s.estado','<',3) 
            ->where('fecha_solicitud','<=',$dateActual)
            ->Where('s.codAutorizador2','=',null)  
            ->orderBy('s.id','asc')
            ->paginate(7);

             if (count($misSolicitudes)==0)
            {
                return view("vacias.sinSolicitudes");
            }   


            //vamos a cargar el nombre de cada proyecto
            foreach($misSolicitudes as $proy)
             {
               $nombreProyecto = DB::connection('sqlsrv')->select("select PrjCode,PrjName from OPRJ WHERE PrjCode=?",[$proy->proyecto]);
                $nProyectos[] = $nombreProyecto;

             }

             if (count($nProyectos)==0)
              {
                 $nProyectos = array (
                    'PrjCode' => 0,
                    'PrjName' => 0,
                 );
             }



              foreach ($nProyectos as $key => $value)
            {
                foreach ($misSolicitudes as $key2 => $value2) 
                {
                    if (isset($value2->proyecto) && isset($value[0]->PrjCode))
                    {
                        if ($value2->proyecto == $value[0]->PrjCode)
                        {
                            $misSolicitudes[$key]->nombreProyecto = $value[0]->PrjName;
                            
                        }
                    }
                }
            }


             //vamos a calcular el total de gastos de proyecto desde SAP
            foreach($misSolicitudes as $tproy)
             {
               $totalProyecto = DB::connection('sqlsrv')->select("select JDT1.project, sum(debit-credit) as Saldo from jdt1
                 where substring(account,1,1) in (5,6) and JDT1.project=? group by JDT1.project",[$tproy->proyecto]);
                $tProyectos[] = $totalProyecto;

             }

             if (count($tProyectos) == 0)
             {
                    $sProyectos = array(
                    'project' => 0,                    
                    'saldo' => 0,
                ); 
             }

             

            foreach ($tProyectos as $key => $value)
            {
                foreach ($misSolicitudes as $key2 => $value2) 
                {
                    if (isset($value2->proyecto) && isset($value[0]->project))
                    {
                        if ($value2->proyecto == $value[0]->project)
                        {
                            $misSolicitudes[$key]->totalProyecto = $value[0]->Saldo;                            
                        }
                    }
                }
            }
            

            //vamos a cargar todo lo solicitado a ese proyecto desde Sap
             foreach($misSolicitudes as $mis1)
             {
               $solicitadoProyecto = DB::connection('sqlsrv')->select("select sum(debit) as Solicitado,project,account from jdt1 where account=? and  project=? group by project,account ",['1-01-06-02-03',$mis1->proyecto]);
                    //array_push($sProyectos, $solicitadoProyecto);
                    $sProyectos[] = $solicitadoProyecto;

             }
             if (count($sProyectos)==0)
             {
                $$sProyectos = array(
                    'Solicitado' => 0,
                    'project' => 0,
                    'account' => 0,
                ); 
             }

            foreach ($sProyectos as $key => $value)
            {
                foreach ($misSolicitudes as $key2 => $value2) 
                {
                    if (isset($value2->proyecto) && isset($value[0]->proyecto))
                    {
                        if ($value2->proyecto == $value[0]->proyecto)
                        {
                            $misSolicitudes[$key]->Solicitado = $value[0]->Solicitado;
                            $misSolicitudes[$key]->account = $value[0]->account;
                        }
                    }
                }
            }


             //vamos a cargar todo lo solicitado por proyecto y area de negocio

             foreach($misSolicitudes as $mis3)
             {
               $solicitadoProyecto = DB::connection('sqlsrv')->select("select sum(debit) as Solicitado,project as proyecto,account,profitcode from jdt1 where account=? and  project=? and profitcode=? group by project,account,profitcode",['1-01-06-02-03',$mis3->proyecto,$mis3->idAreaNegocio]);
                   $sProyectosAN[] = $solicitadoProyecto; 
               

             }           

            foreach ($sProyectosAN as $key => $value)
            {
                foreach ($misSolicitudes as $key2 => $value2) 
                {
                    if (isset($value2->proyecto) && isset($value[0]->proyecto))
                    {
                        if ($value2->proyecto == $value[0]->proyecto)
                        {
                            $misSolicitudes[$key]->SolicitadoxAN = $value[0]->Solicitado;                           
                        }
                    }
                }
            }

             //vamos a el saldo de la persona al momento de generar la solicitud
            foreach($misSolicitudes as $mis2)
             {
               $solicitadoPersona = DB::connection('sqlsrv')->select("select sum(debit-credit) as Saldo, shortname,account from jdt1 where account=? and  shortname=? group by account,shortname ",['1-01-06-02-03',$mis2->codigoSap]);
                    //array_push($sPersonas, $solicitadoPersona);
                    $sPersonas[] = $solicitadoPersona;
             }          

             if (count($sPersonas)==0)
             {
                $sPersonas = array(
                    'Saldo' => 0,
                    'shortname' => 0,
                    'account' => 0,
                );   
             }

            foreach ($sPersonas as $key => $value)
            {
                foreach ($misSolicitudes as $key2 => $value2) 
                {
                    if (isset($value2->codigoSap) && isset($value[0]->shortname))
                    {
                        if ($value2->codigoSap == $value[0]->shortname)
                        {
                            $misSolicitudes[$key]->Saldo = $value[0]->Saldo;
                            
                        }
                    }
                }
            }   

            return view("home",["misSolicitudes"=>$misSolicitudes,"solicitado"=>$sProyectos,"solicitadop"=>$sPersonas]);  

        } else
        {
            return view("home");    
        }
       
       
         //$incidencias=DB::table('incidencia_ssgg as a')
         //   ->select('a.id','a.sucursal','a.severidad','a.asignado','a.resumen','a.descripcion','a.fecha_creacion','a.fecha_cierre')  
         //   ->where('a.fecha_cierre')
         //   ->orderBy('id','desc')
         // ->paginate(7);

        
        //return view("home");
        
        
    }
}