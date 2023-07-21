<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use App\Product;
use Illuminate\Support\Facades\Gate;
class DonController extends Controller{

    public function __construct()
    {
          $this->middleware('auth');
    }
public function index()
{

            if (Gate::allows('add_product') == false) {
                  redirect('/')->send();
                }

    $products= product::all();
    return view('don/index',compact('products'));

}

/**
 * Show the form for creating a new resource.
 *
 * @return \Illuminate\Http\Response
 */
public function create()
{
}

/**
 * Store a newly created resource in storage.
 *
 * @param  \Illuminate\Http\Request  $request
 * @return \Illuminate\Http\Response
 */
public function store(Request $request)
{

    $product = new Product();

    $product->nom = $request->input('nom');
    $product->category = $request->input('category');
    $product->quantite = $request->input('quantite');
    // Définissez les autres attributs du produit à partir des données du formulaire

//    var_dump($request->all());
//    die();
    $image = $request->file('image');
    $imageData = file_get_contents($image);
    $product->image = $imageData;


    $product->save();
 return redirect()->back()->with('success', 'Produit ajouté avec succès !');

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
    //
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
    //
}

/**
 * Remove the specified resource from storage.
 *
 * @param  int  $id
 * @return \Illuminate\Http\Response
 */
public function destroy($id)
{
    //
}
}
