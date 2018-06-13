<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use App\Arriendo;


use App\Http\Requests\ArriendoCreateRequest;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Mail;

use DB;
use Validator;

class ArriendoController extends Controller
{
      public function __construct()
    {

    }


    public function index(Request $request)
    {
        if ($request)
        {
            $query=trim($request->get('searchText'));
            $arriendos=DB::table('detalle_arriendos as d')
            ->join('users as u','u.id','=','d.id_solicitante')          
            ->select('d.id','u.name','d.proyecto','d.valorCancelado','d.patente','d.marca','d.modelo','d.axo','d.color','d.factura','d.observaciones','d.fecha')
            ->where('u.name','LIKE','%'.$query.'%')
            ->orwhere('d.patente','LIKE','%'.$query.'%')
            ->orwhere('d.fecha','LIKE','%'.$query.'%')
            ->orderBy('id','desc')
            ->paginate(7);
            return view('arriendos.index',["arriendos"=>$arriendos,"searchText"=>$query]);
        }
    }

     public function create()
    {
    	$usuarios=DB::table('users')->where('id','>','0')->get();
    	//accedemos a la conexion e sql para traer los proyectos
    	$proyectos = DB::connection('sqlsrv')->select("select PrjCode,PrjName,Active from OPRJ WHERE Active='Y' ORDER BY PrjCode");
    	
        return view("arriendos.create",["usuarios"=>$usuarios,"proyectos"=>$proyectos]);
    }

     public function store (ArriendoCreateRequest $request)
    {
    	$date = Carbon::now();

    	$arriendo = new Arriendo;
    	$arriendo->id_solicitante = $request->get('usuario');
    	$arriendo->proyecto = $request->get('proyecto');
    	$arriendo->valorCancelado = $request->get('monto_cancelado');
    	$arriendo->factura = $request->get('factura');
    	$arriendo->fecha = $request->get('fecha');
    	$arriendo->fecha_sistema = $date;
    	$arriendo->marca= strtoupper($request->get('marca'));
    	$arriendo->modelo= strtoupper($request->get('modelo'));
    	$arriendo->axo = $request->get('axo');
    	$arriendo->color = $request->get('color');
        $arriendo->patente= strtoupper($request->get('patente'));
        $arriendo->observaciones= strtoupper($request->get('observaciones'));
    	

    	$arriendo->save();

    	  $notificacion = array (
                        'message' => 'Documento ingresado con exitò',
                        'alert-type' => 'success'

                     );

    	 return Redirect::to('arriendos')->with($notificacion);


    }

     public function show($id)
    {
        return view("arriendos.show",["arriendo"=>Arriendo::findOrFail($id)]);
    }

    public function edit($id)
    {
    	$arriendo=Arriendo::findOrFail($id);
    	$usuarios=DB::table('users')->where('id','>','0')->get();
        $proyectos = DB::connection('sqlsrv')->select("select PrjCode,PrjName,Active from OPRJ WHERE Active='Y' ORDER BY PrjCode");
        
        
       

        return view("arriendos.edit",["arriendo"=>$arriendo,"usuarios"=>$usuarios,"proyectos"=>$proyectos]);
    }

     public function update(ArriendoCreateRequest $request,$id)
    {
    	$date = Carbon::now();

        $arriendo=Arriendo::findOrFail($id);
        $arriendo->id_solicitante = $request->get('usuario');
    	$arriendo->proyecto = $request->get('proyecto');
    	$arriendo->valorCancelado = $request->get('monto_cancelado');
    	$arriendo->factura = $request->get('factura');
    	$arriendo->fecha = $request->get('fecha');
    	$arriendo->fecha_sistema = $date;
    	$arriendo->marca= strtoupper($request->get('marca'));
    	$arriendo->modelo= strtoupper($request->get('modelo'));
    	$arriendo->axo = $request->get('axo');
    	$arriendo->color = $request->get('color');
        $arriendo->patente= strtoupper($request->get('patente'));
        $arriendo->observaciones= strtoupper($request->get('observaciones'));
    	

    	$arriendo->update();

    	  $notificacion = array (
                        'message' => 'Documento modificado con exitò',
                        'alert-type' => 'success'

                     );

    	 return Redirect::to('arriendos')->with($notificacion);
    }


}
