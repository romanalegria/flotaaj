<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use App\Documentacion;
use App\Vehiculo;
use App\User;
use App\SolicitudMantencion;
use App\TablaMantencion;
use  App\mnt_flotaaj;

use App\Http\Requests\VehiculoCreateRequest;
use App\Http\Requests\DocumentacionCreateRequest;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Mail;

use DB;
use Validator;
class VehiculoController extends Controller
{
  


      public function __construct()
    {

    }
    public function index(Request $request)
    {
        if ($request)
        {
            $query=trim($request->get('searchText'));
            $vehiculos=DB::table('vehiculo as a')
            ->join('encargados as c','a.encargado','=','c.id')
            ->join('categoria as d','a.tipovehiculo','=','d.id')
            ->join('estado_vehiculo as e','a.estadovehiculo','=','e.id')
            ->join('areas as f','a.areanegocio','=','f.id')
            ->leftjoin('tipo_flota as tf','a.empresa','=','tf.id')
            ->select('a.id','a.nombre','a.marca','a.modelo','a.axo','d.nombre as categoria','e.nombre as estado','a.tipocombustible','a.numserie','a.patente','a.color','f.nombre as Area', 'c.nombres as encargado', 'a.empresa','a.foto1','a.foto2','a.foto3','a.foto4','a.foto5','a.foto6','a.foto7','tf.nombre as nombreFlota','a.foto8','a.foto9','a.foto10','a.inspeccion','a.mantencion')
            ->where('a.nombre','LIKE','%'.$query.'%')
            ->orwhere('a.marca','LIKE','%'.$query.'%')
            ->orwhere('a.patente','LIKE','%'.$query.'%')
            ->orderBy('id','desc')
            ->paginate(7);


           /* //buscamos el encargado actual del vehiculo
            $encargado = DB::table('detalle_asignaciones as a')
            ->join('vehiculo as v','v.id','=','a.id_vehiculo')
            ->join('encargados as d','d.id','=','a.id_encargado')
            ->select('a.nombres','a.Apellidos')
            ->where('a.id_devolucion','=',0)             
            ->orwhere('v.id','=',$vehiculos->id)->get()->first();*/

            return view('flota.vehiculo.index',["vehiculos"=>$vehiculos,"searchText"=>$query]);
        }
    }
    public function create()
    {
    	$encargados=DB::table('encargados')->where('id','>','0')->get();
    	$tipos=DB::table('tipo_flota')->where('id','>','0')->get();
        $estados=DB::table('estado_vehiculo')->where('id','>','0')->get();
        $areas=DB::table('areas')->where('id','>','0')->get();
        $categorias=DB::table('categoria')->where('id','>','0')->get();

        return view("flota.vehiculo.create",["encargados"=>$encargados, "tipos"=>$tipos, "estados"=>$estados,"areas"=>$areas,"categorias"=>$categorias]);
    }

    public function cargardoc($id)
    {
      
        $documentos=DB::table('tipo_documento')->where('id','>','0')->get();
        $vehiculos=DB::table('vehiculo')->where('id', '=', $id)->get()->first();
        $documentacion=DB::table('documentacion_vehiculo as a')
        ->join('tipo_documento as t','a.id_documento','=','t.id')
        ->where('id_vehiculo','=', $id)->get()->all();

    

       //print_r($documentacion);

       return view("flota.vehiculo.documentos",["documentos"=>$documentos,"vehiculos"=>$vehiculos,"documentacion"=>$documentacion]);
    }


