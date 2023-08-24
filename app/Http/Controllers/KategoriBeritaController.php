<?php

namespace App\Http\Controllers;
use App\Models\KategoriBerita;
use PDF;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\View;

use Illuminate\Http\Request;

class KategoriBeritaController extends Controller
{
    public function index(){
        $ktberita = KategoriBerita::all();
        return view('admin\kategoriberita.index', [
        'ktberita' => $ktberita
        ]);
        }

        public function create()
        {
        //Menampilkan Form Tambah 
        return view('admin\kategoriberita.create');
        }

        public function store(Request $request)
        {
        //Menyimpan Data 
        $request->validate([
        'kategori_berita' => 'required|unique:kategori_berita,kategori_berita'
        ]);
        $array = $request->only([
        'kategori_berita'
        ]);
        $ktberita = KategoriBerita::create($array);
        return redirect()->route('ktberita.index')
        ->with('success_message', 'Berhasil menambah Kategori Berita baru');
        } 

        public function edit($id)
        {
        //Menampilkan Form Edit
        $ktberita = KategoriBerita::find($id);
        if (!$ktberita) return redirect()->route('ktberita.index')
        ->with('error_message', 'Kategori Berita dengan id = '.$id.' tidak ditemukan');
        return view('admin\kategoriberita.edit', [
        'ktberita' => $ktberita
        ]);
        }   

        public function update(Request $request, $id)
        {
        //Mengedit Data Kategori Wisata
        $request->validate([
        'kategori_berita' =>
        'required|unique:kategori_berita,kategori_berita,'.$id
        ]);
        $ktberita = KategoriBerita::find($id);
        $ktberita-> kategori_berita = $request->kategori_berita;
        $ktberita->save();
        return redirect()->route('ktberita.index')
        ->with('success_message', 'Berhasil mengubah kategori Berita');
        } 

        public function destroy(Request $request, $id)
        {
        //Menghapus 
        $ktberita = KategoriBerita::find($id);
        if ($ktberita) $ktberita->delete();
        return redirect()->route('ktberita.index')
        ->with('success_message', 'Berhasil menghapus kategori Berita');
        } 

        public function generateReport()
                {

                    $ktberita = KategoriBerita::all();  // Data to pass to the report view

                    $pdf = new Dompdf();
                    $pdf->loadHtml(View::make('admin/ktberita.report',['ktberita' => $ktberita])->render());

                    // (Optional) Customize the PDF settings, such as paper size and orientation
                    $pdf->setPaper('A4', 'portrait');

                    // Render the HTML to PDF
                    $pdf->render();

                    // Output the PDF file
                    return $pdf->stream('Kategori_Berita.pdf');
                }
}