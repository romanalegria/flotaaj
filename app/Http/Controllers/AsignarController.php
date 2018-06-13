<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use App\Asignacion;
use App\Vehiculo;
use App\Devolucion;
use App\AsignacionCheckList;
use App\Http\Requests\AsignarCreateRequest;
use Carbon\Carbon;
use Illuminate\Support\Collection as Collection;
use PDF;
use Response;

use DB;


class AsignarController extends Controller
{
   
       public function __construct()
    {

    }
    public function index(Request $request)
    {
        if ($request)
        {
            $query=trim($request->get('searchText'));
            $asignaciones=DB::table('detalle_asignaciones as a')
            ->join('encargados as c','a.id_encargado','=','c.id')
            ->join('vehiculo as d','a.id_vehiculo','=','d.id')            
            ->select('a.id','a.fecha_asignacion', 'c.nombres as encargado','c.apellidos as apellidos', 'd.patente','a.id_devolucion','a.foto1','a.foto2','a.foto3','a.foto4','a.km_entrega')
            ->where('c.nombres','LIKE','%'.$query.'%')
            ->orwhere('d.patente','LIKE','%'.$query.'%')            
            ->orderBy('id','desc')
            ->paginate(7);
            return view('asignaciones.index',["asignaciones"=>$asignaciones,"searchText"=>$query]);
        }
    }


    public function create()
    {
    	$encargados=DB::table('encargados')->where('id','>','0')->get();
    	$vehiculos=DB::table('vehiculo')->where('id','<>','0')->get();
        

        return view("asignaciones.create",["encargados"=>$encargados, "vehiculos"=>$vehiculos]);
    }

   


    public function store (AsignarCreateRequest $request)
      {

      	$date = Carbon::now();

        $asignacion=new Asignacion;
        $asignacion->id_encargado=$request->get('encargado');
        $asignacion->id_vehiculo=$request->get('vehiculo');        
        $asignacion->fecha_asignacion=$request->get('fecha_asignacion');  
        $asignacion->fecha_sistema= $date->format('Y/m/d');                 
        $asignacion->descripcion=$request->get('descripcion');   
		$asignacion->km_entrega=$request->get('km_entrega');   

         if (Input::hasFile('acta_entrega'))
         {
            $file=Input::file('acta_entrega');
            $file->move(public_path().'/imagenes/asignaciones/',$file->getClientOriginalName());
            $asignacion->acta_entrega=$file->getClientOriginalName();
        }     

        if (Input::hasFile('anexo_contrato'))
         {
            $file=Input::file('anexo_contrato');
            $file->move(public_path().'/imagenes/asignaciones/',$file->getClientOriginalName());
            $asignacion->anexo_contrato=$file->getClientOriginalName();
        }
        
        if (Input::hasFile('foto1'))
         {
            $file=Input::file('foto1');
            $file->move(public_path().'/imagenes/asignaciones/',$file->getClientOriginalName());
            $asignacion->foto1=$file->getClientOriginalName();
        }

        if (Input::hasFile('foto2'))
         {
            $file=Input::file('foto2');
            $file->move(public_path().'/imagenes/asignaciones/',$file->getClientOriginalName());
            $asignacion->foto2=$file->getClientOriginalName();
        }

        if (Input::hasFile('foto3'))
         {
            $file=Input::file('foto3');
            $file->move(public_path().'/imagenes/asignaciones/',$file->getClientOriginalName());
            $asignacion->foto3=$file->getClientOriginalName();
        } 

        if (Input::hasFile('foto4'))
         {
            $file=Input::file('foto4');
            $file->move(public_path().'/imagenes/asignaciones/',$file->getClientOriginalName());
            $asignacion->foto4=$file->getClientOriginalName();
        }

        $asignacion->save();

        //buscamos el vehiculo para cambiar estado de campo asignada
        $vehiculo=Vehiculo::findOrFail($asignacion->id_vehiculo);
        $vehiculo->asignada = 1;
        $vehiculo->update();   


        //almacenamos el detalle check-List de entrega 


        //Generamos el acta de entrega en formato PDF       
                     return Redirect('asignaciones/'.$asignacion->id.'/actaentrega');

    }





    public function pdfEntrega($identrega)
    {
        //$asignacion=Asignacion::findOrFail($identrega);
       
            $asignacion=DB::table('detalle_asignaciones as a')
            ->join('encargados as c','a.id_encargado','=','c.id')
            ->join('vehiculo as d','a.id_vehiculo','=','d.id')            
            ->select('a.id','a.fecha_asignacion', 'c.nombres as encargado','c.apellidos as apellidos','c.rut','c.telefono','d.patente','d.numserie','d.nombre','d.marca','d.axo','d.color','d.kilometraje','d.modelo','a.descripcion','a.km_entrega')
            ->where('a.id','=',$identrega)->first();
            
            
            //print_r($asignacion);

        $pdf = PDF::loadView('asignaciones.actaEntrega',["asignacion"=>$asignacion]);

        return $pdf->stream('acta_entrega.pdf');
    }

   

   



    public function show($id)
    {
        return view("asignaciones.show",["asignacion"=>Asignacion::findOrFail($id)]);
    }

    public function edit($id)
    {
    	$asignacion=Asignacion::findOrFail($id);
    	$encargados=DB::table('encargados')->where('id','>','0')->get();        
        $vehiculo=DB::table('vehiculo as a')        
        ->join('detalle_asignaciones as t','a.id','=','t.id_vehiculo')
        ->select('a.patente','t.id','a.id','t.id_vehiculo', 'a.nombre','a.marca', 'a.modelo','t.foto1','t.foto2','t.foto3','t.foto4','t.km_entrega')
        ->where('t.id','=', $id)->get()->first();

        $vehiculos=DB::table('vehiculo')->where('asignada','=',null)->get(); 
       
       	
       
               

       return view("asignaciones.edit",["asignacion"=>$asignacion, "vehiculo"=>$vehiculo,"encargados"=>$encargados,"vehiculos"=>$vehiculos]);
    }


