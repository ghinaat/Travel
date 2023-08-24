<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaketWisata extends Model
{
    use HasFactory;
    protected $table = 'paket_wisata';
    protected $fillable = [
    'nama_paket',
    'deskripsi',
    'fasilitas',
    'harga_per_pack',
    'diskon',
    'foto1',
    'foto2',
    'foto3',
    'foto4',
    'foto5',

    ];
    public function reservasi()
    {
        return $this->hasOne(Reservasi::class, 'id_paket', 'id');
    }

}