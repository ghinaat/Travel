<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'email',
        'password',
        'level',
        'aktif'
    ];
    public function pelanggan()
    {
        return $this->hasOne(Pelanggan::class, 'id_user', 'id');
    }

    public function karyawan()
    {
        return $this->hasOne(Karyawan::class, 'id_user', 'id');
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function adminlte_desc()
    {
        return (auth()->user()->email) ;

        
    }

    public function adminlte_profile_url()
    {
        if (auth()->user()->level == 'pelanggan') {
            return 
                '/pelanggan';
        }else{
            return '/karyawan';
        }
    }
   
    public function adminlte_image()
    
    {
        
        if(auth()->user()->pelanggan?->foto ){
            return asset ('/storage/photo/'.auth()->user()->pelanggan->foto);
        }else{
          return asset ("/img/no-image.png");
         }
    }
}