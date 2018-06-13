<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use App\Usuario;
use App\Http\Requests\UsuarioCreateRequest;
use Illuminate\Support\Facades\Hash;

use DB;

class UsuarioController extends Controller
{
    public function __construct()
    {

    }

    public function index(Request $request)
    {
        if ($request)
        {
        	$query=trim($request->get('searchText'));
            $usuarios=DB::table('users as a')
            ->select('a.id','a.name','a.email','a.codigoSap','a.montoMaximo','a.montoPedido','c.nombreJefe','a.bloqueado')
            ->join('fnd_jefe_area as c','a.idJefe','=','c.id')            
            ->where('a.name','LIKE','%'.$query.'%')
            ->orwhere('c.nombreJefe','LIKE','%'.$query.'%')
            ->orderBy('a.id','asc')
            ->paginate(7);
            return view('maestros.usuarios.index',["usuarios"=>$usuarios,"searchText"=>$query]);
        }
    }

    public function create()
    {
        $jefes=DB::table('fnd_jefe_area')->where('id','>','0')->get();
        $roles=DB::table('usuario_rol')->where('id','>','0')->get();
        $coordinadores=DB::table('users')->where('idrol','=','3')->get();
        

        return view("maestros.usuarios.create",["jefes"=>$jefes,"roles"=>$roles,"coordinadores"=>$coordinadores]);
    }

    public function store (UsuarioCreateRequest $request)
    {
        $usuario=new Usuario;
        $usuario->name= strtoupper($request->get('name'));             
        $usuario->email=strtoupper($request->get('email'));             
        $usuario->password=Hash::make($request->get('password'));        
        $usuario->idrol=$request->get('idrol');
        $usuario->codigoSap=$request->get('codigoSap');
        $usuario->montoMaximo=$request->get('montoMaximo');
        $usuario->codigoSap=$request->get('codigoSap');
        $usuario->idJefe=$request->get('idJefe');
        $usuario->idcoo=$request->get('idcoo');
        $usuario->bloqueado=$request->get('bloqueo');

        $usuario->save();
        
        return Redirect::to('maestros/usuarios');

    }


    public function show($id)
    {
        return view("maestros.usuarios.show",["usuario"=>Usuario::findOrFail($id)]);
    }

    public function edit($id)
    {
    	$usuario=Usuario::findOrFail($id);
        $jefes=DB::table('fnd_jefe_area')->where('id','>','0')->get();
        $roles=DB::table('usuario_rol')->where('id','>','0')->get();
        $coordinadores=DB::table('users')->where('idrol','=','3')->get();


        return view("maestros.usuarios.edit",["usuario"=>$usuario,"jefes"=>$jefes,"roles"=>$roles,"coordinadores"=>$coordinadores]);
    }
    
    public function update(UsuarioCreateRequest $request,$id)
    {
        $usuario=Usuario::findOrFail($id);
        $usuario->name= strtoupper($request->get('name'));             
        $usuario->email=strtoupper($request->get('email')); 
         if(isset($_POST["password"]))        
         {
            $usuario->password=Hash::make($request->get('password'));
         }            
        
        $usuario->idrol=$request->get('idrol');
        $usuario->codigoSap=$request->get('codigoSap');
        $usuario->montoMaximo=$request->get('montoMaximo');
        $usuario->codigoSap=$request->get('codigoSap');
        $usuario->idJefe=$request->get('idJefe');  	          
        $usuario->idcoo=$request->get('idcoo');
        $usuario->bloqueado=$request->get('bloqueo');

        $usuario->update();
        
        return Redirect::to('maestros/usuarios');
    }


    public function destroy($id)
    {
        $usuario=Usuario::findOrFail($id);
        $usuario->delete();
        return Redirect::to('maestros/usuarios');
    }


     public function performLogout (Request $request)
     {
       Auth::logout ();
       return redirect ('/login'); 
    }
}
