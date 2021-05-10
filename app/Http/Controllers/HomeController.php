<?php

namespace App\Http\Controllers;
use App\Models\Organo;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin',['only'=>'index']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function prueba(){
        return view('organo.prueba');
    }

    public function inicio(){

        $organos= Organo::all();
        return view('user')->with('organos', $organos);
    }

    public function votar($id){
        //SQL PARA TRAER LOS CANDIDATOS
        $sql = 'SELECT * FROM `candidatos` WHERE organo_id='.$id;
        $candidatos= DB::select($sql);

        //SQL PARA TRAER MOSTRAR EL ORGANO SELECCIONADO
        $sql_organos = 'SELECT * FROM `organos` WHERE id='.$id;
        $organo= DB::select($sql_organos);

        return view('votar')->with('candidatos', $candidatos)->with('organo', $organo);
    }

    public function registrarVoto(Request $request){
        $password=$request->get('password');
        $confirm_password=$request->get('confirm_password');
        $voto=$request->get('voto');
        $mensaje="";
        if (Hash::check($confirm_password, $password))
        {
            $mensaje="Contraseña coinciden";
        }
        else{
            $mensaje="Error";
        }
        
        return view('pass')->with('mensaje', $mensaje)->with('voto', $voto);
    }
}
