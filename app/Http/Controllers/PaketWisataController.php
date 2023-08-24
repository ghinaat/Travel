<?php

namespace App\Http\Controllers;
use App\Models\PaketWisata;
use Illuminate\Http\Request;
use PDF;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PaketWisataController extends Controller
{
    public function index(){
        $pktwisata = PaketWisata::all();
        return view('paketwisata.index', [
        'pktwisata' => $pktwisata
        ]);
        }

        public function create()
        {
        //Menampilkan Form Tambah 
        $pktwisata = PaketWisata::all();
        return view('paketwisata.create',[
            'pktwisata' => $pktwisata
            ]);
        }

        public function store(Request $request) {
            //Menyimpan Data 
        
            $request->validate([ 
                'nama_paket'=> 'required|unique:paket_wisata,nama_paket',
                'deskripsi'=> 'required',
                'fasilitas'=> 'required',
                'harga_per_pack' => 'numeric',
                'diskon' => 'numeric',
                'foto1'=> 'required|image|file|max:2048',
                'foto2'=> 'required|image|file|max:2048',
                'foto3'=> 'required|image|file|max:2048',
                'foto4'=> 'required|image|file|max:2048',
                'foto5'=> 'required|image|file|max:2048'
                ]);
                if ($request->hasFile('foto1')) {
                    $foto1 = $request->file('foto1');
                $namaFoto1 = time() . '.' . $foto1->getClientOriginalExtension();
                Storage::disk('public')->put('paket/'.$namaFoto1, file_get_contents($foto1));
                };
                if ($request->hasFile('foto2')) {
                    $foto2 = $request->file('foto2');
                $namaFoto2 = time() . '_2.' . $foto2->getClientOriginalExtension();
                Storage::disk('public')->put('paket/'.$namaFoto2, file_get_contents($foto2));
                };
                if ($request->hasFile('foto3')) {
                    $foto3 = $request->file('foto3');
                $namaFoto3 = time() . '_3.' . $foto3->getClientOriginalExtension();
                Storage::disk('public')->put('paket/'.$namaFoto3, file_get_contents($foto3));
                };
                if ($request->hasFile('foto4')) {
                    $foto4 = $request->file('foto4');
                $namaFoto4 = time() . '_4.' . $foto4->getClientOriginalExtension();
                Storage::disk('public')->put('paket/'.$namaFoto4, file_get_contents($foto4));
                };
                if ($request->hasFile('foto5')) {
                    $foto5 = $request->file('foto5');
                $namaFoto5 = time() . '_5.' . $foto5->getClientOriginalExtension();
                Storage::disk('public')->put('paket/'.$namaFoto5, file_get_contents($foto5));
                };
          
                $pktwisata = PaketWisata::create(['nama_paket' => $request->nama_paket,
                'deskripsi' => $request->deskripsi,
                'fasilitas' => $request->fasilitas, 'harga_per_pack' => $request->harga_per_pack, 'diskon' => $request->diskon, 'foto1' => $namaFoto1, 'foto2' => $namaFoto2, 'foto3' => $namaFoto3, 'foto4' => $namaFoto4,'foto5' => $namaFoto5, ]);
              
                    return redirect()->route('pktwisata.index')->with('success_message', 'Berhasil menambah Paket Wisata baru');
                }

                public function edit($id)
            {
            //Menampilkan Form Edit
            $pktwisata = PaketWisata::find($id);
            if (!$pktwisata) return redirect()->route('pktwisata.index')
            ->with('error_message', 'Paket Wisata dengan id = '.$id.'
            tidak ditemukan');
            return view('paketwisata.edit', [
            'pktwisata' => $pktwisata,
            ]);
            }

            public function update(Request $request, $id)
            {
            $request->validate([
            'nama_paket' => 'required',
            'deskripsi' => 'required',
            'fasilitas' => 'required',
            'harga_per_pack' => 'required',
            'diskon' => 'required',
            'foto1' => 'required',
            'foto2' => 'required',
            'foto3' => 'required',
            'foto4' => 'required',
            'foto5' => 'required'
            ]);
            $pktwisata = PaketWisata::find($id);
            $pktwisata->nama_paket = $request->nama_paket;
            $pktwisata->deskripsi = $request->deskripsi;
            $pktwisata->fasilitas = $request->fasilitas;
            $pktwisata->harga_per_pack = $request->harga_per_pack;
            $pktwisata->diskon = $request->diskon;
            if ($request->hasFile('foto1')) {
                $foto1 = $request->file('foto1');
            $namaFoto1 = time() . '.' . $foto1->getClientOriginalExtension();
            Storage::disk('public')->put('paket/'.$namaFoto1, file_get_contents($foto1));
            };
            Storage::disk('public')->delete('paket/'.$pktwisata->foto1);
            if ($request->hasFile('foto2')) {
                $foto2 = $request->file('foto2');
            $namaFoto2 = time() . '_2.' . $foto2->getClientOriginalExtension();
            Storage::disk('public')->put('paket/'.$namaFoto2, file_get_contents($foto2));
            };
            Storage::disk('public')->delete('paket/'.$pktwisata->foto2);
            if ($request->hasFile('foto3')) {
                $foto3 = $request->file('foto3');
            $namaFoto3 = time() . '_3.' . $foto3->getClientOriginalExtension();
            Storage::disk('public')->put('paket/'.$namaFoto3, file_get_contents($foto3));
            };
            Storage::disk('public')->delete('paket/'.$pktwisata->foto3);
            if ($request->hasFile('foto4')) {
                $foto4 = $request->file('foto4');
            $namaFoto4 = time() . '_4.' . $foto4->getClientOriginalExtension();
            Storage::disk('public')->put('paket/'.$namaFoto4, file_get_contents($foto4));
            };
            Storage::disk('public')->delete('paket/'.$pktwisata->foto4);
            if ($request->hasFile('foto5')) {
                $foto5 = $request->file('foto5');
            $namaFoto5 = time() . '_5.' . $foto5->getClientOriginalExtension();
            Storage::disk('public')->put('paket/'.$namaFoto5, file_get_contents($foto5));
            };
            Storage::disk('public')->delete('paket/'.$pktwisata->foto5);           
            $pktwisata-> foto1 = $request->foto1 = $namaFoto1;
            $pktwisata-> foto2 = $request->foto2 = $namaFoto2;
            $pktwisata-> foto3 = $request->foto3 = $namaFoto3;
            $pktwisata-> foto4 = $request->foto4 = $namaFoto4;
            $pktwisata-> foto5 = $request->foto5 = $namaFoto5;
            $pktwisata->save();
            return redirect()->route('pktwisata.index')
            ->with('success_message', 'Berhasil mengubah
            Paket Wisata');
            }
    
                public function destroy(Request $request, $id)
                {
                //Menghapus 
                $pktwisata = PaketWisata::find($id);
                if ($pktwisata) {
                    $hapus = $pktwisata->delete();
                    if ($hapus) unlink("storage/paket/" . $pktwisata->foto1);
                    if ($hapus) unlink("storage/paket/" . $pktwisata->foto2);
                    if ($hapus) unlink("storage/paket/" . $pktwisata->foto3);
                    if ($hapus) unlink("storage/paket/" . $pktwisata->foto4);
                    if ($hapus) unlink("storage/paket/" . $pktwisata->foto5);
                }
                return redirect()->route('pktwisata.index')
                ->with('success_message', 'Berhasil menghapus Paket Wisata');
                } 
                     

}