    public function store (VehiculoCreateRequest $request)
    {
        $vehiculo=new Vehiculo;
        $vehiculo->nombre= strtoupper($request->get('nombre'));
        $vehiculo->marca= strtoupper($request->get('marca'));
        $vehiculo->modelo= strtoupper($request->get('modelo'));
        $vehiculo->axo=$request->get('axo');
        $vehiculo->tipovehiculo=$request->get('tipovehiculo');
        $vehiculo->estadovehiculo=$request->get('estadovehiculo');
        $vehiculo->tipocombustible=$request->get('tipocombustible');
        $vehiculo->numserie=strtoupper($request->get('numserie'));
        $vehiculo->patente=strtoupper($request->get('patente'));
        $vehiculo->color=strtoupper($request->get('color'));
        $vehiculo->areanegocio=$request->get('areanegocio');
        $vehiculo->encargado=$request->get('encargado');
        $vehiculo->empresa=$request->get('empresa');
        $vehiculo->kilometraje=$request->get('kilometraje');
        $vehiculo->inspeccion=$request->get('inspeccion');
        $vehiculo->mantencion=$request->get('mantencion');

        if (Input::hasFile('foto1'))
         {
            $file=Input::file('foto1');
            $file->move(public_path().'/imagenes/vehiculos/',$file->getClientOriginalName());
            $vehiculo->foto1=$file->getClientOriginalName();
        }

        if (Input::hasFile('foto2'))
         {
            $file=Input::file('foto2');
            $file->move(public_path().'/imagenes/vehiculos/',$file->getClientOriginalName());
            $vehiculo->foto2=$file->getClientOriginalName();
        }

        if (Input::hasFile('foto3'))
         {
            $file=Input::file('foto3');
            $file->move(public_path().'/imagenes/vehiculos/',$file->getClientOriginalName());
            $vehiculo->foto3=$file->getClientOriginalName();
        } 

        if (Input::hasFile('foto4'))
         {
            $file=Input::file('foto4');
            $file->move(public_path().'/imagenes/vehiculos/',$file->getClientOriginalName());
            $vehiculo->foto4=$file->getClientOriginalName();
        }
        if (Input::hasFile('foto5'))
         {
            $file=Input::file('foto5');
            $file->move(public_path().'/imagenes/vehiculos/',$file->getClientOriginalName());
            $vehiculo->foto5=$file->getClientOriginalName();
        }

        if (Input::hasFile('foto6'))
         {
            $file=Input::file('foto6');
            $file->move(public_path().'/imagenes/vehiculos/',$file->getClientOriginalName());
            $vehiculo->foto6=$file->getClientOriginalName();
        }

        if (Input::hasFile('foto7'))
         {
            $file=Input::file('foto7');
            $file->move(public_path().'/imagenes/vehiculos/',$file->getClientOriginalName());
            $vehiculo->foto7=$file->getClientOriginalName();
        }

        if (Input::hasFile('foto8'))
        {
            $file=Input::file('foto8');
            $file->move(public_path().'/imagenes/vehiculos/',$file->getClientOriginalName());
            $vehiculo->foto8=$file->getClientOriginalName();
        }

        if (Input::hasFile('foto9'))
        {
            $file=Input::file('foto9');
            $file->move(public_path().'/imagenes/vehiculos/',$file->getClientOriginalName());
            $vehiculo->foto9=$file->getClientOriginalName();
        }

        if (Input::hasFile('foto10'))
        {
            $file=Input::file('foto10');
            $file->move(public_path().'/imagenes/vehiculos/',$file->getClientOriginalName());
            $vehiculo->foto10=$file->getClientOriginalName();
        }
        
        $vehiculo->save();

        $notificacion = array (
                        'message' => 'vehìculo creado con exitò',
                        'alert-type' => 'success'

                     );


        return Redirect::to('flota/vehiculo')->with($notificacion);

    }

    public function creardoc(DocumentacionCreateRequest $request)
    {
        //print_r($request);
        //print_r($_POST['documento']);
        //print_r($_POST['fechav']);
        //print_r($_POST[$vehiculos->id]);
        
        print_r($request->get('archivo'));


        $documentacion=new Documentacion;
        $documentacion->id_documento=$request->get('documento');
        $documentacion->id_vehiculo=$request->get('id_vehiculo');
        $documentacion->fecha_vencimiento=$request->get('fechav');
        $documentacion->poliza=$request->get('poliza');
        $documentacion->item=$request->get('item');

        if ($request->hasFile('archivo'))
         {
            $file=$request->file('archivo');
            $file->move(public_path().'/imagenes/vehiculos/documentacion',$file->getClientOriginalName());
            $documentacion->archivo=$file->getClientOriginalName();
        }

        $documentacion->save();
        die (json_encode('ok'));
    }

