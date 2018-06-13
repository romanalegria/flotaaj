<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;

use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\TablaMantencion;

use DB;
use Validator;

class ServicioController extends Controller
{
     public function __construct()
    {

    }

    public function index(Request $request)
    {

    	 if ($request)
        {
            
            $tabla_mantencion=DB::table('tabla_mantenciones as a')            
            ->select('a.nombre','a.k5000','a.k10000','a.k20000','a.k30000','a.k40000','a.k50000','a.k60000','a.k70000','a.k80000','a.k90000','a.k100000')->orderBy('id','asc')
            ->paginate(7);


            return view('Servicios.Mantenciones.tlb_mantenciones',["tabla_mantencion"=>$tabla_mantencion]);
        }


    	 //return view('Servicios.Mantenciones.tlb_mantenciones');
    }

   
}
