<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('obyek_wisata', function (Blueprint $table) {
            $table->id();
            $table->string('nama_wisata', 255)->unique();
            $table->text('deskripsi_wisata');
            $table->unsignedBigInteger('id_kategori_wisata');
            $table->text('fasilitas');
            $table->text('foto1');
            $table->text('foto2');
            $table->text('foto3');
            $table->text('foto4');
            $table->text('foto5');
            $table->foreign('id_kategori_wisata')->references('id')->on('kategori_wisata') ->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('obyek_wisata');
    }
};