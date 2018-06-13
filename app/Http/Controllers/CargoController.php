<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use App\Cargo;
use App\Http\Requests\CargoCreateRequest;

use DB;

use Alert;

class CargoController extends Controller
{
        public function __construct()
    {

    }
    public function index(Request $request)
    {
        if ($request)
        {
        	$query=trim($request->get('searchText'));
            $cargos=DB::table('cargo as a')
            ->select('a.id','a.nombre')
            ->where('a.nombre','LIKE','%'.$query.'%')            
            ->orderBy('id','asc')
            ->paginate(7);
            return view('maestros.cargos.index',["cargos"=>$cargos,"searchText"=>$query]);
        }
    }

     public function create()
    {
        return view("maestros.cargos.create");
    }

    public function store (CargoCreateRequest $request)
    {
        $cargo=new Cargo;
        $cargo->nombre=strtoupper($request->get('nombre'));             
        $cargo->save();
        return Redirect::to('maestros/cargos');

    }

     public function show($id)
    {
        return view("maestros.cargos.show",["cargo"=>Cargo::findOrFail($id)]);
    }

    public function edit($id)
    {
    	$cargo=Ccargo::findOrFail($id);
    	
        return view("maestros.cargos.edit",["cargo"=>$cargo]);
    }

    public function update(CargoCreateRequest $request,$id)
    {
        $cargo=Cargo::findOrFail($id);        
		$cargo->nombre=strtoupper($request->get('nombre'));             
        $cargo->update();
       
        return Redirect::to('maestros/cargos');
    }

    public function destroy($id)
    {
        $cargo=Cargo::findOrFail($id);
        $cargo->delete();
        return Redirect::to('maestros/cargos');
    }
}
