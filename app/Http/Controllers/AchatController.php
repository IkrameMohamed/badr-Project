<?php

namespace App\Http\Controllers;

use App\Achat;
use App\Product;
use Illuminate\Http\Request;

class AchatController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request)
    {

        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);


        // Get the currently logged in user's ID
        $user_id = auth()->id();

        $image = $request->file('image');
        $imageData = file_get_contents($image);
        $base64 = base64_encode($imageData);

        $product = Product::find($request->product_id);

        if (!$product) {
            return redirect('/')->with('error', 'Product not found.');
        }

        $product->quantite -= 1;

        if ($product->quantite < 0) {
            return redirect('/')->with('error', 'Product out of stock.');
        }

        $product->save();



        $achat = new Achat();
        $achat->user_id = $user_id;
        $achat->product_id = $request->product_id;
        $achat->ordonnance = $base64;
        $achat->save();

        return redirect('/')->with('success', 'Image uploaded successfully.');

    }


}