    public function edit_asignacion($id)
    {
        $asignacion=DB::table('detalle_asignaciones as a')
        ->join('encargados as c','a.id_encargado','=','c.id')
        ->join('vehiculo as d','a.id_vehiculo','=','d.id')            
        ->select('a.id','a.fecha_asignacion', 'c.nombres as encargado','c.apellidos as apellidos','c.rut','c.telefono','d.patente','d.numserie','d.nombre','d.marca','d.axo','d.color','d.kilometraje','d.modelo','a.descripcion','a.km_entrega')
            ->where('a.id','=',$id)->first();  
                            

       return view("asignaciones.devolucion",["asignacion"=>$asignacion]);
        
    }


     public function ver_asignaciones($patente)

    {
       
        $tasignacion=DB::table('detalle_asignaciones as a')
        ->join('encargados as c','a.id_encargado','=','c.id')
        ->join('vehiculo as d','a.id_vehiculo','=','d.id')            
        ->select('a.id','a.fecha_asignacion','a.id_devolucion','a.fecha_devolucion', 'c.nombres as encargado','c.apellidos as apellidos','c.rut','c.telefono','d.patente','d.numserie','d.nombre','d.marca','d.axo','d.color','d.kilometraje','d.modelo','a.descripcion','a.km_entrega')
        ->where('d.patente','=',$patente)->get()->all();
         

        return view("asignaciones.misAsignaciones",["tasignacion"=>$tasignacion]);
       //return Response::json($tasignacion, 200);
        //return Redirect::to('asignaciones',["tasignacion"=>$tasignacion]);
        
    }

     public function verUnaAsignacion($id)

    {
       
        $tasignacion=DB::table('detalle_asignaciones as a')
        ->join('encargados as c','a.id_encargado','=','c.id')
        ->join('vehiculo as d','a.id_vehiculo','=','d.id')            
        ->select('a.id','a.fecha_asignacion','a.id_devolucion','a.fecha_devolucion', 'c.nombres as encargado','c.apellidos as apellidos','c.rut','c.telefono','d.patente','d.numserie','d.nombre as nomveh','d.marca','d.axo','d.color','d.kilometraje','d.modelo','a.descripcion','a.acta_entrega','a.anexo_contrato','a.km_entrega')
        ->where('a.id','=',$id)->get()->first();         
        
        
        return view("asignaciones.verAsignacion",["tasignacion"=>$tasignacion]);
       //return Response::json($tasignacion, 200);
        //return Redirect::to('asignaciones',["tasignacion"=>$tasignacion]);
        
    }
    


    public function update(AsignarCreateRequest $request,$id)
    {

    	$date = Carbon::now();
	
        $asignacion=Asignacion::findOrFail($id); 
        $id_vehiculo_antes=$asignacion->id_vehiculo;   
        $asignacion->id_encargado=$request->get('encargado');
        $asignacion->id_vehiculo=$request->get('vehiculo');        
        $asignacion->fecha_asignacion=$request->get('fecha_asignacion');  
        $asignacion->fecha_sistema= $date->format('Y/m/d');                 
        $asignacion->descripcion=$request->get('descripcion');
		$asignacion->km_entrega=$request->get('km_entrega');
		

         if (Input::hasFile('acta_entrega'))
         {
            $file=Input::file('acta_entrega');
            $file->move(public_path().'/imagenes/asignaciones/',$file->getClientOriginalName());
            $asignacion->acta_entrega=$file->getClientOriginalName();
        }   

         if (Input::hasFile('anexo_contrato'))
         {
            $file=Input::file('anexo_contrato');
            $file->move(public_path().'/imagenes/asignaciones/',$file->getClientOriginalName());
            $asignacion->anexo_contrato=$file->getClientOriginalName();
        }        

         if (Input::hasFile('foto1'))
         {
            $file=Input::file('foto1');
            $file->move(public_path().'/imagenes/asignaciones/',$file->getClientOriginalName());
            $asignacion->foto1=$file->getClientOriginalName();
        }

        if (Input::hasFile('foto2'))
         {
            $file=Input::file('foto2');
            $file->move(public_path().'/imagenes/asignaciones/',$file->getClientOriginalName());
            $asignacion->foto2=$file->getClientOriginalName();
        }

        if (Input::hasFile('foto3'))
         {
            $file=Input::file('foto3');
            $file->move(public_path().'/imagenes/asignaciones/',$file->getClientOriginalName());
            $asignacion->foto3=$file->getClientOriginalName();
        } 

        if (Input::hasFile('foto4'))
         {
            $file=Input::file('foto4');
            $file->move(public_path().'/imagenes/asignaciones/',$file->getClientOriginalName());
            $asignacion->foto4=$file->getClientOriginalName();
        }




        $asignacion->update();
        
        //buscamos el vehiculo actual asignado para cambiar el estado a null, null=no asignado
        $vehiculo=Vehiculo::findOrFail($id_vehiculo_antes);
        $vehiculo->asignada = null;
        $vehiculo->update();

       //buscamos el vehiculo para cambiar estado de campo asignada
        $vehiculo=Vehiculo::findOrFail($asignacion->id_vehiculo);
        $vehiculo->asignada = 1;
        $vehiculo->update();

        //


       return Redirect::to('asignaciones');

    }


    public function destroy($id)
    {
        $asignacion=Asignacion::findOrFail($id);     
        $asignacion->delete();
        return Redirect::to('asignaciones');
    }

    
}
