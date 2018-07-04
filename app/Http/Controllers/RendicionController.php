<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use App\Area;
use App\User;
use App\Solicitud;
use App\RendicionMotivo;
use App\solicitudMotivo;
use App\Rendicion;
use App\Zona;
use App\Mail\GeneraIncidencia;
use App\CabezeraRendicion;
use App\DetalleRendicion;
use App\DetalleRendicionPaso;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\SolicitudRequest;
use App\Http\Requests\RendicionRequest;
use Carbon\Carbon;
use Mail;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Storage;
use DB;
use Validator;

class RendicionController extends Controller
{
     public function __construct()
    {
       
    }


    public function index(Request $request)
    {
    	
    	//cargamos el usuario logeado
         $idLog=Auth::User()->id; 
         $nombre=Auth::User()->name;
         $codigoSap=Auth::User()->codigoSap;
         $idCoor=Auth::User()->idcoo;
         $bloqueado=Auth::User()->bloqueado;
              	
    	//accedemos a la conexion e sql para traer los proyectos
    	$proyectos = DB::connection('sqlsrv')->select("select PrjCode,PrjName,Active from OPRJ WHERE Active='Y' ORDER BY PrjCode");

        //cargamos la tabla para el tipo de solictud a rendir pueden ser varios motivos
        $tiposolitudes =DB::table('fnd_tipo_solicitud')->where('id','>','0')->get();
    	//areas de negocio
    	$areas=Area::all();
        //cargamos los trabajadores bajo el codigo del coordinador
        $trabajadores =DB::table('users')->where('idcoo','=',$idLog)->get();

        //obtenemos el objeto DetalleRendicionPaso        
        $datos=DetalleRendicionPaso::all();    

        if ($bloqueado == 0) {
            return view('rendiciones.solicitudes.solicitud',["areas"=>$areas,"proyectos"=>$proyectos,"codigoSap"=>$codigoSap,"nombre"=>$nombre,"id"=>$idLog,"tiposolicitudes"=>$tiposolitudes,"trabajadores"=>$trabajadores,"idCoor"=>$idCoor]);
        }else
        {
            return view('vacias.sinAutorizacion');
        }
         
       
    }

    public function indexRendicion(Request $request)
    {
        //cargamos el usuario logeado
         $idLog=Auth::User()->id; 
         $nombre=Auth::User()->name;
         $codigoSap=Auth::User()->codigoSap;


         //cargamos las zonas para topes de consumo
         $zonas = Zona::all();

          //cargamos la tabla para el tipo de solictud a rendir pueden ser varios motivos
         $tiposolitudes =DB::table('fnd_tipo_solicitud')->where('id','>','0')->get();

         //accedemos a la conexion e sql para traer los proyectos
        $proyectos = DB::connection('sqlsrv')->select("select PrjCode,PrjName,Active from OPRJ WHERE Active='Y' ORDER BY PrjCode");

       

        return view('rendiciones.rendiciones.Rendicion',["codigoSap"=>$codigoSap,"nombre"=>$nombre,"id"=>$idLog,"tiposolicitudes"=>$tiposolitudes,"proyectos"=> $proyectos,"zonas"=>$zonas]);         
    }

    public function rendi3($id)
    {
        //cargamos el usuario logeado
         $idLog=Auth::User()->id; 
         $nombre=Auth::User()->name;
         $codigoSap=Auth::User()->codigoSap;


         //cargamos las zonas para topes de consumo
         $zonas = Zona::all();

          //cargamos la tabla para el tipo de solictud a rendir pueden ser varios motivos
         $tiposolitudes =DB::table('fnd_tipo_solicitud')->where('id','>','0')->get();

         //accedemos a la conexion e sql para traer los proyectos
        $proyectos = DB::connection('sqlsrv')->select("select PrjCode,PrjName,Active from OPRJ WHERE Active='Y' ORDER BY PrjCode");

        return view('rendiciones.rendiciones.RendicionV3',["codigoSap"=>$codigoSap,"nombre"=>$nombre,"id"=>$idLog,"tiposolicitudes"=>$tiposolitudes,"proyectos"=> $proyectos,"zonas"=>$zonas]);         
    }


    public function CargarSolicitud($id)
    {
        dd($id);
    }


