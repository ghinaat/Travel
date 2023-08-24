<?php

namespace App\Http\Controllers;
use App\Models\KategoriWisata;
use App\Models\ObyekWisata;
use Illuminate\Http\Request;
use PDF;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\View;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ObyekWisataController extends Controller
{
    public function index(){
        $obwisata = ObyekWisata::all();
        return view('admin\obyekwisata.index', [
        'obwisata' => $obwisata
        ]);
        }

        public function create(){
            //Menampilkan Form Tambah 
            return view(
                'admin\obyekwisata.create', [
                'ktwisata' => KategoriWisata::all()
        ]);
            }
            
        public function store(Request $request){
            //Menyimpan Data Guru
            $request->validate([
            'nama_wisata' => 'required|unique:obyek_wisata,nama_wisata',
            'deskripsi_wisata' => 'required',
            'id_kategori_wisata' => 'required',
            'fasilitas' => 'required',
            'foto1' => 'required|image|file|max:2048',
            'foto2' => 'required|image|file|max:2048',
            'foto3' => 'required|image|file|max:2048',
            'foto4' => 'required|image|file|max:2048',
            'foto5' => 'required|image|file|max:2048'
            ]);
            if ($request->hasFile('foto1')) {
                $foto1 = $request->file('foto1');
            $namaFoto1 = time() . '.' . $foto1->getClientOriginalExtension();
            Storage::disk('public')->put('obyek/'.$namaFoto1, file_get_contents($foto1));
            };
            if ($request->hasFile('foto2')) {
                $foto2 = $request->file('foto2');
            $namaFoto2 = time() . '_2.' . $foto2->getClientOriginalExtension();
            Storage::disk('public')->put('obyek/'.$namaFoto2, file_get_contents($foto2));
            };
            if ($request->hasFile('foto3')) {
                $foto3 = $request->file('foto3');
            $namaFoto3 = time() . '_3.' . $foto3->getClientOriginalExtension();
            Storage::disk('public')->put('obyek/'.$namaFoto3, file_get_contents($foto3));
            };
            if ($request->hasFile('foto4')) {
                $foto4 = $request->file('foto4');
            $namaFoto4 = time() . '_4.' . $foto4->getClientOriginalExtension();
            Storage::disk('public')->put('obyek/'.$namaFoto4, file_get_contents($foto4));
            };
            if ($request->hasFile('foto5')) {
                $foto5 = $request->file('foto5');
            $namaFoto5 = time() . '_5.' . $foto5->getClientOriginalExtension();
            Storage::disk('public')->put('obyek/'.$namaFoto5, file_get_contents($foto5));
            };
           ObyekWisata::create(['nama_wisata' => $request->nama_wisata,
            'deskripsi_wisata' => $request->deskripsi_wisata, 'id_kategori_wisata' => $request->id_kategori_wisata,
            
            'fasilitas' => $request->fasilitas,'foto1' => $namaFoto1, 'foto2' => $namaFoto2, 'foto3' => $namaFoto3, 'foto4' => $namaFoto4,'foto5' => $namaFoto5, ]);
           
                return redirect()->route('obwisata.index')->with('success_message', 'Berhasil menambah obyek wisata baru');
            }

            public function edit($id)
            {
            //Menampilkan Form Edit
            $obwisata = ObyekWisata::find($id);
            if (!$obwisata) return redirect()->route('obwisata.index')
            ->with('error_message', 'Obyek Wisata dengan id = '.$id.'
            tidak ditemukan');
            return view('admin\obyekwisata.edit', [
            'obwisata' => $obwisata,
            'ktwisata' => KategoriWisata::all()
            ]);
            }

            public function update(Request $request, $id)
            {
            $request->validate([
                'nama_wisata' => 'required|unique:obyek_wisata,nama_wisata,'.$id,
                'deskripsi_wisata' => 'required',
                'id_kategori_wisata' => 'required',
                'fasilitas' => 'required',
                'foto1' => 'required',
                'foto2' => 'required',
                'foto3' => 'required',
                'foto4' => 'required',
                'foto5' => 'required'
            ]);
            $obwisata = ObyekWisata::find($id);
            $obwisata->nama_wisata = $request->nama_wisata;
            $obwisata->deskripsi_wisata = $request->deskripsi_wisata;
            $obwisata->id_kategori_wisata = $request->id_kategori_wisata;
            $obwisata->fasilitas = $request->fasilitas;
            if ($request->hasFile('foto1')) {
                $foto1 = $request->file('foto1');
            $namaFoto1 = time() . '.' . $foto1->getClientOriginalExtension();
            Storage::disk('public')->put('obyek/'.$namaFoto1, file_get_contents($foto1));
            };
            Storage::disk('public')->delete('obyek/'.$obwisata?->foto1);
            if ($request->hasFile('foto2')) {
                $foto2 = $request->file('foto2');
            $namaFoto2 = time() . '_2.' . $foto2->getClientOriginalExtension();
            Storage::disk('public')->put('obyek/'.$namaFoto2, file_get_contents($foto2));
            };
            Storage::disk('public')->delete('obyek/'.$obwisata?->foto2);
            if ($request->hasFile('foto3')) {
                $foto3 = $request->file('foto3');
            $namaFoto3 = time() . '_3.' . $foto3->getClientOriginalExtension();
            Storage::disk('public')->put('obyek/'.$namaFoto3, file_get_contents($foto3));
            };
            Storage::disk('public')->delete('obyek/'.$obwisata?->foto3);
            if ($request->hasFile('foto4')) {
                $foto4 = $request->file('foto4');
            $namaFoto4 = time() . '_4.' . $foto4->getClientOriginalExtension();
            Storage::disk('public')->put('obyek/'.$namaFoto4, file_get_contents($foto4));
            };
            Storage::disk('public')->delete('obyek/'.$obwisata?->foto4);
            if ($request->hasFile('foto5')) {
                $foto5 = $request->file('foto5');
            $namaFoto5 = time() . '_5.' . $foto5->getClientOriginalExtension();
            Storage::disk('public')->put('hotels/'.$namaFoto5, file_get_contents($foto5));
            };
            Storage::disk('public')->delete('obyek/'.$obwisata?->foto5);           
            $penginapan-> foto1 = $request->foto1 = $namaFoto1;
            $penginapan-> foto2 = $request->foto2 = $namaFoto2;
            $penginapan-> foto3 = $request->foto3 = $namaFoto3;
            $penginapan-> foto4 = $request->foto4 = $namaFoto4;
            $penginapan-> foto5 = $request->foto5 = $namaFoto5;
            $obwisata->save();
            return redirect()->route('obwisata.index')
            ->with('success_message', 'Berhasil mengubah
            Obyek Wisata');
            }

            public function destroy(Request $request, $id)
            {
            //Menghapus 
            $obwisata = ObyekWisata::find($id);
            if ($obwisata) {
                $hapus = $obwisata->delete();
                if ($hapus) unlink("storage/" . $obwisata->foto1);
                if ($hapus) unlink("storage/" . $obwisata->foto2);
                if ($hapus) unlink("storage/" . $obwisata->foto3);
                if ($hapus) unlink("storage/" . $obwisata->foto4);
                if ($hapus) unlink("storage/" . $obwisata->foto5);
            }
            return redirect()->route('obwisata.index')
            ->with('success_message', 'Berhasil menghapus Obyek Wisata');
            } 
           
            public function generateReport()
                {

                    $obwisata = ObyekWIsata::all();  // Data to pass to the report view

                    $pdf = new Dompdf();
                    $pdf->loadHtml(View::make('admin/obwisata.report',['obwisata' => $obwisata])->render());

                    // (Optional) Customize the PDF settings, such as paper size and orientation
                    $pdf->setPaper('A4', 'portrait');

                    // Render the HTML to PDF
                    $pdf->render();

                    // Output the PDF file
                    return $pdf->stream('Obyek_Wisata.pdf');
                }
}