    public function show($id)
    {
        return view("flota.vehiculo",["vehiculo"=>Vehiculo::findOrFail($id)]);
    }


    public function edit($id)
    {
    	$vehiculo=Vehiculo::findOrFail($id);
    	$encargados=DB::table('encargados')->where('id','>','0')->get();
        $tipos=DB::table('tipo_flota')->where('id','>','0')->get();
        $estados=DB::table('estado_vehiculo')->where('id','>','0')->get();
        $areas=DB::table('areas')->where('id','>','0')->get();
        $categorias=DB::table('categoria')->where('id','>','0')->get();

        return view("flota.vehiculo.edit",["vehiculo"=>$vehiculo,"encargados"=>$encargados,"tipos"=>$tipos,"estados"=>$estados,"areas"=>$areas, "categorias"=>$categorias]);
    }


     public function doc($id)
    {
        $vehiculo=Vehiculo::findOrFail($id);
       

        return view("flota.vehiculo.documentos",["vehiculo"=>$vehiculo,"encargados"=>$encargados,"tipos"=>$tipos,"estados"=>$estados,"areas"=>$areas]);
    }

    public function update(VehiculoCreateRequest $request,$id)
    {
        $vehiculo=Vehiculo::findOrFail($id);     
        $vehiculo->nombre=strtoupper($request->get('nombre'));
        $vehiculo->marca=strtoupper($request->get('marca'));
        $vehiculo->modelo=strtoupper($request->get('modelo'));
        $vehiculo->axo=$request->get('axo');
        $vehiculo->tipovehiculo=$request->get('tipovehiculo');
        $vehiculo->estadovehiculo=$request->get('estadovehiculo');
        $vehiculo->tipocombustible=$request->get('tipocombustible');
        $vehiculo->numserie=strtoupper($request->get('numserie'));
        $vehiculo->patente=strtoupper($request->get('patente'));
        $vehiculo->color=($request->get('color'));
        $vehiculo->areanegocio=$request->get('areanegocio');
        $vehiculo->encargado=$request->get('encargado');
        $vehiculo->empresa=$request->get('empresa');
        $vehiculo->kilometraje=$request->get('kilometraje');
        $vehiculo->inspeccion=$request->get('inspeccion');
        $vehiculo->mantencion=$request->get('mantencion');

          if (Input::hasFile('foto1'))
         {
            $file=Input::file('foto1');
            $file->move(public_path().'/imagenes/vehiculos/',$file->getClientOriginalName());
            $vehiculo->foto1=$file->getClientOriginalName();
        }

        if (Input::hasFile('foto2'))
         {
            $file=Input::file('foto2');
            $file->move(public_path().'/imagenes/vehiculos/',$file->getClientOriginalName());
            $vehiculo->foto2=$file->getClientOriginalName();
        }

        if (Input::hasFile('foto3'))
         {
            $file=Input::file('foto3');
            $file->move(public_path().'/imagenes/vehiculos/',$file->getClientOriginalName());
            $vehiculo->foto3=$file->getClientOriginalName();
        }

        if (Input::hasFile('foto4'))
         {
            $file=Input::file('foto4');
            $file->move(public_path().'/imagenes/vehiculos/',$file->getClientOriginalName());
            $vehiculo->foto4=$file->getClientOriginalName();
        }

        if (Input::hasFile('foto5'))
         {
            $file=Input::file('foto5');
            $file->move(public_path().'/imagenes/vehiculos/',$file->getClientOriginalName());
            $vehiculo->foto5=$file->getClientOriginalName();
        }

        if (Input::hasFile('foto6'))
         {
            $file=Input::file('foto6');
            $file->move(public_path().'/imagenes/vehiculos/',$file->getClientOriginalName());
            $vehiculo->foto6=$file->getClientOriginalName();
        }

        if (Input::hasFile('foto7'))
         {
            $file=Input::file('foto7');
            $file->move(public_path().'/imagenes/vehiculos/',$file->getClientOriginalName());
            $vehiculo->foto7=$file->getClientOriginalName();
        }

        if (Input::hasFile('foto8'))
         {
            $file=Input::file('foto8');
            $file->move(public_path().'/imagenes/vehiculos/',$file->getClientOriginalName());
            $vehiculo->foto8=$file->getClientOriginalName();
        }        

        if (Input::hasFile('foto9'))
         {
            $file=Input::file('foto9');
            $file->move(public_path().'/imagenes/vehiculos/',$file->getClientOriginalName());
            $vehiculo->foto9=$file->getClientOriginalName();
        }

        if (Input::hasFile('foto10'))
         {
            $file=Input::file('foto10');
            $file->move(public_path().'/imagenes/vehiculos/',$file->getClientOriginalName());
            $vehiculo->foto10=$file->getClientOriginalName();
        }


        $vehiculo->update();

        $notificacion = array (
                        'message' => 'vehìculo modificado con exitò',
                        'alert-type' => 'success'

                     );

        return Redirect::to('flota/vehiculo')->with($notificacion);
    }