    public function store (SolicitudRequest $request)
    {
    	$date = Carbon::now();
        $dateOriginal = Carbon::now();
       
       $h13_01 = Carbon::createFromTime(13, 01, 00, 'America/Santiago');
       $h23_59 = Carbon::createFromTime(23, 59, 00, 'America/Santiago');
       //$meeting = Carbon::createFromTime(19, 15, 00, 'Africa/Johannesburg'); ejemplo sacado de internet
        //$00_00 = Carbon::createFromTime(13, 01);
        //$13_00 = Carbon::createFromTime(13, 00);


         if($date >= $h13_01 && $date <= $h23_59)
         {
             $date = Carbon::now()->addDay(1);
         }

        $solicitud=new Solicitud;
        $solicitud->fecha_solicitud= $date->format('Y/m/d');
        $solicitud->horaSolicitud= $date->toTimeString();
        $solicitud->fechaRealSolicitud= $dateOriginal->format('Y/m/d');
        //validamos que la solcitud la esta haciendo un coordinador para un tercero
        if(isset($_POST["tercero"]))
        {
            $solicitud->coordinador= strtoupper($request->get('id_solicitante'));        
            $solicitud->id_solicitante= strtoupper($request->get('tercero'));            
         }else
         {
            $solicitud->id_solicitante= strtoupper($request->get('id_solicitante'));
         }

        //$solicitud->id_solicitante= strtoupper($request->get('id_solicitante'));
        $solicitud->monto_solicitado=$request->get('monto_solicitado');
        $solicitud->estado=0;
        $solicitud->proyecto=strtoupper($request->get('proyecto'));
        //vamos a burcar el nombre del proyecto
        $nombreProyecto = DB::connection('sqlsrv')->select("select PrjCode,PrjName from OPRJ WHERE PrjCode=?",[strtoupper($request->get('proyecto'))]);       

        $nProyecto = $nombreProyecto[0]->PrjName;
        $solicitud->nombreProyecto = $nombreProyecto[0]->PrjName;
        $solicitud->idAreaNegocio=$request->get('area');
        //si es solicitud para un tercero debemos ir a buscar su codigo sao
        if(isset($_POST["tercero"]))
        {
            //vamos a buscar su codigo sap
            $codigosap= DB::table('users as a')
                    ->select('a.codigoSap')
                    ->where('id','=', $request->get('tercero'))->first();
         

            $solicitud->codigoSap=$codigosap->codigoSap; 
        }else{
            $solicitud->codigoSap=strtoupper($request->get('codigoSap'));

        }

       
      //dd($codigosap);

        if ($solicitud->save()) {
             //obtenemos el ID la solicitud Grabada
            $id_solicitud = Solicitud::orderBy('id','desc')->first()->id;

             //recorremos el arreglo concepto para grabar cada linea            
            foreach($request->concepto as $con){
                $concepto=new SolicitudMotivo;
                $concepto->idSolicitud = $con[0];

                //vamos buscar el nombre del motivo
                $motivos= DB::table('fnd_tipo_solicitud as a')
                    ->select('a.concepto')
                    ->where('id','=',$con[0])->first();

                
                $concepto->nombreMotivo =strtoupper($motivos->concepto);
                $concepto->fechaSolicitud=$date->format('Y/m/d');             
                $concepto->idUsuario=strtoupper($request->get('id_solicitante'));
                $concepto->nroSolicitud=$id_solicitud;

                $concepto->save();
             }
            //generamos el codigo para el envio del correo a Gerencia para su autoriacion de fondos
            //primero buscamos el id del jefe en tabla usuario


              //validamos si la solicitud es para un tercero
              if(isset($_POST["tercero"]))
               {
                    $idJefe= DB::table('users as a')
                    ->select('a.name','a.email','a.idJefe')
                    ->where('id','=', $request->get('tercero'))->first();            
               }else
               {
                    $idJefe= DB::table('users as a')
                    ->select('a.name','a.email','a.idJefe')
                    ->where('id','=', $request->get('id_solicitante'))->first();        
               }


            

            //vamos a rescatar el mail de jefe del usuario
            $mailJefe = DB::table('fnd_jefe_area as a')
                        ->select('a.nombreJefe','a.correoJefe')
                        ->where('id','=',$idJefe->idJefe)->first();

            
             //obtenmos los datos de de motivos de la ultima solicitud
            $conceptos= DB::table('fnd_solicitud_motivo as a')
                        ->select('a.idSolicitud','a.nombreMotivo')
                        ->where('nroSolicitud','=',$id_solicitud)->get()->all();
             
             
            //obtenemos el nombre del proyecto para mostrar en correo de solicitud
            //$nombreProyecto = DB::connection('sqlsrv')->select("select PrjName from OPRJ WHERE PrjCode=?",[$request->get('proyecto')]);
            
           //dd($nombreProyecto->PrjName);
             
             //$fromEmail = $idJefe->email;
             //$fromName = $idJefe->name;
             //$toEmail = $mailJefe->correoJefe;
             //$toName = $mailJefe->nombreJefe;
             

             //para pruebas de correo solo para eroman
             $fromEmail = 'eroman@aj.cl';
             $fromName =  $idJefe->name;
             $toEmail = 'eroman@aj.cl';
             $toName = 'emilio roman';
            

              Mail::send('Mail.Solicitud',["nombre"=>$fromName,"proyecto"=>$request->get('proyecto'),"monto"=>$request->get('monto_solicitado'),"conceptos"=>$conceptos,"nombreProyecto"=>$nProyecto], function ($message) use($fromEmail,$fromName,$toEmail,$toName) {
                 $message->from($fromEmail, $fromName);
                 $message->sender($fromEmail, $fromName);
                 $message->to($toEmail, $toName);   
                 $message->cc($fromEmail, $fromName);                               
                 $message->subject('Solicitud de fondos a rendir');
                 $message->priority(3);
                 //$message->attach('pathToFile');
             }); 

            
           

           return Redirect::to('rendiciones/solicitudes');
        }
   
        //return Redirect::to('rendiciones/solicitudes');

    }


    public function eliminarFilaPaso($id, Request $request)
    {
        $filaPaso=DetalleRendicionPaso::findOrFail($id);
        if($filaPaso->delete())
        {
            $jsondata['status'] = true;
            $jsondata['message'] = 'Movimiento eliminado con éxito Nº' . ' '.  $id;

             if ($request->ajax())
              {
                return $jsondata['message'];
              }
        }      
     
    }

    public function editarFilaPaso($id,Request $request)
    {
        $filaPaso=DetalleRendicionPaso::findOrFail($id);

        if($filaPaso)
        {
            $jsondata['status'] = true;
            $jsondata['message'] = 'Movimiento editado con éxito Nº' . ' '.  $id;

             if ($request->ajax())
              {
                return $jsondata['message'];
              }
        }      

		
    }

