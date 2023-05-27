<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class productController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $products = Product::all();
        return view('home/product',['products' => $products]);
    }

    public function chaise()
    {
        $products = Product::all();
        return view('home/chaise',['products' => $products]);

    }
    public function med()
    {
        $products = Product::all();
        return view('home/med',['products' => $products]);
    }
    public function equipement()
    {
        $products = Product::all();
        return view('home/equipement',['products' => $products]);

    }
    public function popup($id)
    {
        $product = Product::find($id);
        return view('home/popup', ['product' => $product]);
    }
}
