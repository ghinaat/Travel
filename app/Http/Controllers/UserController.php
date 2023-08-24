<?php

namespace App\Http\Controllers;
use App\Models\User;
use PDF;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\View;

use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
     $user = User::all();
     return view('admin\users.index', [
     'users' => $user
     ]);
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    //Menampilkan Form Tambah User
    return view('admin\users.create');
    } 

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    //Menyimpan Data User Baru
    $request->validate([
    'email' => 'required|email|unique:users,email',
    'password' => 'required|confirmed',
    'level' => 'required'
    ]);
    $array = $request->only([
    'email', 'password', 'level', 'aktif'
    ]);
    $array['password'] = bcrypt($array['password']);
    $user = User::create($array);
    return redirect()->route('users.index')
    ->with('success_message', 'Berhasil menambah user baru');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
    //Menampilkan Form Edit
    $user = User::find($id);
    if (!$user) return redirect()->route('admin\users.index')
    ->with('error_message', 'User dengan id'.$id.' tidak
    ditemukan');
    return view('admin\users.edit', [
    'user' => $user
    ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
    //Mengedit Data User
    $request->validate([
    'email' => 'required|email|unique:users,email,'.$id,
    'password' => 'sometimes|nullable|confirmed',
    'level' => 'required',
    'aktif' => 'required'
    ]);
    $user = User::find($id);
    $user->email = $request->email;
    if ($request->password) $user->password = bcrypt($request->password);
    $user->level = $request->level;
    $user->aktif = $request->aktif;
    $user->save();
    return redirect()->route('users.index')->with('success_message', 'Berhasil mengubah user');
    } 

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
    //Menghapus User
    $user = User::find($id);

    if ($id == $request->user()->id) return redirect()->route('admin\users.index')
    ->with('error_message', 'Anda tidak dapat menghapus diri
    sendiri.');
    if ($user) $user->delete();
    return redirect()->route('users.index')->with('success_message', 'Berhasil menghapus user');
    } 

    public function generateReport()
                {

                    $user = User::all();  // Data to pass to the report view

                    $pdf = new Dompdf();
                    $pdf->loadHtml(View::make('admin/user.report',['user' => $user])->render());

                    // (Optional) Customize the PDF settings, such as paper size and orientation
                    $pdf->setPaper('A4', 'portrait');

                    // Render the HTML to PDF
                    $pdf->render();

                    // Output the PDF file
                    return $pdf->stream('user.pdf');
                }
}