<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use App\Documento;
use App\Http\Requests\DocumentoCreateRequest;

use DB;



class DocumentoController extends Controller
{
      public function __construct()
    {

    }
    public function index(Request $request)
    {
        if ($request)
        {
        	$query=trim($request->get('searchText'));
            $documentos=DB::table('tipo_documento as a')
            ->select('a.id','a.codigo','a.nombre')
            ->where('a.nombre','LIKE','%'.$query.'%')
            ->orwhere('a.codigo','LIKE','%'.$query.'%')
            ->orderBy('id','asc')
            ->paginate(7);
            return view('maestros.documentos.index',["documentos"=>$documentos,"searchText"=>$query]);
        }
    }

     public function create()
    {
        return view("maestros.documentos.create");
    }

    public function store (DocumentoCreateRequest $request)
    {
        $documento=new Documento;
        $documento->codigo=strtoupper($request->get('codigo'));
        $documento->nombre=strtoupper($request->get('nombre'));             
        $documento->save();
        return Redirect::to('maestros/documentos');

    }

     public function show($id)
    {
        return view("maestros.documentos.show",["documento"=>Documento::findOrFail($id)]);
    }

    public function edit($id)
    {
    	$documento=Documento::findOrFail($id);
    	
        return view("maestros.documentos.edit",["documento"=>$documento]);
    }

    public function update(DocumentoCreateRequest $request,$id)
    {
        $documento=Documento::findOrFail($id);
        $documento->codigo=strtoupper($request->get('codigo'));      
		$documento->nombre=strtoupper($request->get('nombre'));      

        $documento->update();
       
        return Redirect::to('maestros/documentos');
    }

    public function destroy($id)
    {
        $documento=Dpcumento::findOrFail($id);
        $documento->delete();
        return Redirect::to('maestros/documentos');
    }
}
