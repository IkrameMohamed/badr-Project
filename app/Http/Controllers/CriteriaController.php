<?php

namespace App\Http\Controllers;

use App\Criteria;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

use Illuminate\Support\Facades\Gate;

class CriteriaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * index page method
     *
     * @return void
     */

    public function Autocomplete(Request $request){

        $search = $request->search;

        if($search == ''){
            $autocomplate = Criteria::orderby('name','asc')->select('id','name')->limit(5)->get();
        }else{
            $autocomplate = Criteria::orderby('name','asc')->select('id','name')->where('name', 'like', '%' .$search . '%')->limit(5)->get();
        }

        $response = array();
        foreach($autocomplate as $autocomplate){
            $response[] = array("value"=>$autocomplate->id,"label"=>$autocomplate->name);
        }
        return  response()->json($response);
    }



}