<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use App\EstadoVehiculo;
use App\Http\Requests\EstadoCreateRequest;

use DB;

use Alert;

class EstadoController extends Controller
{
     public function __construct()
    {

    }
    public function index(Request $request)
    {
        if ($request)
        {
        	$query=trim($request->get('searchText'));
            $estados=DB::table('estado_vehiculo as a')
            ->select('a.id','a.nombre')
            ->where('a.nombre','LIKE','%'.$query.'%')            
            ->orderBy('id','asc')
            ->paginate(7);
            return view('maestros.estados.index',["estados"=>$estados,"searchText"=>$query]);
        }
    }

     public function create()
    {
        return view("maestros.estados.create");
    }

    public function store (EstadoCreateRequest $request)
    {
        $estado=new EstadoVehiculo;
        $estado->nombre=$request->get('nombre');             
        $estado->save();
        return Redirect::to('maestros/estados');

    }

     public function show($id)
    {
        return view("maestros.estados.show",["estado"=>EstadoVehiculo::findOrFail($id)]);
    }

    public function edit($id)
    {
    	$estado=EstadoVehiculo::findOrFail($id);
    	
        return view("maestros.estados.edit",["estado"=>$estado]);
    }

    public function update(EstadoCreateRequest $request,$id)
    {
        $estado=EstadoVehiculo::findOrFail($id);        
		$estado->nombre=$request->get('nombre');      

        $estado->update();
       
        return Redirect::to('maestros/estados');
    }

    public function destroy($id)
    {
        $estado=EstadoVehiculo::findOrFail($id);
        $estado->delete();
        return Redirect::to('maestros/estados');
    }
}
