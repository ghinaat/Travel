<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Karyawan;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;


class KaryawanController extends Controller
{
public function index(){ 
    $user = User::findOrFail(Auth::user()->id);
    $karyawan = Karyawan::all();
    return view('karyawan.index', compact('karyawan'));
}

public function create()
        {
        //Menampilkan Form Tambah 
      
        return view('karyawan.profile', [
            'user' => User::all(),
            
    ]);
 
        }

public function updateKaryawan(Request $request)
{
    $request->validate([ 
        'nama_karyawan' => 'required',
            'alamat' => 'required',
            'no_hp' => 'required',
           

        
        ]); 
        $user = User::findOrFail(Auth::user()->id);
        
      

       
        $user->karyawan()->updateOrCreate(
            [
                'id_user'=>$user->id,
            ],
            [
            'nama_karyawan' =>$request->nama_karyawan,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
            
            
            
            ]     
    
        );
       

        $user->save();

        return redirect()->to('/karyawan')->with('success_message', 'Berhasil Updated User Profile');
    }
}