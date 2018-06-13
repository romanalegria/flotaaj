<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Vehiculo;
use App\SolicitudMantencion;

use DB;

class ExcelController extends Controller
{
    //

	public function index()
	{
		 Excel::create('Laravel Excel', function($excel) {
 
            $excel->sheet('Vehiculos', function($sheet) {
 
                //$vehiculos = Vehiculo::all();
                $vehiculos = Vehiculo::select('vehiculo.id','vehiculo.nombre','vehiculo.marca','vehiculo.modelo','vehiculo.axo','d.nombre as categoria','e.nombre as estado','vehiculo.tipocombustible','vehiculo.numserie','vehiculo.patente','vehiculo.color','f.nombre as Area', 'c.nombres as encargado', 'vehiculo.empresa','vehiculo.foto1','vehiculo.foto2','vehiculo.foto3','vehiculo.foto4','vehiculo.foto5','vehiculo.foto6')
                                        ->join('encargados as c','vehiculo.encargado','=','c.id')
                                        ->join('categoria as d','vehiculo.tipovehiculo','=','d.id')
                                        ->join('estado_vehiculo as e','vehiculo.estadovehiculo','=','e.id')
                                        ->join('areas as f','vehiculo.areanegocio','=','f.id')
                                        ->get()
                                        ->toArray();
                /*  $vehiculos=DB::table('vehiculo as a')
                    ->join('encargados as c','a.encargado','=','c.id')
                    ->join('categoria as d','a.tipovehiculo','=','d.id')
                    ->join('estado_vehiculo as e','a.estadovehiculo','=','e.id')
                    ->join('areas as f','a.areanegocio','=','f.id')
                    ->select('a.id','a.nombre','a.marca','a.modelo','a.axo','d.nombre as categoria','e.nombre as estado','a.tipocombustible','a.numserie','a.patente','a.color','f.nombre as Area', 'c.nombres as encargado', 'a.empresa','a.foto1','a.foto2','a.foto3','a.foto4','a.foto5','a.foto6')->get()->toArray();*/
 
                $sheet->fromArray($vehiculos);
 
            });
        })->export('xls');
	}


    public function mismantenciones_excel()
    {
         Excel::create('Mis Mantenciones', function($excel) {
 
            $excel->sheet('Mis mantenciones', function($sheet) {
 
                
                $mantenciones=SolicitudMantencion::select('solicitud_mantencion.id','solicitud_mantencion.fecha_creacion','solicitud_mantencion.observaciones')
                    ->get()
                    ->toArray();
               
 
                $sheet->fromArray($mantenciones);
 
            });
        })->export('xls');
    }    


}
