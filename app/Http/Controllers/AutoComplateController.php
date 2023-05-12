<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class AutoComplateController extends Controller
{
    public function index(){
        return view('autocomplate');
    }

    public function Autocomplet(Request $request){

        $search = $request->search;

        if($search == ''){
            $autocomplate = User::orderby('name','asc')->select('id','name')->limit(5)->get();
        }else{
            $autocomplate = User::orderby('name','asc')->select('id','name')->where('name', 'like', '%' .$search . '%')->limit(5)->get();
        }

        $response = array();
        foreach($autocomplate as $autocomplate){
            $response[] = array("value"=>$autocomplate->id,"label"=>$autocomplate->name);
        }

        echo json_encode($response);
        exit;
    }
}
