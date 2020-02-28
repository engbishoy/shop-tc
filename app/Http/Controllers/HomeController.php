<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\products;
use App\categories;
use App\requests;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth'=>'verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }



    public function admin()
    {
        $user=User::all();
        $cats=categories::all();
        $items=products::all();
        $requests=requests::where('accept','=',1);
        return view('admin.dashboard')->with('user',$user)->with('cats',$cats)->with('items',$items)->with('requests',$requests);
         
      }

}
