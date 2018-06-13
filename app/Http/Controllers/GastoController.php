<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use App\Gasto;
use App\Http\Requests\GastoCreateRequest;

use DB;

use Alert;

class GastoController extends Controller
{
    public function __construct()
    {

    }
    public function index(Request $request)
    {
        if ($request)
        {
        	$query=trim($request->get('searchText'));
            $gastos=DB::table('fnd_tipo_gasto as a')
            ->select('a.id','a.detalle')
            ->where('a.detalle','LIKE','%'.$query.'%')            
            ->orderBy('id','asc')
            ->paginate(7);
            return view('maestros.gastos.index',["gastos"=>$gastos,"searchText"=>$query]);
        }
    }

     public function create()
    {
        return view("maestros.gastos.create");
    }

    public function store (GastoCreateRequest $request)
    {
        $gasto=new Gasto;
        $gasto->detalle=strtoupper($request->get('detalle'));             
        $gasto->save();
        return Redirect::to('maestros/gastos');

    }

     public function show($id)
    {
        return view("maestros.gastos.show",["gasto"=>Gastos::findOrFail($id)]);
    }

    public function edit($id)
    {
    	$gasto=Gasto::findOrFail($id);
    	
        return view("maestros.gastos.edit",["gasto"=>$gasto]);
    }

    public function update(GastoCreateRequest $request,$id)
    {
        $gasto=Gasto::findOrFail($id);        
		$gasto->detalle=strtoupper($request->get('detalle'));             
        $gasto->update();
       
        return Redirect::to('maestros/gastos');
    }

    public function destroy($id)
    {
        $gasto=Gasto::findOrFail($id);
        $gasto->delete();
        return Redirect::to('maestros/gastos');
    }
}
