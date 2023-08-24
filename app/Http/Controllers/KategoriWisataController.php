<?php

namespace App\Http\Controllers;
use App\Models\KategoriWisata;
use PDF;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\View;

use Illuminate\Http\Request;

class KategoriWisataController extends Controller
{
    public function index(){
        $ktwisata = KategoriWisata::all();
        return view('admin\kategoriwisata.index', [
        'ktwisata' => $ktwisata
        ]);
        }

        public function create()
        {
        //Menampilkan Form Tambah 
        return view('admin\kategoriwisata.create');
        }

        public function store(Request $request)
        {
        //Menyimpan Data 
        $request->validate([
        'kategori_wisata' => 'required|unique:kategori_wisata,kategori_wisata'
        ]);
        $array = $request->only([
        'kategori_wisata'
        ]);
        $ktwisata = KategoriWisata::create($array);
        return redirect()->route('ktwisata.index')
        ->with('success_message', 'Berhasil menambah kategori wisata
       baru');
        } 

        public function edit($id)
        {
        //Menampilkan Form Edit
        $ktwisata = KategoriWisata::find($id);
        if (!$ktwisata) return redirect()->route('ktwisata.index')
        ->with('error_message', 'kategori wisata dengan id = '.$id.' tidak
        ditemukan');
        return view('admin\kategoriwisata.edit', [
        'ktwisata' => $ktwisata
        ]);
        }   

        public function update(Request $request, $id)
        {
        //Mengedit Data Kategori Wisata
        $request->validate([
        'kategori_wisata' =>
        'required|unique:kategori_wisata,kategori_wisata,'.$id
        ]);
        $ktwisata = KategoriWisata::find($id);
        $ktwisata-> kategori_wisata = $request->kategori_wisata;
        $ktwisata->save();
        return redirect()->route('ktwisata.index')
        ->with('success_message', 'Berhasil mengubah kategori wisata');
        } 

        public function destroy(Request $request, $id)
        {
        //Menghapus 
        $ktwisata = KategoriWisata::find($id);
        if ($ktwisata) $ktwisata->delete();
        return redirect()->route('ktwisata.index')
        ->with('success_message', 'Berhasil menghapus kategori wisata');
        } 

        public function generateReport()
                {

                    $ktwisata = KategoriWisata::all();  // Data to pass to the report view

                    $pdf = new Dompdf();
                    $pdf->loadHtml(View::make('admin/ktwisata.report',['ktwisata' => $ktwisata])->render());

                    // (Optional) Customize the PDF settings, such as paper size and orientation
                    $pdf->setPaper('A4', 'portrait');

                    // Render the HTML to PDF
                    $pdf->render();

                    // Output the PDF file
                    return $pdf->stream('kategori_wisata.pdf');
                }
}