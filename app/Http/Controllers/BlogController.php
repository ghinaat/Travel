<?php

namespace App\Http\Controllers;
use App\Models\Berita;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $berita=Berita::all();

        return view('demo',compact('berita'));
    }

    public function berita()
    {
        $berita=Berita::all();
        return view('demo',compact('berita'));
    }

    public function beritas(Berita $berita)
    {

        return view('demo',compact('beritas'));
    }
}