<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use App\Tope;
use App\Http\Requests\TopeCreateRequest;

use DB;

class TopeController extends Controller
{
     public function __construct()
    {

    }
    public function index(Request $request)
    {
        if ($request)
        {
        	$query=trim($request->get('searchText'));
            $topes=DB::table('fnd_tope_zona_gasto as a')            
            ->leftjoin('zonas as z','a.codigozona','=','z.codigo')
            ->leftjoin('fnd_tipo_solicitud as s','a.concepto','=','s.id')
            ->leftjoin('fnd_tipo_gasto as g','a.subconcepto','=','g.id')
            ->select('a.id','z.nombre','s.concepto','g.detalle','a.tope','a.autoriza')
            ->where('g.detalle','LIKE','%'.$query.'%')
            ->orwhere('z.nombre','LIKE','%'.$query.'%')
            ->orderBy('id','asc')
            ->paginate(7);
            return view('maestros.topes.index',["topes"=>$topes,"searchText"=>$query]);
        }
    }

     public function create()
    {
        $zonas=DB::table('zonas')->where('id','>','0')->get();
        $conceptos=DB::table('fnd_tipo_solicitud')->where('id','>','0')->get();
        $gastos=DB::table('fnd_tipo_gasto')->where('id','>','0')->get();

        return view("maestros.topes.create",["zonas"=>$zonas, "conceptos"=>$conceptos,"gastos"=>$gastos]);
    }

    public function store (TopeCreateRequest $request)
    {
        $tope=new Tope;
        $tope->codigozona=$request->get('zona');
        $tope->concepto= $request->get('concepto');
        $tope->subconcepto=$request->get('subconcepto');
        $tope->tope=$request->get('monto');
        $tope->autoriza=$request->get('autoriza');

        $tope->save();
        
        return Redirect::to('maestros/topes');

    }

     public function show($id)
    {
        return view("maestros.topes.show",["tope"=>Tope::findOrFail($id)]);
    }

    public function edit($id)
    {
    	$tope=Tope::findOrFail($id);
        $zonas=DB::table('zonas')->where('id','>','0')->get();
        $conceptos=DB::table('fnd_tipo_solicitud')->where('id','>','0')->get();
        $gastos=DB::table('fnd_tipo_gasto')->where('id','>','0')->get();

        return view("maestros.topes.edit",["zonas"=>$zonas,"conceptos"=>$conceptos, "gastos"=>$gastos,"tope"=>$tope]);
    }

    public function update(TopeCreateRequest $request,$id)
    {
        $tope=Tope::findOrFail($id);
        $tope->codigozona=$request->get('zona');
        $tope->concepto= $request->get('concepto');
        $tope->subconcepto=$request->get('subconcepto');
        $tope->tope=$request->get('monto'); 
        $tope->autoriza=$request->get('autoriza');
     	 

        $tope->update();
        
        return Redirect::to('maestros/topes');
    }

    public function destroy($id)
    {
        $tope=Tope::findOrFail($id);
        $Tope->delete();
        return Redirect::to('maestros/topes');
    }
}