    public function destroy($id)
    {
        $vehiculo=Vehiculo::findOrFail($id);        
        $vehiculo->delete();
        return Redirect::to('flota/vehiculo');
    }

    public function deletedoc($id)
    {
        
        $documentacion=Documentacion::findOrFail($id);        
        $documentacion->delete();

        die (json_encode('ok'));
        
    }


     public function excel()
    {
         Excel::create('Laravel Excel', function($excel) {
 
            $excel->sheet('Vehiculos', function($sheet) {
 
                $vehiculos = Vehiculo::all();
 
                $sheet->fromArray($vehiculos);
 
            });
        })->export('xls');
    }

    public function createman()
    {

        //cargamos el usuario logeado
         $id=Auth::User()->id; 
         $nombre=Auth::User()->name; 
        //traemos el vehiculo asignado en la actualidad
        $vehiculo=DB::table('encargados as a')        
        ->join('users as t','a.id_users','=','t.id')
        ->join('detalle_asignaciones as d','a.id','=','d.id_encargado')
        ->join('vehiculo as v','v.id','=','d.id_vehiculo')
        ->select('v.id', 'v.nombre','v.marca', 'v.modelo')
        ->where('a.id','=', $id)   
        ->orwhere('d.id_devolucion','=',0)      
        ->orwhere('v.asignada','=',1)->get()->first();

      
       

         return view("flota.vehiculo.mantencion",["id"=>$id,"nombre"=>$nombre,"vehiculo"=>$vehiculo]);
    }

     public function createplan($id)
    {

        $vehiculos=DB::table('vehiculo')->where('id', '=', $id)->get()->first();     
       

       return view("flota.vehiculo.planificaMan",["vehiculo"=>$vehiculos]);
    }



    //aqui traemos las mantenciones a realizar segun kilometraje recibido
    public function Planificacion($id)
    {
        $mantenciones=DB::table('tabla_mantenciones as t')
        ->select('t.id','t.nombre','k5000')->get()->all();  

        //dd($mantenciones);

        //return Redirect::to('flota/vehiculo/vePlanificacion')->with($mantenciones);
        return view("flota.vehiculo.vePlanificacion",["mantenciones"=>$mantenciones]);

    }

