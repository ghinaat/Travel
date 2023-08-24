@extends('adminlte::page')
@section('title', 'Edit Berita')
@section('content_header')
<h1 class="m-0 text-dark">Edit Berita</h1>
@stop
@section('content')
<form action="{{route('berita.update', $berita)}}" method="post" enctype="multipart/form-data">
    @method('PUT')
    @csrf
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <label for="judul">Judul</label>
                        <input type="text" class="form-control
@error('judul') is-invalid @enderror" id="judul" placeholder="Berita" name="judul"
                            value="{{$berita->judul ?? old('judul')}}">
                        @error('judul') <span class="textdanger">{{$message}}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="berita">Berita</label>
                        <textarea rows="7" class="form-control
@error('berita') is-invalid @enderror" id="berita" name="berita">"{{$berita->berita ?? old('berita')}}"</textarea>
                        @error('berita') <span class="textdanger">{{$message}}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="tgl_post">Tanggal Upload</label>
                        <input type="date" class="form-control"
                            class="form-control @error('tgl_post') is-invalid @enderror" id="tgl_post"
                            placeholder="Tanggal Upload" name="tgl_post"
                            value="{{$berita->tgl_post ?? old('tgl_post')}}">
                        @error('tgl_post') <span class="textdanger">{{$message}}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="id_kategori_berita">Kategori Berita</label>
                        <div class="input-group">
                            <input type="hidden" name="id_kategori_berita" id="id_kategori_berita"
                                value="{{$berita->fberita->id ??old('id_kategori_berita')}}">
                            <input type="text" class="form-control
@error('kategori_berita') is-invalid @enderror" placeholder="Kategori Berita" id="kategori_berita"
                                name="kategori_berita"
                                value="{{$berita->fberita->kategori_berita ??old('kategori_berita')}}"
                                arialabel="Kategori Berita" aria-describedby="cari" readonly>
                            <button class="btn btn-warning" type="button" data-bs-toggle="modal" id="cari"
                                data-bs-target="#staticBackdrop"></i>
                                Cari Data Kategori Berita</button>
                        </div>

                        <div class="form-group">
                            <label for="foto" class="formlabel">Foto</label>
                            @if($berita?->foto )
                            <img src="{{ url('/storage/berita/'.$berita->foto) }}" class="imgthumbnail d-block"
                                name="tampil1" alt="..." width="10%" id="tampil1"
                                alt="{{ url('/storage/'.$berita->foto) }}">
                            @else
                            <img src="/img/no-image.png" class="imgthumbnail d-block" name="tampil1" alt="..."
                                width="10%" id="tampil1">
                            @endif
                            <input class="form-control @error('foto') isinvalid @enderror" type="file" id="foto"
                                name="foto">
                            @error('foto') <span class="textdanger">{{$message}}</span> @enderror
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a href="{{route('berita.index')}}" class="btn
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
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Pencarian Data Kategori Berita</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <table class="table table-hover table-bordered tablestripped" id="example2">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Kategori Berita</th>
                                        <th>Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($ktberita as $key => $kb)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td id={{$key+1}}>{{$kb->kategori_berita}}</td>
                                        <td>
                                            <button type="button" class="btn btn-primary
btn-xs" onclick="pilih('{{$kb->id}}', '{{$kb->kategori_berita}}')" data-bs-dismiss="modal">
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
            $("#foto").change(function() {
                readURL(this);

            });


            $('#example2').DataTable({
                "responsive": true,
            });


            function pilih(id, kbrt) {
                document.getElementById('id_kategori_berita').value = id
                document.getElementById('kategori_berita').value = kbrt
            }
            </script>

            @endpush