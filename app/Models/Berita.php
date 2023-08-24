<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    use HasFactory;
    protected $table = 'berita';
    protected $fillable = [
        'judul',
        'berita',
        'tgl_post',
        'id_kategori_berita',
        'foto',
    ];

    public function fberita(){
        return $this->belongsTo(KategoriBerita::class, 'id_kategori_berita', 'id');
        }
}