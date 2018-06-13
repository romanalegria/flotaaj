<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use App\Incidencia_Ssgg;
use Auth;
use App\Http\Requests\SsggCreateRequest;
use Carbon\Carbon;
use App\Mail\GeneraIncidencia;
use Mail;
use DB;



class SsggController extends Controller
{
    
   public function __construct()
    {

    }

    public function index(Request $request)
    {
        if ($request)
        {
            $query=trim($request->get('searchText'));
            $incidencias=DB::table('incidencia_ssgg as a')
            ->join('users as u','u.id','=','a.id_user')
            ->select('a.id','a.sucursal','a.severidad','a.asignado','a.resumen','a.descripcion','a.fecha_creacion','a.fecha_cierre','u.name')
            ->where('a.resumen','LIKE','%'.$query.'%')
            ->orwhere('a.descripcion','LIKE','%'.$query.'%')           
            ->orderBy('id','desc')
            ->paginate(7);


            return view('Tickets.ssgg.index',["incidencias"=>$incidencias,"searchText"=>$query]);
        }
    }

   

     
     public function create()
    {
        return view("Tickets.ssgg.create");
    }

     public function store (SsggCreateRequest $request)
    {
    	       

    }

     public function edit($id)
    {
    	$incidencia=Incidencia_Ssgg::findOrFail($id); 
        $usuario=DB::table('incidencia_ssgg as a')
        ->join('users as u','a.id_user','=','u.id')
        ->select('u.name')->get()->first();       	

        return view("Tickets.ssgg.edit",["incidencia"=>$incidencia,"usuario"=>$usuario]);
    }

     public function update(SsggCreateRequest $request,$id)
    {
       

		$incidencia=Incidencia_Ssgg::findOrFail($id);         
        $incidencia->sucursal= $request->get('sucursal');
        $incidencia->severidad= $request->get('severidad');
        $incidencia->asignado= $request->get('asignado');
        $incidencia->resumen= $request->get('resumen');
        $incidencia->descripcion= $request->get('descripcion');        
        $incidencia->fecha_cierre= $request->get('fechac');        
        $incidencia->observaciones= $request->get('observaciones');        



        if( $incidencia->update())
        {

            //futuro envio de correo indicando que se termino el ticket


            return (json_encode('ok'));
        }else
        {
            
        }
       
         
    }



    public function destroy($id)
    {
        $incidencia=Incidencia_Ssgg::findOrFail($id);        	
        $incidencia->delete();
        return Redirect::to('Tickets/ssgg');
    }


     public function crearssgg (SsggCreateRequest $request)    
    {       

        //cargamos el usuario logeado
         $idLog=Auth::User()->id; 
         $nombre=Auth::User()->name;
         $email=Auth::User()->email;    


    	$date = Carbon::now();

        $incidencia=new Incidencia_Ssgg();
        $incidencia->sucursal= $request->get('sucursal');
        $incidencia->severidad= $request->get('severidad');
        $incidencia->asignado= $request->get('asignado');
        $incidencia->resumen= $request->get('resumen');
        $incidencia->descripcion= $request->get('descripcion');
        $incidencia->fecha_creacion= $date->format('Y/m/d');
		$incidencia->id_user= $idLog;

         if ($incidencia->save()) {

            //obtenemos el ID la solicitud Grabada
            $id_solicitud = Incidencia_Ssgg::orderBy('id','desc')->first()->id;

            //cargamos la incidencia recien creada
            $incidencia=Incidencia_Ssgg::findOrFail($id_solicitud); 
            $usuario=DB::table('incidencia_ssgg as a')
            ->join('users as u','a.id_user','=','u.id')
            ->select('u.name')->get()->first();             
            

            //generacion de mail indicando la solicitud de ticket
             $fromEmail = 'fecaceres@aj.cl';
             $fromName = 'Ferdinando Caceres';
             $toEmail = $email;
             $toName = $nombre;
             
            

              Mail::send('Mail.TicketSSGG',["incidencia"=>$incidencia,"usuario"=>$usuario], function ($message) use($fromEmail,$fromName,$toEmail,$toName) {
                 $message->from($toEmail,$toName);
                 $message->sender($fromEmail, $fromName);
                 $message->to($fromEmail, $fromName);   
                 $message->cc('eroman@aj.cl', 'emilio roman');                               
                 $message->subject('Solicitud de SSGG');
                 $message->priority(3);
                 //$message->attach('pathToFile');
             }); 



            return Redirect::to('Tickets/ssgg');
         }else
         {

         } 

        
        //return view('Tickets.ssgg.index',["incidencias"=>$incidencia]);
       
       



       //Mail::to('eroman@aj.cl')->send(new GeneraIncidencia('Emilio Roman'));	
      
      

        //Mail::send('emails.contact', $incidencia->all(), function($msj){
       // 	$msj->subject('Correo de Contacto');
       //	$msj->to('eroman@gaj.cl');

       // 	Session::flash('message','Mensaje enviado correctamente');
        //	return Redirect::to('Tickets/ssgg/create');
        //});


      
        

    }


}
