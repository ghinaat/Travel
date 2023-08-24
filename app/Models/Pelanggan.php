<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    use HasFactory;
    protected $table = 'pelanggan';
    protected $fillable = [
    'nama_lengkap',
    'no_hp',
    'alamat',
    'foto',
    'id_user',
    
    ];

    public function fuser(){
        return $this->belongsTo(User::class, 'id_user', 'id'
    );
        }
    
        public function reservasi()
    {
        return $this->hasOne(Reservasi::class, 'id_pelanggan', 'id');
    }


  
}