    public function storeman($request)
    {
        $date = Carbon::now();

        $mantencion=new SolicitudMantencion;
        $mantencion->fecha_creacion=$date->format('Y/m/d');
        $mantencion->id_usuario=$_POST['usuario'];
        $mantencion->id_vehiculo=$request;      
        $mantencion->observaciones=$_POST['observaciones'];
        $mantencion->kilometraje=$_POST['kilometraje'];


        //Sistema luces

        if(isset($_POST["slu_estacionamiento"])) 
         { 
            $mantencion->slu_estacionamiento=true; 
        }else {
            $mantencion->slu_estacionamiento=false; 
        } 

        if(isset($_POST["slu_bajas"]))
         { 
            $mantencion->slu_bajas=true; 
        } else{
            $mantencion->slu_bajas=false; 
        }

        if(isset($_POST["slu_altas"]))
         { 
            $mantencion->slu_altas=true; 
        }else{
            $mantencion->slu_altas=false; 
        }


        if(isset($_POST["slu_freno"])) 
         { 
            $mantencion->slu_freno=true; 
        }else{
            $mantencion->slu_freno=false; 
        }

        if(isset($_POST["slu_matras"])) 
         { 
            $mantencion->slu_matras=true; 
        }else{
            $mantencion->slu_matras=false; 
        }

        if(isset($_POST["slu_vderecha"]))
         { 
            $mantencion->slu_vderecha=true; 
        }else{
            $mantencion->slu_vderecha=false; 
        }

        if(isset($_POST["slu_vizquierda"]))
         { 
            $mantencion->slu_vizquierda=true; 
        }else{
            $mantencion->slu_vizquierda=false; 
        }

        if(isset($_POST["slu_patente"]))
         { 
            $mantencion->slu_patente=true; 
        }else{
            $mantencion->slu_patente=false; 
        }

        if(isset($_POST["slu_tluz"]))
         { 
            $mantencion->slu_tluz=true; 
        }else{
            $mantencion->slu_tluz=false; 
        }

        //Fin sistema luces
      

        //Neumaticos
        if(isset($_POST["dderecho"]))
         { 
            $mantencion->dderecho=true; 
        }else{
            $mantencion->dderecho=false; 
        }

        if(isset($_POST["dizquierdo"]))
         { 
            $mantencion->dizquierdo=true; 
        }else{
            $mantencion->dizquierdo=false; 
        }

        if(isset($_POST["tderecho"]))
         { 
            $mantencion->tderecho=true; 
        }else{
            $mantencion->tderecho=false; 
        }

        if(isset($_POST["tizquierdo"]))
         { 
            $mantencion->tizquierdo=true; 
        }else{
            $mantencion->tizquierdo=false; 
        }        

        if(isset($_POST["repuesto"]))
         { 
            $mantencion->repuesto=true; 
        }else{
            $mantencion->repuesto=false; 
        }
        //Fin Neumaticos

        //Niveles / Motor
        if(isset($_POST["amotor"]))
         { 
            $mantencion->amotor=true; 
        }else{
            $mantencion->amotor=false; 
        }

        if(isset($_POST["aradiador"]))
         { 
            $mantencion->aradiador=true; 
        }else{
            $mantencion->aradiador=false; 
        }

        if(isset($_POST["lfrenos"]))
         { 
            $mantencion->lfrenos=true; 
        }else{
            $mantencion->lfrenos=false; 
        }

        if(isset($_POST["lhidraulico"]))
         { 
            $mantencion->lhidraulico=true; 
        }else{
            $mantencion->lhidraulico=false; 
        }

        if(isset($_POST["ebateria"]))
         { 
            $mantencion->ebateria=true; 
        }else{
            $mantencion->ebateria=false; 
        }        
        //Fin Niveles / Motor
            
        //Accesorios
        if(isset($_POST["extintor"]))
        { 
            $mantencion->extintor=true; 
        }else{
            $mantencion->extintor=false; 
        }

        if(isset($_POST["chaleco"]))
        { 
            $mantencion->chaleco=true; 
        }else{
            $mantencion->chaleco=false; 
        }

        if(isset($_POST["botiquin"]))
        { 
            $mantencion->botiquin=true; 
        }else{
            $mantencion->botiquin=false; 
        }

         if(isset($_POST["gata"]))
        { 
            $mantencion->gata=true; 
        }else{
            $mantencion->gata=false; 
        }        

        if(isset($_POST["lruedas"]))
        { 
            $mantencion->lruedas=true; 
        }else{
            $mantencion->lruedas=false; 
        }

        if(isset($_POST["triangulo"]))
        { 
            $mantencion->triangulo=true; 
        }else{
            $mantencion->triangulo=false; 
        }

        if(isset($_POST["lparabrisa"]))
        { 
            $mantencion->lparabrisa=true; 
        }else{
            $mantencion->lparabrisa=false; 
        }

        if(isset($_POST["cseguridad"]))
        { 
            $mantencion->cseguridad=true; 
        }else{
            $mantencion->cseguridad=false; 
        }

        if(isset($_POST["elaterales"]))
        { 
            $mantencion->elaterales=true; 
        }else{
            $mantencion->elaterales=false; 
        }

        if(isset($_POST["einterior"]))
        { 
            $mantencion->einterior=true; 
        }else{
            $mantencion->einterior=false; 
        }

        if(isset($_POST["bretroceso"]))
        { 
            $mantencion->bretroceso=true; 
        }else{
            $mantencion->bretroceso=false; 
        }

        if(isset($_POST["antena"]))
        { 
            $mantencion->antena=true; 
        }else{
            $mantencion->antena=false; 
        }
        //Fin Accesorios

        //Documentos
        if(isset($_POST["pcirculacion"]))
        { 
            $mantencion->pcirculacion=true; 
        }else{
            $mantencion->pcirculacion=false; 
        }

        if(isset($_POST["rtecnica"]))
        { 
            $mantencion->rtecnica=true; 
        }else{
            $mantencion->rtecnica=false; 
        }

        if(isset($_POST["sobligatorio"]))
        { 
            $mantencion->sobligatorio=true; 
        }else{
            $mantencion->sobligatorio=false; 
        }        
        //Fin Documentos

        //Estado General
        if(isset($_POST["techo"]))
        { 
            $mantencion->techo=true; 
        }else{
            $mantencion->techo=false; 
        }  

        if(isset($_POST["capot"]))
        { 
            $mantencion->capot=true; 
        }else{
            $mantencion->capot=false; 
        }

        if(isset($_POST["puertas"]))
        { 
            $mantencion->puertas=true; 
        }else{
            $mantencion->puertas=false; 
        }

        if(isset($_POST["vidrios"]))
        { 
            $mantencion->vidrios=true; 
        }else{
            $mantencion->vidrios=false; 
        }


        if(isset($_POST["tapabarros"]))
        { 
            $mantencion->tapabarros=true; 
        }else{
            $mantencion->tapabarros=false; 
        }   


        if(isset($_POST["parachoques"]))
        { 
            $mantencion->parachoques=true; 
        }else{
            $mantencion->parachoques=false; 
        }        

        if(isset($_POST["tescape"]))
        { 
            $mantencion->tescape=true; 
        }else{
            $mantencion->tescape=false; 
        } 

         if(isset($_POST["limpieza"]))
        { 
            $mantencion->limpieza=true; 
        }else{
            $mantencion->limpieza=false; 
        } 


        //Fin Estado General

        
        $mantencion->save();


        //cargamos el usuario logeado
         $id=Auth::User()->id; 
         $nombre=Auth::User()->name;
         $email=Auth::User()->email;
        //traemos el vehiculo asignado en la actualidad
        $vehiculo=DB::table('encargados as a')        
        ->join('users as t','a.id_users','=','t.id')
        ->join('detalle_asignaciones as d','a.id','=','d.id_encargado')
        ->join('vehiculo as v','v.id','=','d.id_vehiculo')
        ->select('v.id', 'v.nombre','v.marca', 'v.modelo')
        ->where('a.id','=', $id)   
        ->orwhere('d.id_devolucion','=',0)        
        ->orwhere('v.asignada','=',1)->get()->first();


         //obtenemos el ID la solicitud Grabada
          $id_solicitud = SolicitudMantencion::orderBy('id','desc')->first()->id;


         //vamos a buscar el kilometraje, fecha de solicitud y servicios solicitados
         $solicitudes=DB::table('solicitud_mantencion')->where('id','=', $id_solicitud)->get()->first();


        

          $fromEmail = $email;
          $fromName  = $nombre;
          $toEmail   = 'fecaceres@aj.cl';
          $toName = 'Ferdinando Caceres';


               //Se crea correo que es enviado a encargasdo de flota y solicitante
          Mail::send('Mail.solicitudMantencion',["solicitante"=>$nombre,"vehiculo"=>$vehiculo,"solicitud"=>$id_solicitud,"solicitudes"=>$solicitudes], function ($message) use($fromEmail,$fromName,$toEmail,$toName) {
              $message->from($fromEmail, $fromName);
              $message->sender($fromEmail, $fromName);
              $message->to($toEmail,$toName);   
              $message->cc('smoya@aj.cl','Sergio Moya');                               
              $message->subject('Solicitud de mantenciòn vehìculo');
             $message->priority(3);
             //$message->attach('pathToFile');
         }); 

            $notificacion = array (
               'message' => 'Solicitud enviada exitò',
               'alert-type' => 'success'

            );
        

        //return view("flota.vehiculo.mantencion",["id"=>$id,"nombre"=>$nombre,"vehiculo"=>$vehiculo])->with($notificacion);
        return Redirect::to('home')->with($notificacion);
        
    }

