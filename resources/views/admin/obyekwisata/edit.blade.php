@extends('adminlte::page')
@section('title', 'Edit Obyek Wisata')
@section('content_header')
<h1 class="m-0 text-dark">Edit Obyek Wisata</h1>
@stop
@section('content')
<form action="{{route('obwisata.update', $obwisata)}}" method="post" enctype="multipart/form-data">
    @method('PUT')
    @csrf
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <label for="nama_wisata">Nama Wisata</label>
                        <input type="text" class="form-control
@error('nama_wisata') is-invalid @enderror" id="nama_wisata" placeholder="Obyek Wisata" name="nama_wisata"
                            value="{{$obwisata->nama_wisata ??old('nama_wisata')}}">
                        @error('nama_wisata') <span class="textdanger">{{$message}}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="deskripsi_wisata">Deskripsi</label>
                        <textarea type="text" class="form-control"
                            name="deskripsi_wisata">{{$obwisata->deskripsi_wisata ??old('deskripsi_wisata')}}</textarea>
                        @error('deskripsi_wisata') <span class="textdanger">{{$message}}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="id_kategori_wisata">Kategori Wisata</label>
                        <div class="input-group">
                            <input type="hidden" name="id_kategori_wisata" id="id_kategori_wisata"
                                value="{{$obwisata->fobykwisata->id ?? old('id_kategori_wisata')}}">
                            <input type="text" class="form-control
@error('kategori_wisata') is-invalid @enderror" placeholder="Kategori Wisata" id="kategori_wisata"
                                name="kategori_wisata"
                                value="{{$obwisata->fobykwisata->kategori_wisata ?? old('kategori_wisata')}}"
                                arialabel="Kategori Wisata" aria-describedby="cari" readonly>
                            <button class="btn btn-warning" type="button" data-bs-toggle="modal" id="cari"
                                data-bs-target="#staticBackdrop"></i>
                                Cari Data Kategori Wisata</button>
                        </div>
                        <div class="form-group">
                            <label for="fasilatas">Fasilitas</label>
                            <input type="text" class="form-control
@error('fasilitas') is-invalid @enderror" id="fasilitas" placeholder="Fasilitas" name="fasilitas"
                                value="{{$obwisata->fasilitas ??old('fasilitas')}}">
                            @error('fasilitas') <span class="textdanger">{{$message}}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label for="foto1" class="formlabel">Foto1</label>
                            @if($penginapan?->foto1 )
                            <img src="{{ asset('/storage/hotels/'.$penginapan->foto1) }}" class="imgthumbnail d-block"
                                name="tampil1" alt="..." width="10%" id="tampil1"
                                alt="{{ asset('/storage/'.$penginapan->foto1) }}">
                            @else
                            <img src="/img/no-image.png" class="imgthumbnail d-block" name="tampil1" alt="..."
                                width="10%" id="tampil1">
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
                            <img src="/img/no-image.png" class="imgthumbnail d-block" name="tampil2" alt="..."
                                width="10%" id="tampil2">
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
                            <img src="/img/no-image.png" class="imgthumbnail d-block" name="tampil3" alt="..."
                                width="10%" id="tampil3">
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
                            <img src="/img/no-image.png" class="imgthumbnail d-block" name="tampil4" alt="..."
                                width="10%" id="tampil4">
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
                            <img src="/img/no-image.png" class="imgthumbnail d-block" name="tampil5" alt="..."
                                width="10%" id="tampil5">
                            @endif
                            <input class="form-control @error('foto5') isinvalid @enderror" type="file" id="foto5"
                                name="foto5">
                            @error('foto5') <span class="textdanger">{{$message}}</span> @enderror
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{route('obwisata.index')}}" class="btn
btn-default">
                            Batal
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-scrollable p-5">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Pencarian Data Kategori Wisata</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <table class="table table-hover table-bordered tablestripped" id="example2">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Kategori Wisata</th>
                                    <th>Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($ktwisata as $key => $kw)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td id={{$key+1}}>{{$kw->kategori_wisata}}</td>
                                    <td>
                                        <button type="button" class="btn btn-primary
btn-xs" onclick="pilih('{{$kw->id}}', '{{$kw->kategori_wisata}}')" data-bs-dismiss="modal">
                                            Pilih
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Modal -->
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
        $('#example2').DataTable({
            "responsive": true,
        });


        function pilih(id, ktwst) {
            document.getElementById('id_kategori_wisata').value = id
            document.getElementById('kategori_wisata').value = ktwst
        }
        </script>

        @endpush