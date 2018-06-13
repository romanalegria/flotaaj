<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use App\Area;
use App\Http\Requests\AreaCreateRequest;

use DB;

use Alert;

class AreaController extends Controller
{
    public function __construct()
    {

    }
    public function index(Request $request)
    {
        if ($request)
        {
        	$query=trim($request->get('searchText'));
            $areas=DB::table('areas as a')
            ->select('a.id','a.codigo','a.nombre')
            ->where('a.nombre','LIKE','%'.$query.'%')
            ->orwhere('a.codigo','LIKE','%'.$query.'%')
            ->orderBy('id','asc')
            ->paginate(7);
            return view('maestros.areas.index',["areas"=>$areas,"searchText"=>$query]);
        }
    }

     public function create()
    {
        return view("maestros.areas.create");
    }

    public function store (AreaCreateRequest $request)
    {
        $area=new Area;
        $area->codigo=strtoupper($request->get('codigo'));
        $area->nombre=strtoupper($request->get('nombre'));             
        
        if ($area->save())
        {
          $notificacion = array (
                        'message' => 'Zona creada con exitò',
                        'alert-type' => 'success'

            );  
        }

          

        return Redirect::to('maestros/areas')->with($notificacion);

    }

     public function show($id)
    {
        return view("maestros.areas.show",["area"=>Area::findOrFail($id)]);
    }

    public function edit($id)
    {
    	$area=Area::findOrFail($id);
    	
        return view("maestros.areas.edit",["area"=>$area]);
    }

    public function update(AreaCreateRequest $request,$id)
    {
        $area=Area::findOrFail($id);
        $area->codigo=strtoupper($request->get('codigo'));      
		$area->nombre=strtoupper($request->get('nombre'));      

        $area->update();
       
        return Redirect::to('maestros/areas');
    }

    public function destroy($id)
    {
        $area=Area::findOrFail($id);
        $area->delete();
        return Redirect::to('maestros/areas');
    }
}