    public function storeRendicionDosV2(Request $request)
    {
        $date = Carbon::now();       
        $fila = 0;
           
        
        try 
        {
          if ($request->isMethod('post')) 
          {            

           DB::beginTransaction();
           $cabecera = new CabezeraRendicion;
           $cabecera->fecha= $date->format('Y/m/d'); 
           $cabecera->usuario =$request->get('id_solicitante');
           $cabecera->proyecto=strtoupper($request->get('proyecto'));
           $cabecera->nombreProyecto=strtoupper($request->get('nombreProyecto'));
           $cabecera->nSolicitud = $request->get('id_solicitud');
           $cabecera->totalRendido=0;           
                     
           
           if($cabecera->save())
           {
             //obtenemos el ultimo numero de cabeceta de rendicion almacenado
            $id_rendicion = CabezeraRendicion::orderBy('id_rendicion','desc')->first()->id_rendicion;
            //vamos a buscar el detalle de la rendicion de paso
            $data = DetalleRendicionPaso::where("numeroSolicitud","=",$request->get('id_solicitud'))->get();

            

           foreach($data as $arr)                
           {
               $fila = $fila + 1;
               //\Log::info($data);
               $detalle = new DetalleRendicion;  
               $detalle->id_rendicion = $id_rendicion;
               $detalle->fila = $fila;
               $detalle->codigoZona = $arr->codigoZona;
               $detalle->tipoDocumento = $arr->tipoDocumento;;
               $detalle->numeroDocumento = $arr->numeroDocumento;
               $detalle->fechaDocumento = $arr->fechaDocumento;
               $detalle->codigoGasto = $arr->codigoGasto;
               if($arr->codigoDetalle == '')
               {
                   $arr->codigoDetalle = 0;
               }
               $detalle->codigoDetalle = $arr->codigoDetalle;
               $detalle->monto = $arr->monto;
               $detalle->observaciones = $arr->observaciones;
               //$detalle->foto = $arr->foto;
               if($arr->dias == '')
               {
                   $arr->dias = 0;
               }
               $detalle->dias = $arr->dias;

               //almacenar el nombre foto de la linea
              $detalle->foto = $arr->foto;
              
               
               if(!$detalle->save())
               {
                   DB::rollback();
                           
               }           
          
           }   //foreach  

            DB::commit();

            //preparando el correo para ser enviado al jefe directoy autorice la rendición
              //vamos a rescatar el mail de jefe del usuario
           $idJefe= DB::table('users as a')
                   ->select('a.name','a.email','a.idJefe')
                   ->where('id','=', $request->get('id_solicitante'))->first();

           $mailJefe = DB::table('fnd_jefe_area as a')
                       ->select('a.nombreJefe','a.correoJefe')
                       ->where('id','=',$idJefe->idJefe)->first();

           
            
            
            
           //obtenemos el nombre del proyecto para mostrar en correo de solicitud
           $nameProyecto = DB::connection('sqlsrv')->select("select PrjName from OPRJ WHERE PrjCode=?",[$request->get('proyecto')]);
           $nProyecto = $nameProyecto[0]->PrjName;            
          
            
            //$fromEmail = $idJefe->email;
            //$fromName = $idJefe->name;
            //$toEmail = $mailJefe->correoJefe;
            //$toName = $mailJefe->nombreJefe;
            

            //para pruebas de correo solo para eroman
            $fromEmail = 'eroman@aj.cl';
            $fromName =  $idJefe->name;
            $toEmail = 'eroman@aj.cl';
            $toName = 'emilio roman';
           

             Mail::send('Mail.Rendicion',["nombre"=>$fromName,"proyecto"=>$request->get('proyecto'),"numero"=>$id_rendicion,"nombreProyecto"=>$nProyecto], function ($message) use($fromEmail,$fromName,$toEmail,$toName) {
                $message->from($fromEmail, $fromName);
                $message->sender($fromEmail, $fromName);
                $message->to($toEmail, $toName);   
                $message->cc($fromEmail, $fromName);                               
                $message->subject('Rendición de fondos');
                $message->priority(3);
                //$message->attach('pathToFile');
            }); 

            //limpiar base de paso y volver fila a 0
            $fila = 0;
            $data = DetalleRendicionPaso::where("numeroSolicitud","=",$request->get('id_solicitud'));
            $data->delete();

           } //if cabecera-save()
       } //if request-method
           

          
          
        } catch (Exception $e)
         {
             DB::rollback();
        }      

        $notificacion = array (
            'message' => 'Rendición de fondos creada con exitò',
            'alert-type' => 'success'
         );

        return response()->json($notificacion);

        //return Redirect::to('rendiciones/solicitudes')->with($notificacion);
        

       //return Redirect::to('Rendiciones/rendiciones');      
           
    }


