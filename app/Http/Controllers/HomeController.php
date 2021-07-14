<?php

namespace App\Http\Controllers;
use App\Models\Organo;
use App\Models\Votos;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


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
        $this->middleware('admin',['only'=>'viewVotos']);
        $this->middleware('admin',['only'=>'estadisticas']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('admin.home');
    }

    

    public function inicio(){

        
        return view('inicio.organos');
    }

    public function apiOrganos(){
        $organos= Organo::all();
        return  response()->json(array("organos"=> $organos));
    }


    public function error(){

        return view('errors.404');
    }
    public function votar($id){
        //SQL PARA TRAER MOSTRAR EL ORGANO SELECCIONADO
        $sql_organos = 'SELECT * FROM `organos` WHERE id='.$id;
        $organo= DB::select($sql_organos);

        return view('inicio.votar')->with('organo', $organo);
       
    }

    public function apiVotar($id){
        $sql = 'SELECT * FROM `candidatos` WHERE organo_id='.$id;
        $candidatos= DB::select($sql);

        //SQL PARA TRAER MOSTRAR EL ORGANO SELECCIONADO
        $sql_organos = 'SELECT * FROM `organos` WHERE id='.$id;
        $organo= DB::select($sql_organos);

        return  response()->json(array("candidatos"=> $candidatos));
    }

    public function isVotado($id){
        $user = Auth::user()->id;
        
        $sql_votado='select COUNT(*) as total from users 
        inner join votos on users.id = votos.users_id 
        inner join candidatos on votos.candidatos_id = candidatos.id 
        inner join organos on candidatos.organo_id = organos.id 
        where organos.id='.$id. ' and users.id = '.$user.';';

        //Ejecutamos el sql
        $registros= DB::select($sql_votado);
        // nos vamos al campo total
        $total_registros= $registros[0]->total;
        //si el total de votos es mayor que 0, significa que ya votó
        if($total_registros>0){
            $votado=true;
        }
        else{
            $votado=false;
        }

        return  response()->json(array("votado"=> $votado));
    }

    public function registrarVoto(Request $request){
        $password=$request->get('password');
        $confirm_password=$request->get('confirm_password');
        $voto=$request->get('voto');
        $user=$request->get('user_id');

        if (Hash::check($confirm_password, $password))
        {
            $votos=new Votos();
            $votos->candidatos_id=$voto;
            $votos->users_id=$user;

            $votos->save();
           
            return response()->json(array("exists" => true, "voto"=> $voto, "user"=>$user));
        }
        else{
            return response()->json(array("exists" => false));
        }
        
        
    }

    public function viewVotos(){

        return view('admin.total');
    }

    public function apiTotalVotos()
    {

        //SQL Para saber el total de votos por candidatos
        $votos_candidatos = DB::table('candidatos')
            ->join('votos', 'candidatos.id', '=', 'votos.candidatos_id')
            ->join('organos', 'candidatos.organo_id', '=', 'organos.id')
            ->select(DB::raw('candidatos.nombre, candidatos.apellido, organos.nombre as organo_nombre, COUNT(*) as votos'))
            ->groupBy('candidatos.nombre', 'candidatos.apellido','organos.nombre')->get();
        
        //SQL para el total de votos
        $total_votos = DB::table('votos')
        ->select(DB::raw('COUNT(*) as total_votos'))
        ->get();

        //SQL para el filtro de organos
        $organos = DB::table('organos')
        ->select('*')
        ->get();
        
        return response()->json(array("votos_candidatos"=> $votos_candidatos, 
        "total_votos"=>$total_votos,
        "organos"=>$organos
        ));
    }

    public function apiEstadisticaCandidatos()
    {
        ///SQL Para saber el total de votos por candidatos
        $votos_candidatos = DB::table('candidatos')
        ->join('votos', 'candidatos.id', '=', 'votos.candidatos_id')
        ->join('organos', 'candidatos.organo_id', '=', 'organos.id')
        ->select(DB::raw('candidatos.nombre, candidatos.apellido, organos.nombre as organo_nombre, COUNT(*) as votos'))
        ->groupBy('candidatos.nombre', 'candidatos.apellido','organos.nombre')->get();
    
        //SQL para el total de votos
        $total_votos = DB::table('votos')
        ->select(DB::raw('COUNT(*) as total_votos'))
        ->get();

        //SQL para el filtro de organos
        $organos = DB::table('organos')
        ->select('*')
        ->get();

        ///SQL Para saber el total de votos por candidatos
        $votos_organos = DB::table('votos')
        ->join('candidatos', 'candidatos.id', '=', 'votos.candidatos_id')
        ->join('organos', 'candidatos.organo_id', '=', 'organos.id')
        ->select(DB::raw('COUNT(*) as votos_organo, organos.nombre'))
        ->groupBy('organos.nombre')->get();
        
        return response()->json(array("votos_candidatos"=> $votos_candidatos, 
        "total_votos"=>$total_votos,
        "organos"=>$organos,
        "votos_organos"=>$votos_organos
        ));
    }

    public function estadisticas()
    {
        return view('admin.estadisticas');
    }
}
