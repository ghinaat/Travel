<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelanggan;
use App\Models\User;
use PDF;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\View;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;


class PelangganController extends Controller
{
public function index(){ 
    
    $user = User::findOrFail(Auth::user()->id);
    $pelanggan = Pelanggan::all();
    return view('pelanggan.index', compact('pelanggan'));
}

public function create()
        {
        //Menampilkan Form Tambah 
      
        return view('pelanggan.profile', [
            'user' => User::all(),
            
    ]);
 
        }

public function updatePelanggan(Request $request)
{
    $request->validate([ 
        'nama_lengkap'=> ['required'],
        'no_hp'=> ['required'],
        'alamat'=> ['required'],
        'foto' => [ 'nullable', 'image','mimes:png,jpg,jpeg', 'max:2048']
        
        ]); 
        $user = User::findOrFail(Auth::user()->id);
     
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
        $namaFoto = time() . '.' . $foto->getClientOriginalExtension();
        Storage::disk('public')->put('photo/'.$namaFoto, file_get_contents($foto));
      
        };
        Storage::disk('public')->delete('photo/'.$user->pelanggan?->foto);

       
        $user->pelanggan()->updateOrCreate(
            [
                'id_user'=>$user->id,
            ],
            [
            'nama_lengkap' => $request->nama_lengkap,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
            'foto' => $request->foto=$namaFoto,
           
            
            
            ]     
    
        );
       

        $user->save();

        return redirect()->to('/pelanggan')->with('success_message', 'Berhasil Updated User Profile');
    }
}