    public function storeRendicionDos(Request $request)
    {
         $date = Carbon::now();       
              
         try 
         {
           if ($request->isMethod('post')) 
           {
          

             DB::beginTransaction();
            $cabecera = new CabezeraRendicion;
            $cabecera->fecha= $date->format('Y/m/d'); 
            $cabecera->usuario =$request->get('id_solicitante');
            $cabecera->proyecto=strtoupper($request->get('proyecto'));
            $cabecera->nombreProyecto=strtoupper($request->get('nombreProyecto'));
            $cabecera->nSolicitud = $request->get('id_solicitud');
            $cabecera->totalRendido=0;
            
            if($cabecera->save())
            {
                //obtenemos el ultimo numero de cabeceta de rendicion almacenado
             $id_rendicion = CabezeraRendicion::orderBy('id_rendicion','desc')->first()->id_rendicion;

             $data = json_decode($_POST['array']);                        
             //\Log::info($data);
            foreach($data as $arr)                
            {
                //\Log::info($data);
                $detalle = new DetalleRendicion;  
                $detalle->id_rendicion = $id_rendicion;
                $detalle->fila = $arr->filaa;
                $detalle->codigoZona = $arr->zona;
                $detalle->tipoDocumento = $arr->tipoDocumento;;
                $detalle->numeroDocumento = $arr->numeroDocumento;
                $detalle->fechaDocumento = $arr->fechaDocumento;
                $detalle->codigoGasto = $arr->tipoGasto;
                if($arr->detalleGasto == '')
                {
                    $arr->detalleGasto = 0;
                }
                $detalle->codigoDetalle = $arr->detalleGasto;
                $detalle->monto = $arr->monto;
                $detalle->observaciones = $arr->observaciones;
                //$detalle->foto = $arr->foto;
                if($arr->dias == '')
                {
                    $arr->dias = 0;
                }
                $detalle->dias = $arr->dias;

                //almacenar la foto de la linea
                if (Input::hasFile($arr->foto))
                {
                    $file=Input::file($arr->foto);
                    $file->move(public_path().'/imagenes/rendiciones/',$file->getClientOriginalName());
                    $detalle->foto=$file->getClientOriginalName();
                }
               
                
                if(!$detalle->save())
                {
                    DB::rollback();
                            
                }           
           
            }   //foreach  

             DB::commit();

             //preparando el correo para ser enviado al jefe directoy autorice la rendición
               //vamos a rescatar el mail de jefe del usuario
            $idJefe= DB::table('users as a')
                    ->select('a.name','a.email','a.idJefe')
                    ->where('id','=', $request->get('id_solicitante'))->first();

            $mailJefe = DB::table('fnd_jefe_area as a')
                        ->select('a.nombreJefe','a.correoJefe')
                        ->where('id','=',$idJefe->idJefe)->first();

            
             
             
             
            //obtenemos el nombre del proyecto para mostrar en correo de solicitud
            $nameProyecto = DB::connection('sqlsrv')->select("select PrjName from OPRJ WHERE PrjCode=?",[$request->get('proyecto')]);
            $nProyecto = $nameProyecto[0]->PrjName;            
           
             
             //$fromEmail = $idJefe->email;
             //$fromName = $idJefe->name;
             //$toEmail = $mailJefe->correoJefe;
             //$toName = $mailJefe->nombreJefe;
             

             //para pruebas de correo solo para eroman
             $fromEmail = 'eroman@aj.cl';
             $fromName =  $idJefe->name;
             $toEmail = 'eroman@aj.cl';
             $toName = 'emilio roman';
            

              Mail::send('Mail.Rendicion',["nombre"=>$fromName,"proyecto"=>$request->get('proyecto'),"numero"=>$id_rendicion,"nombreProyecto"=>$nProyecto], function ($message) use($fromEmail,$fromName,$toEmail,$toName) {
                 $message->from($fromEmail, $fromName);
                 $message->sender($fromEmail, $fromName);
                 $message->to($toEmail, $toName);   
                 $message->cc($fromEmail, $fromName);                               
                 $message->subject('Rendición de fondos');
                 $message->priority(3);
                 //$message->attach('pathToFile');
             }); 
              

            } //if cabecera-save()
        } //if request-method
            

           
           
         } catch (Exception $e)
          {
              DB::rollback();
         }      
         

        //return Redirect::to('Rendiciones/rendiciones');      
            
                       
    }       

        

    

    public function storeRendicion(Request $request)
    {      

        
        $date = Carbon::now();

        if ($request->isMethod('post')) {
            $rendicion= new Rendicion;
            $rendicion->fecha_sistema= $date->format('Y/m/d');
            $rendicion->id_rendidor= strtoupper($request->get('id_solicitante'));
            $rendicion->tipo_documento= $request->input('tipodoc');
            $rendicion->numero_documento= strtoupper($request->get('ndoc'));
            $rendicion->fecha_documento= strtoupper($request->get('fechadoc'));
            $rendicion->monto_rendir= strtoupper($request->get('monto'));
            $rendicion->codigo_sap= strtoupper($request->get('codigoSap'));
            $rendicion->hora_rendicion= $date->toTimeString();  
            $rendicion->proyecto=strtoupper($request->get('proyecto'));
            $nombreProyecto = DB::connection('sqlsrv')->select("select PrjCode,PrjName from OPRJ WHERE PrjCode=?",[strtoupper($request->get('proyecto'))]);       

            $nProyecto = $nombreProyecto[0]->PrjName;
            $rendicion->nombreProyecto = $nombreProyecto[0]->PrjName;             
            $rendicion->estado=0;    
            //aqui falta la foto
            $rendicion->observaciones=strtoupper($request->get('observaciones'));
            $rendicion->concepto=strtoupper($request->get('concepto'));

            
        }       
                    
    

        if ($rendicion->save()) 
        {
            //obtenemos el ID la rendicion Grabada
             $id_rendicion = Rendicion::orderBy('id','desc')->first()->id;


            //  //recorremos el arreglo concepto para grabar cada linea            
            // foreach($request->concepto as $con){
            //     $concepto=new RendicionMotivo;
            //     $concepto->idmotivo = $con[0];

            //     //vamos buscar el nombre del motivo
            //     $motivos= DB::table('fnd_tipo_solicitud as a')
            //         ->select('a.concepto')
            //         ->where('id','=',$con[0])->first();

                
            //     $concepto->nombre_motivo =strtoupper($motivos->concepto);
            //     $concepto->fecha=$date->format('Y/m/d');             
            //     $concepto->idusuario=strtoupper($request->get('id_solicitante'));
            //     $concepto->nrorendicion=$id_rendicion;

            //     $concepto->save();
            //  }        
                  
        }

        
        return Redirect::to('Rendiciones/rendiciones');
        

    }


