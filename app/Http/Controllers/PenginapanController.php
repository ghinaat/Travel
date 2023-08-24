<?php

namespace App\Http\Controllers;
use App\Models\Penginapan;
use Illuminate\Http\Request;
use PDF;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\View;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PenginapanController extends Controller
{
    public function index(){
        $penginapan = Penginapan::all();
        return view('admin\penginapan.index', [
        'penginapan' => $penginapan
        ]);
        }

        public function create()
        {
        //Menampilkan Form Tambah 
        return view('admin\penginapan.create');
        }

        public function store(Request $request) {
            //Menyimpan Data 
            $request->validate([ 
                'nama_penginapan'=> 'required|unique:penginapan,nama_penginapan',
                'deskripsi'=> 'required',
                'fasilitas'=> 'required',
                'foto1'=> 'required|image|file|max:2048',
                'foto2'=> 'required|image|file|max:2048',
                'foto3'=> 'required|image|file|max:2048',
                'foto4'=> 'required|image|file|max:2048',
                'foto5'=> 'required|image|file|max:2048'
                ]);
                if ($request->hasFile('foto1')) {
                    $foto1 = $request->file('foto1');
                $namaFoto1 = time() . '.' . $foto1->getClientOriginalExtension();
                Storage::disk('public')->put('hotels/'.$namaFoto1, file_get_contents($foto1));
                };
                if ($request->hasFile('foto2')) {
                    $foto2 = $request->file('foto2');
                $namaFoto2 = time() . '_2.' . $foto2->getClientOriginalExtension();
                Storage::disk('public')->put('hotels/'.$namaFoto2, file_get_contents($foto2));
                };
                if ($request->hasFile('foto3')) {
                    $foto3 = $request->file('foto3');
                $namaFoto3 = time() . '_3.' . $foto3->getClientOriginalExtension();
                Storage::disk('public')->put('hotels/'.$namaFoto3, file_get_contents($foto3));
                };
                if ($request->hasFile('foto4')) {
                    $foto4 = $request->file('foto4');
                $namaFoto4 = time() . '_4.' . $foto4->getClientOriginalExtension();
                Storage::disk('public')->put('hotels/'.$namaFoto4, file_get_contents($foto4));
                };
                if ($request->hasFile('foto5')) {
                    $foto5 = $request->file('foto5');
                $namaFoto5 = time() . '_5.' . $foto5->getClientOriginalExtension();
                Storage::disk('public')->put('hotels/'.$namaFoto5, file_get_contents($foto5));
                };
                
           
    
                Penginapan::create(['nama_penginapan' => $request->nama_penginapan,
                'deskripsi' => $request->deskripsi,
                'fasilitas' => $request->fasilitas,'foto1' => $namaFoto1, 'foto2' => $namaFoto2, 'foto3' => $namaFoto3, 'foto4' => $namaFoto4,'foto5' => $namaFoto5, ]);
                    return redirect()->route('penginapan.index')->with('success_message', 'Berhasil menambah Paket Wisata baru');
                }

                public function edit($id)
            {
            //Menampilkan Form Edit
            $penginapan = Penginapan::find($id);
            if (!$penginapan) return redirect()->route('penginapan.index')
            ->with('error_message', 'Penginapan dengan id = '.$id.'
            tidak ditemukan');
            return view('admin\penginapan.edit', [
            'penginapan' => $penginapan,
            ]);
            }

            public function update(Request $request, $id)
            {
            $request->validate([
            'nama_penginapan' => 'required|unique:penginapan,nama_penginapan,'.$id,
            'deskripsi' => 'required',
            'fasilitas' => 'required',
            'foto1' => 'required',
            'foto2' => 'required',
            'foto3' => 'required',
            'foto4' => 'required',
            'foto5' => 'required'
            ]);
            $penginapan = Penginapan::find($id);
            $penginapan->nama_penginapan = $request->nama_penginapan;
            $penginapan->deskripsi = $request->deskripsi;
            $penginapan->fasilitas = $request->fasilitas;
            if ($request->hasFile('foto1')) {
                $foto1 = $request->file('foto1');
            $namaFoto1 = time() . '.' . $foto1->getClientOriginalExtension();
            Storage::disk('public')->put('hotels/'.$namaFoto1, file_get_contents($foto1));
            };
            Storage::disk('public')->delete('hotels/'.$penginapan?->foto1);
            if ($request->hasFile('foto2')) {
                $foto2 = $request->file('foto2');
            $namaFoto2 = time() . '_2.' . $foto2->getClientOriginalExtension();
            Storage::disk('public')->put('hotels/'.$namaFoto2, file_get_contents($foto2));
            };
            Storage::disk('public')->delete('hotels/'.$penginapan?->foto2);
            if ($request->hasFile('foto3')) {
                $foto3 = $request->file('foto3');
            $namaFoto3 = time() . '_3.' . $foto3->getClientOriginalExtension();
            Storage::disk('public')->put('hotels/'.$namaFoto3, file_get_contents($foto3));
            };
            Storage::disk('public')->delete('hotels/'.$penginapan?->foto3);
            if ($request->hasFile('foto4')) {
                $foto4 = $request->file('foto4');
            $namaFoto4 = time() . '_4.' . $foto4->getClientOriginalExtension();
            Storage::disk('public')->put('hotels/'.$namaFoto4, file_get_contents($foto4));
            };
            Storage::disk('public')->delete('hotels/'.$penginapan?->foto4);
            if ($request->hasFile('foto5')) {
                $foto5 = $request->file('foto5');
            $namaFoto5 = time() . '_5.' . $foto5->getClientOriginalExtension();
            Storage::disk('public')->put('hotels/'.$namaFoto5, file_get_contents($foto5));
            };
            Storage::disk('public')->delete('hotels/'.$penginapan?->foto5);           
            $penginapan-> foto1 = $request->foto1 = $namaFoto1;
            $penginapan-> foto2 = $request->foto2 = $namaFoto2;
            $penginapan-> foto3 = $request->foto3 = $namaFoto3;
            $penginapan-> foto4 = $request->foto4 = $namaFoto4;
            $penginapan-> foto5 = $request->foto5 = $namaFoto5;
            
            $penginapan->save();
            return redirect()->route('penginapan.index')
            ->with('success_message', 'Berhasil mengubah Penginapan');
            }
    
                public function destroy(Request $request, $id)
                {
                //Menghapus 
                $penginapan = Penginapan::find($id);
                if ($penginapan) {
                    $hapus = $penginapan->delete();
                    if ($hapus) unlink("storage/hotels/" . $penginapan->foto1);
                    if ($hapus) unlink("storage/hotels/" . $penginapan->foto2);
                    if ($hapus) unlink("storage/hotels/" . $penginapan->foto3);
                    if ($hapus) unlink("storage/hotels/" . $penginapan->foto4);
                    if ($hapus) unlink("storage/hotels/" . $penginapan->foto5);
                }
                return redirect()->route('penginapan.index')
                ->with('success_message', 'Berhasil menghapus Penginapan');
                } 

                public function generateReport()
                {

                    $penginapan = Penginapan::all();  // Data to pass to the report view

                    $pdf = new Dompdf();
                    $pdf->loadHtml(View::make('admin/penginapan.report',['penginapan' => $penginapan])->render());

                    // (Optional) Customize the PDF settings, such as paper size and orientation
                    $pdf->setPaper('A4', 'portrait');

                    // Render the HTML to PDF
                    $pdf->render();

                    // Output the PDF file
                    return $pdf->stream('Penginapan.pdf');
                }

}