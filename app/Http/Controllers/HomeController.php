<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\globalRequest;
use App\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('welcome');
    }

    public function getdata(globalRequest $request){
        return $this->returnSuccess('mmm', $request->name);
    }

    public function delete(Request $request){
        $user = User::create([
            'name'  => 'admin4',
            'email'      => 'admin@admin4.com',
            'password'   => \Hash::make('password'),
        ]);
        $user->delete();

        return $this->returnWarning('dd', $request->id);
    }
}
