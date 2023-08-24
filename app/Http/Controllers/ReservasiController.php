<?php

namespace App\Http\Controllers;
use App\Models\PaketWisata;
use App\Models\Pelanggan;
use App\Models\Reservasi;
use Illuminate\Http\Request;
use PDF;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\View;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ReservasiController extends Controller
{
   

    public function index(){
       if(Auth::user()->level == 'pelanggan'){
    
       $reservasi = Reservasi::where('id_pelanggan', Auth::user()->pelanggan?->id)->get();
       }else{
        $reservasi = Reservasi::all();
       }
        return view('reservasi.index', compact('reservasi'));
        }

        public function create(){
            
           
            return view(
                'reservasi.create', [
                    'pelanggan' => Pelanggan::all(),
                    'pktwisata' => PaketWisata::all(),
                    
            ]);
         
        }

        public function store(Request $request) {
            //Menyimpan Data 
            // $pktwisata = PaketWisata::findOrFail(paketwisata()->id);
            $request->validate([ 

                'id_paket' => 'required',
                'tgl_reservasi_wisata'=> 'required',
                'harga' => 'nullable|numeric',
                'jumlah_peserta'=> 'required',
                'diskon'=> 'nullable|numeric',
                'nilai_diskon'=> 'required',
                'total_bayar'=> 'nullable|numeric',
                
                'file_bukti_tf'=> 'nullable', 'image','mimes:png,jpg,jpeg', 'max:2048',
                'status_reservasi_wisata'=> 'required',
                
                ]);
                $pelanggan = Pelanggan::findOrFail(Auth::user()->id);
                $reservasi = new Reservasi();
                
                
                $reservasi->id_pelanggan = $pelanggan->id;
                $reservasi->id_paket = $request->id_paket;
                $reservasi->tgl_reservasi_wisata = $request->tgl_reservasi_wisata;
                $reservasi->harga = $request->harga;

                $reservasi->jumlah_peserta = $request->jumlah_peserta;
                $reservasi->diskon = $request->diskon;
                $reservasi->nilai_diskon = $request->nilai_diskon;
                if ($request->hasFile('file_bukti_tf')) {
                    $file_bukti_tf = $request->file('file_bukti_tf');
                $namaFoto = time() . '.' . $file_bukti_tf->getClientOriginalExtension();
                Storage::disk('public')->put('reservasi/'.$namaFoto, file_get_contents($file_bukti_tf));
                $reservasi->file_bukti_tf = $namaFoto; 
                };
               
                $reservasi->total_bayar = $request->total_bayar;

                $reservasi->status_reservasi_wisata = $request->status_reservasi_wisata;
             
                
                $reservasi->save();
             
                return redirect()->route('reservasi.index')->with('success_message', 'Berhasil menambah Paket Wisata baru');
        }
        public function laporanReservasi(Request $request){
            $tanggal = $request->input('tgl_reservasi_wisata');
            $pelanggan = Pelanggan::all();
            $reservasi = Reservasi::whereDate('tgl_reservasi_wisata', $tanggal)->get();
            return view('reservasi/laporan', [
            'pelanggan' => Pelanggan::all(),
            'reservasi' => $reservasi,
            
    ]);
        }

    //    public function laporanReservasi(Request $request)
    //     {
    //         $tanggal = $request->input('tgl_reservasi_wisata');
    //         $pelanggan = $request->input('id_pelanggan');
            
    //         // Query untuk mendapatkan data reservasi berdasarkan tanggal dan status
    //         $reservasi = Reservasi::whereDate('tgl_reservasi_wisata', $tanggal)
    //             ->where('id_pelanggan', $pelanggan)
    //             ->get();
         
    //         return view('reservasi/laporan',['pelanggan'=>$pelanggan,
    //     'reservasi'=>$reservasi ]);
    //     }


    public function downloadpdf(Request $request)
    {
        $tanggal = $request->input('tgl_reservasi_wisata');
       
        $reservasi = Reservasi::whereDate('tgl_reservasi_wisata', $tanggal)->get();
        
       
        $pdf = PDF::loadView('reservasi/report',  [
            'pelanggan' => Pelanggan::all(),
            'reservasi' => $reservasi,
            
    ]);
        $pdf->setPaper('A4', 'landscape');
        return $pdf->stream('laporan-pdf');
    }

    public function edit($id)
    {
    //Menampilkan Form Edit
    $reservasi = Reservasi::find($id);
    if (!$reservasi) return redirect()->route('reservasi.index')
    ->with('error_message', 'Reservasi dengan id = '.$id.'
    tidak ditemukan');
    return view('reservasi.edit', [
    'reservasi' => $reservasi,
    'pelanggan' => Pelanggan::all(),
    'pktwisata' => PaketWisata::all(),
    ]);
    }
    

    public function update(Request $request, $id)
    {
    //Mengedit Data Kategori Wisata
    $request->validate([
    'tgl_reservasi_wisata'=> 'required',
   
    
    'file_bukti_tf'=> 'nullable', 'image','mimes:png,jpg,jpeg', 'max:2048',
    'status_reservasi_wisata'=> 'required',
    ]);
    $reservasi = Reservasi::find($id);
    $reservasi->tgl_reservasi_wisata = $request->tgl_reservasi_wisata;
    if ($request->hasFile('file_bukti_tf')) {
        $file_bukti_tf = $request->file('file_bukti_tf');
    $namaFoto = time() . '.' . $file_bukti_tf->getClientOriginalExtension();
    Storage::disk('public')->put('reservasi/'.$namaFoto, file_get_contents($file_bukti_tf));
    };
    Storage::disk('public')->delete('reservasi/'.$reservasi?->file_bukti_tf);
    $reservasi-> file_bukti_tf = $namaFoto;
    $reservasi->total_bayar = $request->total_bayar;
    $reservasi->save();
    return redirect()->route('reservasi.index')
    ->with('success_message', 'Berhasil mengubah Reservasi');
    } 

    public function destroy(Request $request, $id)
                {
                //Menghapus 
                $reservasi = Reservasi::find($id);
                if ($reservasi) {
                    $hapus = $reservasi->delete();
                    if ($hapus) unlink("storage/reservasi/" . $reservasi->file_bukti_tf);
                   
                }
                return redirect()->route('reservasi.index')
                ->with('success_message', 'Berhasil menghapus reservasi');
                } 


        // public function downloadpdf(Request $request)
        // {
        //     $tanggal = $request->input('tgl_reservasi_wisata');
        //     $status = $request->input('status_reservasi_wisata');
        
        //     $reservasi = $this->laporanReservasi($request);

        //     $pdf = new Dompdf();
        //     $pdf->loadHtml(View::make('reservasi/report',['reservasi' => $reservasi])->render());

        //     // (Optional) Customize the PDF settings, such as paper size and orientation
        //     $pdf->setPaper('A4', 'landscape');

        //     // Render the HTML to PDF
        //     $pdf->render();

        //     // Output the PDF file
        //     return $pdf->stream('reservasi.pdf');
        // }

        

        // public function laporanReservasi(Request $request)
        // {
        //     $tanggalReservasi = $request->input('tgl_reservasi_wisata');
        //     $idPelanggan = $request->input('id_pelanggan');

        //     $reservasi = Reservasi::where('tgl_reservasi_wisata', $tanggalReservasi)
        //         ->where('id_pelanggan', $idPelanggan)
        //         ->get();

        //     return view('reservasi.laporan', compact('laporan'));
        // }

        
}