    public function storeRendicionPaso(Request $request)
    {      
   
      
       // var_dump($request->all());  
       // dd();    

        $this->validate($request, [
        'foto' => 'required|image'
        ]);

        $file = $request->file('foto');        
        $filename = $file->getClientOriginalName();        
        $file->move(public_path().'/imagenes/rendiciones/',time().$file->getClientOriginalName());

        //Image::make($file)->fit(144,144)->save($path)

        $rendicion= new DetalleRendicionPaso;          
        $rendicion->codigoZona =$request->get('id_zona');
        $rendicion->tipoDocumento =$request->get('tipodoc');
        $rendicion->numeroDocumento =$request->get('ndoc');
        $rendicion->fechaDocumento =$request->get('fechadoc');
        $rendicion->codigoGasto =$request->get('concepto');
        $rendicion->numeroSolicitud =$request->get('id_solicitud');
      
        if(empty($request->get('subconsumo')) || is_null($request->get('subconsumo')))
        {
            $rendicion->codigoDetalle = 0;
        }else
        {
            $rendicion->codigoDetalle =$request->get('subconsumo');
        }

        $rendicion->monto =$request->get('monto');

        $rendicion->observaciones =$request->get('observaciones');
        
        $rendicion->foto = $filename;


         // if (Input::hasFile($request->get('foto')))
         //  {
         //     $file=Input::file($request->get('foto'));
         //     $file->move(public_path().'/imagenes/rendiciones/',$file->getClientOriginalName());
         //     $rendicion->foto=$file->getClientOriginalName();
         //  }



         if(empty($request->get('dias')) || is_null($request->get('dias')))
         {
            $rendicion->dias = 0;
         }else
         {
            $rendicion->dias =$request->get('dias');    
         }                               
      
         $saved = $rendicion->save();
        
        $data['success'] = $saved;
        $data['mensaje'] = 'Algún dato erroneo por favor revisar';
        //$data['path'] = $rendicion->getAvatarUrl().'?'. iniqid();
       
        //obtenemos el objeto DetalleRendicionPaso        
        $datos=DetalleRendicionPaso::all();        
         
        return [$data,$datos];
        
        //return Redirect::to('Rendiciones/rendiciones');
        

    }


    public function recargarDetalle($id)
    {
         $datos=DB::table('fnd_paso_rendicion as a')        
        ->select('a.numeroDocumento','a.tipoDocumento', 'a.monto','a.foto','a.id')        
        ->where([
            ['a.numeroSolicitud','=',$id]            
        ])->get()->all();

        
        return response()->json($datos);
    }
   

    public function ver_solicitudes($id)

    {
       
        $tsolicitud=DB::table('fnd_solicitud as a')
        ->join('users as c','a.id_solicitante','=','c.id')                
        ->select('a.id','a.fecha_solicitud', 'c.name as nombre','a.monto_solicitado')
        ->where([
            ['a.id_solicitante','=',$id],
            ['a.estado','>',0],          
        ])->get()->all();

       
       	

        return view("Rendiciones.solicitudes.misSolicitudes",["tsolicitud"=>$tsolicitud,"datos"=>$datos]);
       //return Response::json($tasignacion, 200);
        //return Redirect::to('asignaciones',["tasignacion"=>$tasignacion]);
        
    }

    public function ver_rendiciones($id)

    {
       
        $trendicion=DB::table('fnd_rendicion_cabecera as a')
        ->join('users as c','a.usuario','=','c.id')
        ->join('fnd_rendicion_detalle as d','a.id_rendicion','=','d.id_rendicion')
        ->select('a.id_rendicion','a.fecha', 'c.name as nombre','a.totalRendido','a.proyecto',DB::raw('sum(d.monto) as rendido'))
        ->where('a.usuario','=',$id)  
        ->groupBy('a.id_rendicion','a.fecha', 'c.name','a.totalRendido','a.proyecto')->get()->all();
        

       //\Log::info($trendicion); 
       // dd($trendicion);

        return view("Rendiciones.rendiciones.misRendiciones",["trendicion"=>$trendicion]);
       //return Response::json($tasignacion, 200);
        //return Redirect::to('asignaciones',["tasignacion"=>$tasignacion]);
        
    }


    public function miRendicion($id)

