@extends('adminlte::page')
@section('title', 'Edit Paket Wisata')
@section('content_header')
<h1 class="m-0 text-dark">Edit Paket Wisata</h1>
@stop
@section('content')
<form action="{{route('pktwisata.update', $pktwisata)}}" method="post" enctype="multipart/form-data">
    @method('PUT')
    @csrf
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <label for="nama_paket">Nama Paket</label>
                        <input type="text" class="form-control
@error('nama_paket') is-invalid @enderror" id="nama_paket" placeholder="Nama Paket" name="nama_paket"
                            value="{{$pktwisata->nama_paket ??old('nama_paket')}}">
                        @error('nama_paket') <span class="textdanger">{{$message}}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="deskripsi">Deskripsi</label>
                        <textarea type="text" class="form-control"
                            name="deskripsi">{{$pktwisata->deskripsi ??old('deskripsi')}}</textarea>
                        @error('deskripsi') <span class="textdanger">{{$message}}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="fasilitas">Fasilitas</label>
                        <input type="text" class="form-control
@error('fasilitas') is-invalid @enderror" id="fasilitas" placeholder="Fasilitas" name="fasilitas"
                            value="{{$pktwisata->fasilitas ??old('fasilitas')}}">
                        @error('fasilitas') <span class="textdanger">{{$message}}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="harga_per_pack">Harga</label>
                        <input type="number" class="form-control
@error('harga_per_pack') is-invalid @enderror" id="harga_per_pack" placeholder="Harga" name="harga_per_pack"
                            value="{{$pktwisata->harga_per_pack ??old('harga_per_pack')}}">
                        @error('harga_per_pack') <span class="textdanger">{{$message}}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="diskon">Diskon</label>
                        <input type="number" class="form-control
@error('diskon') is-invalid @enderror" id="diskon" placeholder="Diskon" name="diskon"
                            value="{{$pktwisata->diskon ??old('diskon')}}">
                        @error('diskon') <span class="textdanger">{{$message}}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="foto1" class="formlabel">Foto1</label>
                        <img src="/img/no-image.png" class="imgthumbnail d-block" name="tampil1" alt="..." width="15%"
                            id="tampil1">
                        <input class="form-control @error('foto1') isinvalid @enderror" type="file" id="foto1"
                            name="foto1">
                        @error('foto1') <span class="textdanger">{{$message}}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="foto2" class="formlabel">Foto2</label>
                        <img src="/img/no-image.png" class="imgthumbnail d-block" name="tampil2" alt="..." width="15%"
                            id="tampil2">
                        <input class="form-control @error('foto2') isinvalid @enderror" type="file" id="foto2"
                            name="foto2">
                        @error('foto2') <span class="textdanger">{{$message}}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="foto3" class="formlabel">Foto3</label>
                        <img src="/img/no-image.png" class="imgthumbnail d-block" name="tampil3" alt="..." width="15%"
                            id="tampil3">
                        <input class="form-control @error('foto3') isinvalid @enderror" type="file" id="foto3"
                            name="foto3">
                        @error('foto3') <span class="textdanger">{{$message}}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="foto4" class="formlabel">Foto4</label>
                        <img src="/img/no-image.png" class="imgthumbnail d-block" name="tampil4" alt="..." width="15%"
                            id="tampil4">
                        <input class="form-control @error('foto4') isinvalid @enderror" type="file" id="foto4"
                            name="foto4">
                        @error('foto4') <span class="textdanger">{{$message}}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="foto5" class="formlabel">Foto5</label>
                        <img src="/img/no-image.png" class="imgthumbnail d-block" name="tampil5" alt="..." width="15%"
                            id="tampil5">
                        <input class="form-control @error('foto5') isinvalid @enderror" type="file" id="foto5"
                            name="foto5">
                        @error('foto5') <span class="textdanger">{{$message}}</span> @enderror
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{route('pktwisata.index')}}" class="btn
btn-default">
                        Batal
                    </a>
                </div>
            </div>
        </div>
    </div>
    @stop
    @push('js')

    <script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#tampil1').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }

    }
    $("#foto1").change(function() {
        readURL(this);

    });

    function readURL1(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#tampil2').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }

    }
    $("#foto2").change(function() {
        readURL1(this);

    });

    function readURL2(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#tampil3').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }

    }
    $("#foto3").change(function() {
        readURL2(this);

    });

    function readURL3(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#tampil4').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }

    }
    $("#foto4").change(function() {
        readURL3(this);

    });

    function readURL4(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#tampil5').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }

    }
    $("#foto5").change(function() {
        readURL4(this);

    });
    </script>

    @endpush