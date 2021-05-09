<?php

namespace App\Http\Controllers;
use App\Models\Organo;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

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

    public function inicio(){

        $organos= Organo::all();
        return view('user')->with('organos', $organos);
    }

    public function votar($id){
        //SQL PARA TRAER LOS CANDIDATOS
        $sql = 'SELECT * FROM `candidatos` WHERE organo_id='.$id;
        $candidatos= DB::select($sql);
        return view('votar')->with('candidatos', $candidatos);
    }
}
