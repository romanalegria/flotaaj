<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use App\Categoria;
use App\Http\Requests\CategoriaCreateRequest;

use DB;

use Alert;

class CategoriaController extends Controller
{
      public function __construct()
    {

    }
    public function index(Request $request)
    {
        if ($request)
        {
        	$query=trim($request->get('searchText'));
            $categorias=DB::table('categoria as a')
            ->select('a.id','a.nombre')
            ->where('a.nombre','LIKE','%'.$query.'%')            
            ->orderBy('id','asc')
            ->paginate(7);
            return view('maestros.categorias.index',["categorias"=>$categorias,"searchText"=>$query]);
        }
    }

     public function create()
    {
        return view("maestros.categorias.create");
    }

    public function store (CategoriaCreateRequest $request)
    {
        $categoria=new Categoria;
        $categoria->nombre=$request->get('nombre');             
        $categoria->save();
        return Redirect::to('maestros/categorias');

    }

     public function show($id)
    {
        return view("maestros.categorias.show",["categoria"=>Categoria::findOrFail($id)]);
    }

    public function edit($id)
    {
    	$categoria=Categoria::findOrFail($id);
    	
        return view("maestros.categorias.edit",["categoria"=>$categoria]);
    }

    public function update(CategoriaCreateRequest $request,$id)
    {
        $categoria=Categoria::findOrFail($id);        
		$categoria->nombre=$request->get('nombre');      

        $categoria->update();
       
        return Redirect::to('maestros/categorias');
    }

    public function destroy($id)
    {
        $categoria=Categoria::findOrFail($id);
        $categoria->delete();
        return Redirect::to('maestros/categorias');
    }
}
