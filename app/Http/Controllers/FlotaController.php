<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use App\TipoFlota;
use App\Http\Requests\FlotaCreateRequest;

use DB;



class FlotaController extends Controller
{
        public function __construct()
    {

    }
    public function index(Request $request)
    {
        if ($request)
        {
        	$query=trim($request->get('searchText'));
            $flotas=DB::table('tipo_flota as a')
            ->select('a.id','a.nombre')
            ->where('a.nombre','LIKE','%'.$query.'%')            
            ->orderBy('id','asc')
            ->paginate(7);
            return view('maestros.flotas.index',["flotas"=>$flotas,"searchText"=>$query]);
        }
    }

     public function create()
    {
        return view("maestros.flotas.create");
    }

    public function store (FlotaCreateRequest $request)
    {
        $flota=new TipoFlota;
        $flota->nombre=$request->get('nombre');             
        $flota->save();
        return Redirect::to('maestros/flotas');

    }

     public function show($id)
    {
        return view("maestros.flotas.show",["flota"=>TipoFlota::findOrFail($id)]);
    }

    public function edit($id)
    {
    	$flota=TipoFlota::findOrFail($id);
    	
        return view("maestros.flotas.edit",["flota"=>$flota]);
    }

    public function update(FlotaCreateRequest $request,$id)
    {
        $flota=TipoFlota::findOrFail($id);        
		$flota->nombre=$request->get('nombre');      

        $flota->update();
       
        return Redirect::to('maestros/flotas');
    }

    public function destroy($id)
    {
        $flota=TipoFlota::findOrFail($id);
        $flota->delete();
        return Redirect::to('maestros/flotas');
    }
}
