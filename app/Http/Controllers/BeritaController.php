<?php

namespace App\Http\Controllers;
use App\Models\Berita;
use App\Models\KategoriBerita;
use Illuminate\Http\Request;
use PDF;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class BeritaController extends Controller
{
    public function index(){
        $berita = Berita::all();
        return view('admin\berita.index', [
        'berita' => $berita
        ]);
        }

        public function create(){
            //Menampilkan Form Tambah 
            return view(
                'admin\berita.create', [
                'ktberita' => KategoriBerita::all()
        ]);
            }
            
        public function store(Request $request){
            //Menyimpan Data Guru
            $request->validate([
            'judul' => 'required|unique:berita,judul',
            'berita' => 'required',
            'tgl_post' => 'required',
            'id_kategori_berita' => 'required',
            'foto' => 'required|image|file|max:2048'
            ]);
            if ($request->hasFile('foto')) {
                $foto = $request->file('foto');
            $namaFoto = time() . '.' . $foto->getClientOriginalExtension();
            Storage::disk('public')->put('berita/'.$namaFoto, file_get_contents($foto));
            };
            
                
            Berita::create(['foto' => $namaFoto, 'judul' => $request->judul,
            'berita' => $request->berita,
            'tgl_post'=> $request->tgl_post,
            'id_kategori_berita'=> $request->id_kategori_berita]);
                return redirect()->route('berita.index')->with('success_message', 'Berhasil menambah berita baru');
            }

            public function edit($id)
            {
            //Menampilkan Form Edit
            $berita = Berita::find($id);
            if (!$berita) return redirect()->route('berita.index')
            ->with('error_message', 'Obyek Wisata dengan id = '.$id.'
            tidak ditemukan');
            return view('admin\berita.edit', [
            'berita' => $berita,
            'ktberita' => KategoriBerita::all()
            ]);
            }

            public function update(Request $request, $id)
            {
            $request->validate([
                'judul' => 'required|unique:berita,judul,'.$id,
                'berita' => 'required',
                'tgl_post' => 'required',
                'id_kategori_berita' => 'required',
                'foto' => 'required'
            ]);
            $berita = Berita::find($id);
            
            $berita->judul = $request->judul;
            $berita->berita = $request->berita;
            $berita->tgl_post = $request->tgl_post;
            $berita->id_kategori_berita = $request->id_kategori_berita;
            if ($request->hasFile('foto')) {
                $foto = $request->file('foto');
            $namaFoto = time() . '.' . $foto->getClientOriginalExtension();
            Storage::disk('public')->put('berita/'.$namaFoto, file_get_contents($foto));
            };
            Storage::disk('public')->delete('berita/'.$berita?->foto);
            $berita-> foto = $request->foto = $namaFoto;
            
            $berita->save();
            return redirect()->route('berita.index')
            ->with('success_message', 'Berhasil mengubah
            beita');
            }

            public function destroy(Request $request, $id)
            {
            //Menghapus 
            $berita = Berita::find($id);
            if ($berita) {
                $hapus = $berita->delete();
                if ($hapus)  Storage::disk('public')->delete('berita/'.$berita->foto);;
                
            }
            return redirect()->route('berita.index')
            ->with('success_message', 'Berhasil menghapus Berita');
            } 

            public function generateReport()
                {

                    $berita = Berita::all();  // Data to pass to the report view

                    $pdf = new Dompdf();
                    $pdf->loadHtml(View::make('admin/berita.report',['berita' => $berita])->render());

                    // (Optional) Customize the PDF settings, such as paper size and orientation
                    $pdf->setPaper('A4', 'portrait');

                    // Render the HTML to PDF
                    $pdf->render();

                    // Output the PDF file
                    return $pdf->stream('berita.pdf');
                }
        

}