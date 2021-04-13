<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Candidato;


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
        $candidatos= Candidato::all();
        return view('candidato.index')->with('candidatos', $candidatos);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('candidato.create');
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
        $candidato= Candidato::find($id);
        return view('candidato.edit')->with('candidato', $candidato);

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
