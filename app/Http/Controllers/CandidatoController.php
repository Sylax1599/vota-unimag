<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Candidato;
use Illuminate\Support\Facades\DB;


class CandidatoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');

    }

    public function redirigir()
    {
        return view('home');
    }

    public function index()
    {
        //SQL PARA OBTENER EL NOMBRE DE LOS ORGANOS
        $sql = 'SELECT organos.nombre from organos INNER JOIN candidatos ON candidatos.organo_id=organos.id';
        $organos= DB::select($sql);

        //SQL PARA OBTENER EL NOMBRE DE LAS VOTACIONES
        $sql_elecciones= 'SELECT votacion.nombre from votacion INNER JOIN candidatos ON votacion.id=candidatos.votacion_id';
        $elecciones=DB::select($sql_elecciones);

        //Select from candidatos, hecha por laravel
        $candidatos= Candidato::all();
        return view('candidato.index')->with('candidatos', $candidatos)->with('organos', $organos)->with('elecciones', $elecciones);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sql_organos = 'SELECT id, nombre FROM organos';
        $organos= DB::select($sql_organos);

        $sql_votaciones = 'SELECT id, nombre FROM votacion';
        $votaciones= DB::select($sql_votaciones);
        return view('candidato.create')->with('organos', $organos)->with('votaciones', $votaciones);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $candidatos= new Candidato();
        $candidatos->nombre= $request->get('nombre');
        $candidatos->apellido= $request->get('apellido');
        $candidatos->numero_identificacion= $request->get('cedula');
        $candidatos->numero_tarjeton= $request->get('tarjeton');
        $candidatos->votacion_id= $request->get('votacion');
        $candidatos->organo_id= $request->get('organo');

        $candidatos->save();

        return redirect('/home/candidatos');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }


   
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $sql_organos = 'SELECT id, nombre FROM organos';
        $organos= DB::select($sql_organos);

        $sql_votaciones = 'SELECT id, nombre FROM votacion';
        $votaciones= DB::select($sql_votaciones);

        $candidato= Candidato::find($id);
        return view('candidato.edit')->with('candidato', $candidato)->with('organos', $organos)->with('votaciones', $votaciones);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $candidato= Candidato::find($id);
        $candidato->nombre= $request->get('nombre');
        $candidato->apellido= $request->get('apellido');
        $candidato->numero_identificacion= $request->get('cedula');
        $candidato->numero_tarjeton= $request->get('tarjeton');
        $candidato->votacion_id= $request->get('votacion');
        $candidato->organo_id= $request->get('organo');

        $candidato->save();

        return redirect('/home/candidatos');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $candidato= Candidato::find($id);
        $candidato->delete();
        return redirect('/home/candidatos');
    }
}