    public function mismantenciones($idusuario,$nombreuser,$idvehiculo,$vehiculonombre)
    {
        $vehiculo=DB::table('encargados as a')        
        ->join('users as t','a.id_users','=','t.id')
        ->join('detalle_asignaciones as d','a.id','=','d.id_encargado')
        ->join('vehiculo as v','v.id','=','d.id_vehiculo')
        ->select('t.name','v.id', 'v.nombre','v.marca', 'v.modelo')
        ->where('a.id','=', $idusuario)
        ->orwhere('d.id_devolucion','=',0)       
        ->orwhere('v.asignada','=',1)->get()->first();

        //cargamos las solcitudes generadas por el usuario logeado        
        $solicitudes=DB::table('solicitud_mantencion as a')        
        ->where('id_usuario','=', $idusuario)
        ->paginate(7);

       
       return view("flota.vehiculo.mismantenciones",["vehiculo"=>$vehiculo, 'solicitudes'=>$solicitudes]);
        

         /*
       | Acá comienza el proceso
         Codigo Angel Maturana   
       */
        /*$validator = Validator::make($request->all(),
        [
            'usuario_id' => 'required' //acá va el nombre del campo enviado por ajax o formulario y su validación (busca validaciones en laravel)
        ]);

        if($validator->fails()){
            //si falla la validación matamos la aplicación
            return 'error';
        }
        //si no falla continua la ejecución
        $solicitudes=DB::table('solicitud_mantencion as a')        
        ->where('id_usuario','=', $request->input('usuario_id'));
       return $solicitudes->get()->toJson();*/
       /*
        Fin codigo Angel Maturana
       */

    }