    {
        //rescatamos el proyecto de la solicitud
        $solicitud=DB::table('fnd_solicitud as a')        
        ->select('a.id','a.proyecto','a.nombreProyecto','a.id_solicitante','a.codigoSap')
        ->where('a.id','=',$id)->get()->first();



        $codigoProyecto = $solicitud->proyecto;
        $nombreProyecto = $solicitud->nombreProyecto;
        $id_solicitante = $solicitud->id_solicitante; 
        $codigoSap = $solicitud->codigoSap;
        $id_solicitud = $solicitud->id;

        //dd($codigoProyecto);


         //cargamos las zonas para topes de consumo
         $zonas = Zona::all();
         


          //cargamos la tabla para el tipo de solictud a rendir pueden ser varios motivos
         $tiposolitudes =DB::table('fnd_tipo_solicitud')->where('id','>','0')->get();

         //cargamos los subgastos para rendir
         $tipogastos =DB::table('fnd_tipo_gasto')->where('id','>','0')->get();

        //obtenemos el objeto DetalleRendicionPaso        
        $datos=DetalleRendicionPaso::where('numeroSolicitud','=',$id_solicitud)->get()->all();
        //->orderBy('id','asc')->get()->all();
        
   /*     $datos=DB::table('fnd_paso_rendicion as a')
        ->select('a.id','a.numeroSolicitud','a.numeroDocumento','a.monto','foto','a.tipoDocumento')        
        ->where('a.numeroSolicitud','=',$id_solicitud)        
        ->orderBy('a.id','asc')
        ->paginate(7);
        */
       

       

        return view('Rendiciones.rendiciones.Rendicion',["tiposolicitudes"=>$tiposolitudes,"zonas"=>$zonas,"codigoProyecto"=>$codigoProyecto,"nombreProyecto"=>$nombreProyecto,"id_solicitante"=>$id_solicitante,"codigoSap"=>$codigoSap,"id_solicitud"=>$id_solicitud,"tipogastos"=>$tipogastos,"datos"=>$datos]);            
     
       //return Response::json($tasignacion, 200);
        //return Redirect::to('asignaciones',["tasignacion"=>$tasignacion]);
        
    }

     public function miRendicion2($id)

    {


        //rescatamos el proyecto de la solicitud
        $solicitud=DB::table('fnd_solicitud as a')        
        ->select('a.id','a.proyecto','a.nombreProyecto','a.id_solicitante','a.codigoSap')
        ->where('a.id','=',$id)->get()->first();
        
        

        $codigoProyecto = $solicitud->proyecto;
        $nombreProyecto = $solicitud->nombreProyecto;
        $id_solicitante = $solicitud->id_solicitante; 
        $codigoSap = $solicitud->codigoSap;
        $id_solicitud = $solicitud->id;

        //dd($solicitud);


         //cargamos las zonas para topes de consumo
         $zonas = Zona::all();
       


          //cargamos la tabla para el tipo de solictud a rendir pueden ser varios motivos
         $tiposolitudes =DB::table('fnd_tipo_solicitud')->where('id','>','0')->get();


         //cargamos los subgastos para rendir
         $tipogastos =DB::table('fnd_tipo_gasto')->where('id','>','0')->get();

         \Log::info($zonas);
     

        return view('Rendiciones.rendiciones.RendicionV2',["tiposolicitudes"=>$tiposolitudes,"zonas"=>$zonas,"codigoProyecto"=>$codigoProyecto,"nombreProyecto"=>$nombreProyecto,"id_solicitante"=>$id_solicitante,"codigoSap"=>$codigoSap,"id_solicitud"=>$id_solicitud,"tipogastos"=>$tipogastos]);            
     
       //return Response::json($tasignacion, 200);
        //return Redirect::to('asignaciones',["tasignacion"=>$tasignacion]);
        
    }



     public function verSolicitudesRendir($id)

    {
         //$idLog=Auth::User()->id; 
         //$nombre=Auth::User()->name;
         //$codigoSap=Auth::User()->codigoSap;

        //buscamos 
        //$user = User::find($id);
        //dd($user);
        
        $usuario=DB::table('users as u')                
                ->select('u.id','u.name','u.codigoSap')
                ->where('u.id','=',$id)->first();
        //dd($usuario);

        $idLog = $usuario->id; 
        $nombre = $usuario->name;
        $codigoSap = $usuario->codigoSap;

        $tsolicitud=DB::table('fnd_solicitud as a')
        ->join('users as c','a.id_solicitante','=','c.id')
        ->leftjoin('fnd_rendicion_cabecera as f','a.id','=','f.nSolicitud')
        ->leftjoin('fnd_rendicion_detalle as r','r.id_rendicion','=','f.id_rendicion')
        ->select(DB::raw('sum(r.monto) as rendido'),DB::raw('a.monto_solicitado - sum(r.monto) as saldo'),'a.id','a.fecha_solicitud', 'c.name as nombre','a.monto_solicitado','a.proyecto','a.nombreProyecto')
        ->where([
            ['a.id_solicitante','=',$id],
            ['a.estado','>',0],
            ['a.estado','<',3],
            ])
        ->groupBy('a.id','a.fecha_solicitud', 'c.name','a.monto_solicitado','a.proyecto','a.nombreProyecto')
        ->paginate(7);


       

        return view("Rendiciones.solicitudes.misSolicitudesRendir",["tsolicitud"=>$tsolicitud,"id"=>$idLog,"nombre"=>$nombre,"codigoSap"=>$codigoSap]);


       //return Response::json($tasignacion, 200);
        //return Redirect::to('asignaciones',["tasignacion"=>$tasignacion]);
        
    }    
   


     public function ver_una_solicitude($id)
    {
       $variable = $id;
       $variable = (int) $variable;
        $tsolicitud=DB::table('fnd_solicitud as a')
        ->join('users as c','a.id_solicitante','=','c.id')        
        ->select('a.id','a.fecha_solicitud', 'c.name as nombre','a.monto_solicitado','a.proyecto','a.montoNuevo1')
            ->where('a.id','=',$variable)->first();  
        
        

        $cargarMotivos=DB::table('fnd_solicitud_motivo as f')
        ->select('f.nroSolicitud','f.nombreMotivo')
            ->where('f.nroSolicitud','=',$variable)->get()->all(); 

         
        return view("Rendiciones.solicitudes.verSolicitud",["tsolicitud"=>$tsolicitud,"motivos"=>$cargarMotivos]);
       
        
    }

