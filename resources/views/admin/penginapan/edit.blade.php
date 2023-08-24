@extends('adminlte::page')
@section('title', 'Edit Penginapan')
@section('content_header')
<h1 class="m-0 text-dark">Edit Penginapan</h1>
@stop
@section('content')
<form action="{{route('penginapan.update', $penginapan)}}" method="post" enctype="multipart/form-data">
    @method('PUT')
    @csrf
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <label for="nama_penginapan">Nama Penginapan</label>
                        <input type="text" class="form-control
@error('nama_penginapan') is-invalid @enderror" id="nama_penginapan" placeholder="Nama Penginapan"
                            name="nama_penginapan" value="{{$penginapan->nama_penginapan ??old('nama_penginapan')}}">
                        @error('nama_penginapan') <span class="textdanger">{{$message}}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="deskripsi">Deskripsi</label>
                        <textarea type="text" class="form-control"
                            name="deskripsi">{{$penginapan->deskripsi ??old('deskripsi')}}</textarea>
                        @error('deskripsi') <span class="textdanger">{{$message}}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="fasilitas">Fasilitas</label>
                        <input type="text" class="form-control
@error('fasilitas') is-invalid @enderror" id="fasilitas" placeholder="Fasilitas" name="fasilitas"
                            value="{{$penginapan->fasilitas ??old('fasilitas')}}">
                        @error('fasilitas') <span class="textdanger">{{$message}}</span> @enderror
                    </div>

                    <div class="form-group">
                        <label for="foto1" class="formlabel">Foto1</label>
                        @if($penginapan?->foto1 )
                        <img src="{{ asset('/storage/hotels/'.$penginapan->foto1) }}" class="imgthumbnail d-block"
                            name="tampil1" alt="..." width="10%" id="tampil1"
                            alt="{{ asset('/storage/'.$penginapan->foto1) }}">
                        @else
                        <img src="/img/no-image.png" class="imgthumbnail d-block" name="tampil1" alt="..." width="10%"
                            id="tampil1">
                        @endif

                        <input class="form-control @error('foto1') isinvalid @enderror" type="file"
                            value="{{ $penginapan->foto1 }}" id="foto1" name="foto1">
                        @error('foto1') <span class="textdanger">{{$message}}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="foto2" class="formlabel">Foto2</label>
                        @if($penginapan?->foto2 )
                        <img src="{{ url('/storage/hotels/'.$penginapan->foto2) }}" class="imgthumbnail d-block"
                            name="tampil2" alt="..." width="10%" id="tampil2"
                            alt="{{ url('/storage/'.$penginapan->foto2) }}">
                        @else
                        <img src="/img/no-image.png" class="imgthumbnail d-block" name="tampil2" alt="..." width="10%"
                            id="tampil2">
                        @endif

                        <input class="form-control @error('foto2') isinvalid @enderror" type="file" id="foto2"
                            name="foto2">
                        @error('foto2') <span class="textdanger">{{$message}}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="foto3" class="formlabel">Foto3</label>
                        @if($penginapan?->foto3 )
                        <img src="{{ url('/storage/hotels/'.$penginapan->foto3) }}" class="imgthumbnail d-block"
                            name="tampil3" alt="..." width="10%" id="tampil3"
                            alt="{{ url('/storage/'.$penginapan->foto3) }}">
                        @else
                        <img src="/img/no-image.png" class="imgthumbnail d-block" name="tampil3" alt="..." width="10%"
                            id="tampil3">
                        @endif
                        <input class="form-control @error('foto3') isinvalid @enderror" type="file" id="foto3"
                            name="foto3">
                        @error('foto3') <span class="textdanger">{{$message}}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="foto4" class="formlabel">Foto4</label>
                        @if($penginapan?->foto4 )
                        <img src="{{ url('/storage/hotels/'.$penginapan->foto4) }}" class="imgthumbnail d-block"
                            name="tampil4" alt="..." width="10%" id="tampil4"
                            alt="{{ url('/storage/'.$penginapan->foto4) }}">
                        @else
                        <img src="/img/no-image.png" class="imgthumbnail d-block" name="tampil4" alt="..." width="10%"
                            id="tampil4">
                        @endif

                        <input class="form-control @error('foto4') isinvalid @enderror" type="file" id="foto4"
                            name="foto4">
                        @error('foto4') <span class="textdanger">{{$message}}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="foto5" class="formlabel">Foto5</label>
                        @if($penginapan?->foto5 )
                        <img src="{{ url('/storage/hotels/'.$penginapan->foto5) }}" class="imgthumbnail d-block"
                            name="tampil5" alt="..." width="10%" id="tampil5"
                            alt="{{ url('/storage/'.$penginapan->foto5) }}">
                        @else
                        <img src="/img/no-image.png" class="imgthumbnail d-block" name="tampil5" alt="..." width="10%"
                            id="tampil5">
                        @endif
                        <input class="form-control @error('foto5') isinvalid @enderror" type="file" id="foto5"
                            name="foto5">
                        @error('foto5') <span class="textdanger">{{$message}}</span> @enderror
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{route('penginapan.index')}}" class="btn
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