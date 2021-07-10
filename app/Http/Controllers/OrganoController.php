<?php

namespace App\Http\Controllers;
use App\Models\Organo;
use Illuminate\Http\Request;

class OrganoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $organos= Organo::all();
        return view('organo.index')->with('organos', $organos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('organo.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $organos= new Organo();
        $organos->nombre= $request->get('nombre');
        $organos->color= $request->get('favcolor');
        

        $organos->save();

        return redirect('/home/organos');
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
        $organo= Organo::find($id);
        return view('organo.edit')->with('organo', $organo);

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
        $organo= Organo::find($id);
        $organo->nombre= $request->get('nombre');
        $organo->color= $request->get('favcolor');
        $organo->save();

        return redirect('/home/organos');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $organo= Organo::find($id);
        $organo->delete();
        return redirect('/home/organos');
    }
}
