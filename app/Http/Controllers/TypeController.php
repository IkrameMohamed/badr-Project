<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\VisitType;
use Illuminate\Support\Facades\Gate;
class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Gate::allows('list_type') == false) {
            redirect('/')->send();
        }
        $VisitTypes=VisitType::all();
        //return view('pro',compact('achats','products'));
        return view('type',compact('VisitTypes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

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
    public function edite($id)
    {
        $VisitTypes=VisitType::find($id);
        return view('edite',compact('VisitTypes'));
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
        $VisitTypes = VisitType::find($id);
        $VisitTypes->name = $request->input('name');
        $VisitTypes->update();

        return redirect('/type')->with('success', 'Quantité mise à jour avec succès !');

    }

    public function remouve($id)
    {
        $VisitTypes = VisitType::find($id);
        $VisitTypes->delete();

        return redirect('/type')->with('success', 'produit supprimer avec succès !');

    }
}
