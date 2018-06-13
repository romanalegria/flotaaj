<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;



use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use App\Zona;
use App\Http\Requests\ZonaRequest;

use DB;

use Alert;

class ZonaController extends Controller
{
     public function __construct()
    {

    }
    public function index(Request $request)
    {
        if ($request)
        {
        	$query=trim($request->get('searchText'));
            $zonas=DB::table('zonas as a')
            ->select('a.id','a.codigo','a.nombre')
            ->where('a.nombre','LIKE','%'.$query.'%')
            ->orwhere('a.codigo','LIKE','%'.$query.'%')
            ->orderBy('id','asc')
            ->paginate(7);
            return view('maestros.zonas.index',["zonas"=>$zonas,"searchText"=>$query]);
        }
    }

     public function create()
    {
        return view("maestros.zonas.create");
    }

    public function store (ZonaRequest $request)
    {
        $zona=new Zona;
        $zona->codigo=strtoupper($request->get('codigo'));
        $zona->nombre=strtoupper($request->get('nombre'));             
        $zona->save();

         if ($zona->save())
        {
          $notificacion = array (
                        'message' => 'Zona creada con exitò',
                        'alert-type' => 'success'

            );  
        }
        return Redirect::to('maestros/zonas')->with($notificacion);

    }

     public function show($id)
    {
        return view("maestros.zonas.show",["zona"=>Zona::findOrFail($id)]);
    }

    public function edit($id)
    {
    	$zona=Zona::findOrFail($id);
    	
        return view("maestros.zonas.edit",["zona"=>$zona]);
    }

    public function update(ZonaRequest $request,$id)
    {
        $zona=Zona::findOrFail($id);
        $zona->codigo=strtoupper($request->get('codigo'));      
		$zona->nombre=strtoupper($request->get('nombre'));      

        $zona->update();
       
        return Redirect::to('maestros/zonas');
    }

    public function destroy($id)
    {
        $area=Area::findOrFail($id);
        $area->delete();
        return Redirect::to('maestros/areas');
    }
}
