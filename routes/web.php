<?php
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\TKaryawanController;
use App\Http\Controllers\PenginapanController;
use App\Http\Controllers\ReservasiController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| 
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('demo');
});


Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



Route::group([
    'prefix' => '/admin',
    'middleware' => 'auth'],
    function(){
        Route::resource('users', \App\Http\Controllers\UserController::class);
        Route::resource('ktberita', \App\Http\Controllers\KategoriBeritaController::class);
        Route::resource('berita', \App\Http\Controllers\BeritaController::class);
        Route::resource('penginapan', \App\Http\Controllers\PenginapanController::class);
       
        Route::resource('ktwisata', \App\Http\Controllers\KategoriWisataController::class);
        Route::resource('obwisata', \App\Http\Controllers\ObyekWisataController::class);
        Route::resource('TKaryawan', \App\Http\Controllers\TKaryawanController::class);
        Route::get('/generateKaryawan', [KaryawanController::class, 'generateKaryawan'])->name('karyawan.report');


        
    });

    Route::middleware(['auth'])->group(function () {
        Route::get('pelanggan/create',[PelangganController::class,'create'])->name('pelanggan.create');
        Route::get('pelanggan',[PelangganController::class,'index']);
       
        
        Route::post('pelanggan',[PelangganController::class,'updatePelanggan'])->name('pelanggan.updatePelanggan');
        Route::get('karyawan',[KaryawanController::class,'index'])->name('karyawan.index');
        Route::get('karyawan/create',[KaryawanController::class,'create'])->name('karyawan.create');
        Route::post('karyawan',[KaryawanController::class,'updateKaryawan'])->name('karyawan.updateKaryawan');
        // Route::get('reservasi',[ReservasiController::class,'index'])->name('reservasi.index');
        // Route::post('/reservasi', [ReservasiController::class, 'store'])->name('reservasi.store');
        // Route::get('/reservasi/create', [ReservasiController::class, 'create'])->name('reservasi.create');

        // Route::get('/reservasi/{id}/edit', [ReservasiController::class, 'edit'])->name('reservasi.edit');
        // Route::put('reservasi',[ReservasiController::class,'update'])->name('reservasi.update');
        // Route::delete('/reservasi/{id}', [ReservasiController::class, 'destroy'])->name('reservasi.destroy');
        Route::get('/laporan', [ReservasiController::class, 'laporanReservasi'])->name('reservasi.laporan');
        // Route::get('/report', [ReservasiController::class, 'generateReport'])->name('reservasi.report');
        Route::get('/download-report', [ReservasiController::class, 'downloadpdf']);
        Route::resource('pktwisata', \App\Http\Controllers\PaketWisataController::class);
        Route::resource('reservasi', \App\Http\Controllers\ReservasiController::class);
       
    });

   

  

        // Route::resource('reservasi', \App\Http\Controllers\ReservasiController::class);

    