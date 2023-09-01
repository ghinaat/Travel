<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\KategoriWisata;
use App\Models\KategoriBerita;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        KategoriWisata::create([
            'kategori_wisata' => 'Petualangan',
        ]);

        KategoriWisata::create([
            'kategori_wisata' => 'Pendidikan',
        ]);

        KategoriWisata::create([
            'kategori_wisata' => 'Permainan',
        ]);

        KategoriBerita::create([
            'kategori_berita' => 'Edukatif',
        ]);

        KategoriBerita::create([
            'kategori_berita' => 'Liburan',
        ]);

        KategoriBerita::create([
            'kategori_berita' => 'Lalu Lintas',
        ]);

        User::create([
            'email' => 'admin@admin.com',
            'password' => '12345678',
            'level' => 'admin',
        ]);

        User::create([
            'email' => 'bendahara@gmail.com',
            'password' => '12345678',
            'level' => 'bendahara',
        ]);

        User::create([
            'email' => 'pemilik@gmail.com',
            'password' => '12345678',
            'level' => 'pemilik',
        ]);

        User::create([
            'email' => 'ghina@gmail.com',
            'password' => '12345678',
            'level' => 'pelanggan',
        ]);

        \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}