    public function storeplan()
    {
        $date = Carbon::now();

        $mantencion= new mnt_flotaaj;
        $mantencion->fecha=$date->format('Y/m/d');
        $mantencion->km_vehiculo=$_POST['km_vehiculo'];
        $mantencion->km_aplicar=$_POST['km_aplicar'];
        $mantencion->trabajos=$_POST['observaciones'];
        $mantencion->patente=$_POST['patente'];


         $notificacion = array (
               'message' => 'Mantención creada exitò',
               'alert-type' => 'success'

            );

         $notificacion_error = array (
               'message' => 'Ha ocorrido un error al tratar de crear la mantención',
               'alert-type' => 'error'

            );

        if ($mantencion->save()) {
           return Redirect::to('flota/vehiculo')->with($notificacion);     
        }else
        {
            return Redirect::to('flota/vehiculo')->with($notificacion);
        }



    }

    public function ver_mantenciones($id)
    {
         $tmantencion=DB::table('mnt_flotaaj as a')        
        ->select('a.id','a.fecha', 'a.km_vehiculo','a.km_aplicar','a.trabajos','a.patente')
        ->where([
            ['a.patente','=',$id],                    
          ])->get()->all();


        

        return view("flota.vehiculo.mis_Mantenciones",["tmantencion"=>$tmantencion]);
        
    }   
    
}