    public function update(SolicitudRequest $request,$id)
    {
         $idLog=Auth::User()->id; 

        if (Auth::User()->idrol == 2) //jefe directo
        {
                
                   $date = Carbon::now();        
        
                   $solicitud=Solicitud::findOrFail($id);

                   $solicitud->estado=$request->get('resolucion');
                   $solicitud->fechaAutorizacion1= $date->format('Y/m/d');
                   $solicitud->montoNuevo1=$request->get('monto_nuevo');
                   $solicitud->codAutorizador1=$idLog;
                   $solicitud->horaAutorizador1 =  $date->toTimeString(); 

                     $solicitud->update();

                     $notificacion = array (
                        'message' => 'Solicitud aprobada con exitò',
                        'alert-type' => 'success'

                     );
        }
        if (Auth::User()->idrol == 4  ) //gerencia general
            {
                

                   $date = Carbon::now();        
        
                   $solicitud=Solicitud::findOrFail($id);

                   $solicitud->estado=$request->get('resolucion');
                   $solicitud->fechaAutorizacion2= $date->format('Y/m/d');
                   $solicitud->montoNuevo2=$request->get('monto_nuevo');
                   $solicitud->codAutorizador2=$idLog;
                   $solicitud->horaAutorizador2 =  $date->toTimeString(); 
                   $solicitud->update();
                    

                    //cargamos mas datos de la solicitud para envio de correo
                       $variable = $id;
                       $variable = (int) $variable;
                        $tsolicitud=DB::table('fnd_solicitud as a')
                        ->join('users as c','a.id_solicitante','=','c.id')        
                        ->select('a.id','a.fecha_solicitud', 'c.name as nombre','a.monto_solicitado','a.proyecto','a.montoNuevo1')
                            ->where('a.id','=',$variable)->first();                         

                        $cargarMotivos=DB::table('fnd_solicitud_motivo as f')
                        ->select('f.nroSolicitud','f.nombreMotivo')
                            ->where('f.nroSolicitud','=',$variable)->get()->all(); 


                     $fromEmail = 'eroman@aj.cl';
                     $fromName = 'Emilio Roman';

                     $toEmail = 'eroman@aj.cl';
                     $toName = 'Emilio Roman';

                     //nombre de gerente general
                     $nombreGerente = 'Francisco Briceño';

                     //Se crea correo a tesoreria para informar autorizacion de fondos
                      Mail::send('Mail.autorizacionFondos',["solicitud"=>$solicitud,"tsolicitud"=>$tsolicitud,"cargarMotivos"=>$cargarMotivos,"variable"=>$variable,"nombreGerente"=>$nombreGerente], function ($message) use($fromEmail,$fromName,$toEmail,$toName) {
                        $message->from($toEmail, $toName);
                        $message->sender($fromEmail, $fromName);
                        $message->to($fromEmail, $fromName);   
                        $message->cc($toEmail,$toName);                               
                        $message->subject('Autorizacion de fondos a rendir');
                        $message->priority(3);
                        //$message->attach('pathToFile');
                     }); 

                       $notificacion = array (
                        'message' => 'Solicitud aprobada con exitò',
                        'alert-type' => 'success'

                     );

            } 
        

          

            //die (json_encode('ok'));
            return Redirect::to('home')->with($notificacion);
    }


    public function autorizar(Request $request)
    {
        $idLog=Auth::User()->id; 

        
           //ejemplo de update documentacion laravel
           /*App\Flight::where('active', 1)
          ->where('destination', 'San Diego')
          ->update(['delayed' => 1]); //en esta linea van los valores que se actualizan*/



        $date = Carbon::now(); 
        
        //$horaAutoriza =  $date->toTimeString();
        
      
       
        $ids = explode(",", substr($request->get("ids"), 0, -1)); 

         //\Log::info($request->get("ids")); 
      
        //\Log::info($ids); 

        foreach ($ids as $value)
        {
            if (Auth::User()->idrol == 2) //jefe directo
             {
                $monto =  Solicitud::where('id', $value)          
                ->select('monto_solicitado')->get()->first()->monto_solicitado;

                //ahora actualizamos el id
                Solicitud::where('id', $value)            
                ->update(['montoNuevo1' => $monto,'fechaAutorizacion1' => $date->format('Y-m-d'), 'codAutorizador1' => $idLog, 'estado' => 1,'horaAutorizador1' =>  $date->toTimeString()]); //en esta linea van los valores que se actualizan*/

             }

           if (Auth::User()->idrol == 4 || Auth::User()->idrol == 1 ) //gerencia general y administrador del sistema
            {
                $monto =  Solicitud::where('id', $value)          
                ->select('montoNuevo1')->get()->first()->montoNuevo1;

                //ahora actualizamos el id
                Solicitud::where('id', $value)            
                ->update(['montoNuevo2' => $monto,'fechaAutorizacion2' => $date->format('Y-m-d'), 'codAutorizador2' => $idLog,'estado' => 1,'horaAutorizador2' =>  $date->toTimeString()]);

               

           }        

        }

         //Generamos la matrix con las solicitudes aprobadas, solo despues de la autorizacion del gerente General

                $autorizados=DB::table('fnd_solicitud as T0')
                 ->join('users as T1','T0.id_solicitante','=','T1.id')
                 ->select('T0.id','T0.montonuevo2','T0.proyecto','T0.nombreProyecto','T1.name')
                 ->where('T0.fechaAutorizacion2','=',$date)->get()->all(); 

                dd($autorizados);  

                $notificacion = array (
                        'message' => 'Solicitudes aprobadas con exitò',
                        'alert-type' => 'success'
                );

         
        return Redirect::to('home')->with($notificacion);     
        
        
    } 


