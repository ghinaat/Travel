<?php

namespace App\Http\Controllers;
use App\Models\Karyawan;
use App\Models\User;
use PDF;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\View;


use Illuminate\Http\Request;

class TKaryawanController extends Controller
{
    public function index(){
        $Tkaryawan = Karyawan::all();
        return view('admin/Tkaryawan.index', [
        'Tkaryawan' => $Tkaryawan
        ]);
        }
    
        public function create(){
            return view(
                'admin/Tkaryawan.create', [
                'users' => User::all()
        ]);
            }
            
        public function store(Request $request){
            //Menyimpan Data Karyawan
            $request->validate([
            'nama_karyawan' => 'required|unique:karyawan,nama_karyawan',
            'alamat' => 'required',
            'no_hp' => 'required',
            'jabatan' => 'required',
            'id_user' => 'required'
            ]);
            $array = $request->only([
                'nama_karyawan',
                'alamat',
                'no_hp',
                'jabatan',
                'id_user'
            
            ]);
            $Tkaryawan = Karyawan::create($array);
            return redirect()->route('TKaryawan.index')
            ->with('success_message', 'Berhasil menambah kategori wisata
            baru');
            
        }
        
            public function edit($id)
            {
            //Menampilkan Form Edit
            $Tkaryawan = Karyawan::find($id);
            if (!$Tkaryawan) return redirect()->route('Tkaryawan.index')
            ->with('error_message', 'Karyawan dengan id = '.$id.'
            tidak ditemukan');
            return view('admin/Tkaryawan.edit', [
            'Tkaryawan' => $Tkaryawan,
            'users' => User::all()
            //Mengirimkan semua data Users ke Modal pada halaman edit
            ]);
            }

            public function update(Request $request, $id)
            {
            $request->validate([
            'nama_karyawan' => 'required',
            'alamat' => 'required',
            'no_hp' => 'required',
            'jabatan' => 'required',
            'id_user' => 'required'
            ]);
            $user = User::findOrFail(Auth::user()->id);
            $Tkaryawan = Karyawan::find($id);
            $Tkaryawan->nama_karyawan = $request->nama_karyawan;
            $Tkaryawan->alamat = $request->alamat;
            $Tkaryawan->no_hp = $request->no_hp;
            $Tkaryawan->jabatan = $request->jabatan;
            $Tkaryawan->id_user = $request->id_user;
            $Tkaryawan->save();
            return redirect()->route('TKaryawan.index')
            ->with('success_message', 'Berhasil mengubah
            Karyawan');
            } 

            public function destroy(Request $request, $id)
            {
                //Menghapus Data
                $Tkaryawan = Karyawan::find($id);
                if ($Tkaryawan) $Tkaryawan->delete();
                return redirect()->route('TKaryawan.index')->with('success_message', 'Berhasil menghapus karyawan  !');
            }

            public function generateKaryawan()
                {

                    $Tkaryawan = Karyawan::all();  // Data to pass to the report view

                    $pdf = new Dompdf();
                    $pdf->loadHtml(View::make('admin/Tkaryawan.report',['Tkaryawan' => $Tkaryawan])->render());

                    // (Optional) Customize the PDF settings, such as paper size and orientation
                    $pdf->setPaper('A4', 'portrait');

                    // Render the HTML to PDF
                    $pdf->render();

                    // Output the PDF file
                    return $pdf->stream('Karyawan.pdf');
                }

    
}