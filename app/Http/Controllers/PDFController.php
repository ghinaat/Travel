<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PDFController extends Controller
{
    public function exportToPDF()
    {
        $berita = Berita::all(); // Ambil data dari model Profile, sesuaikan dengan kebutuhan Anda

        $pdf = PDF::loadView('berita.export', compact('berita')); // Load view dan berikan data

        return $pdf->download('berita.pdf'); // Download file PDF dengan nama "profiles.pdf"
    }
}