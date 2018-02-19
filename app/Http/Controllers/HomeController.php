<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		
		//$user = \Illuminate\Support\Facades\Auth::user();
		
		//$user = \Auth::user();
		
		//$user = request()->user();
		
		//dd($user);
        return view('front.home.index');
    }
}
