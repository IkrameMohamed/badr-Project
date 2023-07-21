<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use App\Achat;
use App\Product;
use Illuminate\Support\Facades\Gate;

class ProController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        if (Gate::allows('list_product') == false) {
            redirect('/')->send();
        }
       $products=product::all();
        $achats= Achat::all();
        //return view('pro',compact('achats','products'));
        return view('product.index')->with('products', $products);
    }
    public function list_demande(){
        if (Gate::allows('list_demande') == false) {
            redirect('/')->send();
        }
        $products=product::all();
        $achats = Achat::with(['product','user'])->get();
        //return view('pro',compact('achats','products'));
        return view('demande.index')->with('achats', $achats);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $products=product::find($id);
        return view('edit',compact('products'));
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
        $products = Product::find($id);
        $products->quantite = $request->input('quantite');
        $products->update();

        return redirect('/list_product')->with('success', 'Quantité mise à jour avec succès !');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function remouve($id)
    {
        $products = Product::find($id);
        $products->delete();

        return redirect('/list_product')->with('success', 'produit supprimer avec succès !');

    }
}
