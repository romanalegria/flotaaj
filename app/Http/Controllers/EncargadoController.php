<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use App\Encargado;
use App\Http\Requests\EncargadoCreateRequest;

use DB;


class EncargadoController extends Controller
{
    public function __construct()
    {

    }
    public function index(Request $request)
    {
        if ($request)
        {
        	$query=trim($request->get('searchText'));
            $encargados=DB::table('encargados as a')
            ->select('a.id','a.rut','a.nombres','a.apellidos','a.telefono','a.licencia','a.fecha_vencimiento')
            ->join('cargo as c','a.codcargo','=','c.id')
            ->join('areas as d','a.codarea','=','d.id')
            ->where('a.nombres','LIKE','%'.$query.'%')
            ->orwhere('a.apellidos','LIKE','%'.$query.'%')
            ->orderBy('id','asc')
            ->paginate(7);
            return view('maestros.encargados.index',["encargados"=>$encargados,"searchText"=>$query]);
        }
    }

     public function create()
    {
        $areas=DB::table('areas')->where('id','>','0')->get();
        $cargos=DB::table('cargo')->where('id','>','0')->get();
        $usuarios=DB::table('users')->where('id','>','0')->get();

        return view("maestros.encargados.create",["areas"=>$areas, "cargos"=>$cargos,"usuarios"=>$usuarios]);
    }

    public function store (EncargadoCreateRequest $request)
    {
        $encargado=new Encargado;
        $encargado->rut=$request->get('rut');
        $encargado->nombres= strtoupper($request->get('nombres'));             
        $encargado->apellidos=strtoupper($request->get('apellidos'));             
        $encargado->telefono=$request->get('telefono');
        $encargado->codcargo=$request->get('cargo');
        $encargado->codarea=$request->get('area');

        if (Input::hasFile('licencia'))
         {
        	$file=Input::file('licencia');
        	$file->move(public_path().'/imagenes/licencias/',$file->getClientOriginalName());
        	$encargado->licencia=$file->getClientOriginalName();
        }else{
            $encargado->licencia="sinfoto";
        }            	     

        $encargado->fecha_vencimiento=$request->get('fechav');
        $encargado->id_users=$request->get('usuario');

        $encargado->save();
        
        return Redirect::to('maestros/encargados');

    }

     public function show($id)
    {
        return view("maestros.encargados.show",["encargado"=>Encargado::findOrFail($id)]);
    }

    public function edit($id)
    {
    	$encargados=Encargado::findOrFail($id);
    	$areas=DB::table('areas')->where('id','>','0')->get();
        $cargos=DB::table('cargo')->where('id','>','0')->get();
        $usuarios=DB::table('users')->where('id','>','0')->get();

        return view("maestros.encargados.edit",["encargado"=>$encargados,"areas"=>$areas, "cargos"=>$cargos,"usuarios"=>$usuarios]);
    }

    public function update(EncargadoCreateRequest $request,$id)
    {
        $encargado=Encargado::findOrFail($id);
        $encargado->rut=$request->get('rut');
        $encargado->nombres= strtoupper($request->get('nombres'));             
        $encargado->apellidos=strtoupper($request->get('apellidos'));                  
        $encargado->telefono=$request->get('telefono');
        $encargado->codcargo=$request->get('cargo');
        $encargado->codarea=$request->get('area');

     	 if (Input::hasFile('licencia'))
         {
        	$file=Input::file('licencia');
        	$file->move(public_path().'/imagenes/licencias/',$file->getClientOriginalName());
        	$encargado->licencia=$file->getClientOriginalName();
        }else{
            $encargado->licencia="sinfoto";
        }    

        $encargado->fecha_vencimiento=$request->get('fechav');
        $encargado->id_users=$request->get('usuario');

        $encargado->update();
        
        return Redirect::to('maestros/encargados');
    }

    public function destroy($id)
    {
        $encargado=Encargado::findOrFail($id);
        $encargado->delete();
        return Redirect::to('maestros/encargados');
    }
}
