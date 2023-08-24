<?php

namespace App\Http\Controllers;

use App\Http\Requests\Request;

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
     return view('home');
    }

    public function handleAdmin()
    {
        return view('handleAdmin');
    }    

    public function handleBendahara()
    {
        return view('handleBendahara');
    }    

    public function handlePemilik()
    {
        return view('handlePemilik');
    }    

    
}