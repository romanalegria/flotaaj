<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use App\Devolucion;
use App\Vehiculo;
use App\Asignacion;
use App\Http\Requests\DevolucionCreateRequest;
use Carbon\Carbon;
use PDF;
use Response;

use DB;


class DevolucionController extends Controller
{
     public function devolucion (DevolucionCreateRequest $request)
	 {

        

        //vamos a buscar la asignacion primero
        $asignacion=DB::table('detalle_asignaciones as a')
        ->join('encargados as c','a.id_encargado','=','c.id')
        ->join('vehiculo as d','a.id_vehiculo','=','d.id')            
        ->select('a.id_encargado','a.id_vehiculo', 'a.id')
            ->where('a.id','=',$request->get('id_asignacion'))->first();  

        

         $date = Carbon::now();

         $devolucion=new Devolucion;
         $devolucion->id_encargado=$asignacion->id_encargado;
         $devolucion->id_vehiculo=$asignacion->id_vehiculo;
         $devolucion->fecha_devolucion=$request->get('fecha_devolucion');  
         $devolucion->fecha_sistema= $date->format('Y/m/d');                 
         $devolucion->descripcion=$request->get('descripcion');
         $devolucion->id_asignacion=$asignacion->id;
         $devolucion->km_devolucion=$request->get('km_devolucion');


          if (Input::hasFile('acta_devolucion'))
          {
             $file=Input::file('acta_devolucion');
             $file->move(public_path().'/imagenes/asignaciones/',$file->getClientOriginalName());
             $asignacion->acta_entrega=$file->getClientOriginalName();
         }     
        
         $devolucion->save();

         //obtenemos el ID de la devolucion generada
         $id_devolucion = Devolucion::orderBy('id','desc')->first()->id;

        // //buscamos el vehiculo para cambiar estado de campo asignada
         $vehiculo=Vehiculo::findOrFail($asignacion->id_vehiculo);
         $vehiculo->asignada = 0;
         $vehiculo->update();   

         // actualizamos la asignacion para agregar el id y fecha de devolucion
         $asignacion=Asignacion::findOrFail($asignacion->id);        
         $asignacion->fecha_devolucion=$request->get('fecha_devolucion'); 
         $asignacion->id_devolucion=$id_devolucion;
         $asignacion->update();


         

        //Generamos el acta de devolucion en formato PDF
         return Redirect('asignaciones/'.$id_devolucion.'/actadevolucion');
        
      
        
        //return Redirect('asignaciones/'.$asignacion->id.'/actaentrega');

    }

      public function pdfDevolucion($iddevolucion)
    {
        //$asignacion=Asignacion::findOrFail($identrega);
       
            $asignacion=DB::table('detalle_devoluciones as a')
            ->join('encargados as c','a.id_encargado','=','c.id')
            ->join('vehiculo as d','a.id_vehiculo','=','d.id')            
            ->select('a.id','a.fecha_devolucion', 'c.nombres as encargado','c.apellidos as apellidos','c.rut','c.telefono','d.patente','d.numserie','d.nombre','d.marca','d.axo','d.color','d.kilometraje','d.modelo','a.descripcion','km_devolucion')
            ->where('a.id','=',$iddevolucion)->first();
            
            
            print_r($asignacion);

        $pdf = PDF::loadView('asignaciones.actaDevolucion',["asignacion"=>$asignacion]);        

        //mensaje
          $notificacion = array (
                        'message' => 'Devolucion aprobada con exitò',
                        'alert-type' => 'success'

                     );
        return $pdf->stream('acta_devolucion.pdf');
    }

      public function verDevolucion($id)

    {
       
        $tdevolucion=DB::table('detalle_devoluciones as a')
        ->join('users as c','a.id_encargado','=','c.id') 
        ->join('vehiculo as v','a.id_vehiculo','=','v.id')       
        ->select('a.id','a.fecha_devolucion', 'c.name as nombre','a.descripcion','v.nombre as nomveh','v.marca','v.modelo','v.axo','v.patente','a.km_devolucion')
        ->where('a.id','=',$id)->first();                         

        

        return view("asignaciones.verDevolucion",["tdevolucion"=>$tdevolucion]);
       //return Response::json($tasignacion, 200);
        //return Redirect::to('asignaciones',["tasignacion"=>$tasignacion]);
        
    }
}