     public function verGastosProyecto($id)

    {
       $solicitadoProyecto = DB::connection('sqlsrv')->select("select jdt1.project, account,acctname, sum(debit-credit) as Solicitado,PrjName from jdt1 inner join oact on jdt1.Account=oact.AcctCode inner join oprj on jdt1.project=oprj.prjcode  where substring(account,1,1) in (5,6) and jdt1.project=? group by jdt1.project,account,acctname,oprj.PrjName",[$id]);
      
         
        //vamos a cargar el nombre de cada proyecto
        $proyecto = DB::connection('sqlsrv')->select("select PrjCode,PrjName from OPRJ WHERE PrjCode=?",[$id])[0]; 
           

          
          

        return view("rendiciones.gastosPorProyecto",["solicitadoProyecto"=>$solicitadoProyecto,"proyecto"=>$proyecto]);
       //return Response::json($tasignacion, 200);
        //return Redirect::to('asignaciones',["tasignacion"=>$tasignacion]);
        
    }

   public function validarMonto(Request $request)
   {    
        $montodia = 0 ;
        $validator = Validator::make( $request->all(),
           [
               'monto' => 'required',
               'concepto' => 'required',
               'subconsumo' => 'required',
               'zona' => 'required',
               'dias' => 'required',             
            ]);

      

       if($validator->fails()){
         $jsondata['status'] = false;
         $jsondata['message'] = str_replace('.','.<br>', $validator->errors()->all());
       }else
       {
         //$jsondata['status'] = true;
         //$jsondata['message'] = 'Se validó correctamente';

         //vamos a buscar la informacion de consumo para comparar 
         if ($request->get('subconsumo') == 0 || $request->get('subconsumo') == "")
         {
             $subconcepto = 0;
         }else
         {
            $subconcepto = $request->get('subconsumo');
         }

         $monto=DB::table('fnd_tope_zona_gasto as T0')                 
                 ->select('T0.tope')
                  ->where([
                        ['T0.codigozona','=',$request->get('zona')],
                        ['T0.concepto','=',$request->get('concepto')],          
                        ['T0.subconcepto','=',$subconcepto],                        
                    ])->get()->first();
              
                
       }

        if (empty($monto)){
            $jsondata['status'] = true;
            $jsondata['message'] = 'Falta clasificar este tipo de gasto';
        }else
        {
            $montodia = ($request->get('monto') / $request->get('dias'));
            
            if ( $montodia <= $monto->tope) 
            {
                 $jsondata['status'] = true;
                 $jsondata['message'] = 'monto autorizado';
             }else
             {
                $jsondata['status'] = false;
                $jsondata['message'] = 'Monto no Autorizado';
            }

        }


       

    

       return response()->json([
            'estado' =>  $jsondata['status'],
            'mensaje' => $jsondata['message']
            
       ]);


      
    }


 public function validarExiste(Request $request)
   {    
        $validator = Validator::make( $request->all(),
           [
               'tipoDocumento' => 'required',
               'numeroDocumento' => 'required',
               'concepto' => 'required',
               'monto' => 'required',              
            ]);

      

       if($validator->fails()){
         $jsondata['status'] = false;
         $jsondata['message'] = str_replace('.','.<br>', $validator->errors()->all());
       }else
       {
         
      
        
         $monto=DB::table('fnd_rendicion_detalle as T0')                 
                 ->select('T0.monto','T0.id_rendicion')
                  ->where([
                        ['T0.tipoDocumento','=',$request->get('tipoDocumento')],
                        ['T0.numeroDocumento','=',$request->get('numeroDocumento')],          
                        ['T0.codigoGasto','=', $request->get('concepto')],
                        ['T0.monto','=', $request->get('monto')],    
                    ])->get()->first();
              
                
       }

        if (!empty($monto->monto)){
            $jsondata['status'] = false;
            $jsondata['message'] = 'Movimiento ya registrado en rendicion Nº' . ''.  $monto->id_rendicion;
        }else
        {          
           $jsondata['status'] = true;           
           $jsondata['message'] = 'Movimiento Permitido';
        }


       

       //\Log::info($jsondata);      

       return response()->json([
            'estado' =>  $jsondata['status'],
            'mensaje' => $jsondata['message']
            
       ]);


      
    }

    public function validaRendicionJefe($id)
    {
       
         $miRendicion=DB::table('fnd_rendicion_cabecera as c')
            ->leftjoin('users as u', 'c.usuario','=','u.id')
            ->leftjoin('fnd_rendicion_detalle as r','c.id_rendicion','=','r.id_rendicion')
            ->leftjoin('fnd_tipo_solicitud as s','r.codigoGasto','=','s.id')
            ->leftjoin('fnd_tipo_gasto as g','r.codigoDetalle','=','g.id')
            ->select('r.fila','r.codigoZona','r.tipoDocumento','r.numeroDocumento','r.fechaDocumento','s.concepto','g.detalle','r.dias','c.proyecto','r.monto','c.nombreProyecto','r.observaciones','r.foto')
            ->where('c.id_rendicion','=',$id)
            ->orderBy('c.id_rendicion','asc')->get()->all();

        //dd($miRendicion);

          return view("Rendiciones.rendiciones.validarRendicionJefe",compact('miRendicion','id'));         
    }


}