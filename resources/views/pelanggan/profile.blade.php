@extends('adminlte::page')
@section('title', 'User Profile')
@section('content_header')
<h1 class="m-0 text-dark">User Profile </h1>
@stop
@section('content')
<form action="{{route('pelanggan.updatePelanggan')}}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if (session('success_message'))
            @endif
            <div class="card">
                <div class="card-body">
                    <div class="card user-profile">
                        <div class="form-group">
                            <div class="text-center">
                                @if(auth()->user()->pelanggan?->foto )
                                <img src="{{ url('/storage/photo/'.auth()->user()->pelanggan->foto) }}"
                                    class="rounded-circle mt-1" height="150" width="150" id="tampil"
                                    alt="{{ url('/storage/'.auth()->user()->pelanggan->foto) }}">
                                @else
                                <img src="{{ asset('img/no-image.png') }}" class="rounded-circle mt-1" height="150"
                                    width="150" id="tampil">
                                @endif
                                <span class="font-weight-bold">
                                    <input type="file" name="foto" id="foto" class="form-control"> @error('foto') <span
                                        class="textdanger">{{$message}}</span> @enderror
                                </span>
                            </div>

                        </div>
                    </div>
                    <div class="form-group">
                        <label for="nama_lengkap">Nama Lengkap</label>
                        <input type="text" class="form-control
@error('nama_lengkap') is-invalid @enderror" id="nama_lengkap" placeholder="Nama Lengkap" name="nama_lengkap"
                            value="{{Auth::user()->pelanggan ->nama_lengkap ?? '' }}">
                        @error('nama_lengkap') <span class="textdanger">{{$message}}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="no_hp">Nomer Telepon</label>
                        <input type="number" class="form-control
@error('no_hp') is-invalid @enderror" id="no_hp" placeholder="Nomer Telepon" name="no_hp"
                            value="{{Auth::user()->pelanggan ->no_hp ?? '' }}">
                        @error('no_hp') <span class="textdanger">{{$message}}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <textarea type="text" class="form-control"
                            name="alamat">{{Auth::user()->pelanggan ->alamat ?? '' }}</textarea>
                        @error('alamat') <span class="textdanger">{{$message}}</span> @enderror
                    </div>



                    <div class="form-group">
                        <label for="id_user" class="form-label">Email</label>
                        <input class="form-control" type="email" readonly value="{{Auth::user()->email }}"
                            placeholder="john.doe@example.com">
                        @error('id_user') <span class="textdanger">{{$message}}</span> @enderror
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{url('pelanggan')}}" class="btn btn-default">
                        Batal
                    </a>
                </div>
            </div>
        </div>
    </div>

    @stop
    @push('js')
    <script>
    // $('#example2').DataTable({
    //     "responsive": true,
    // });


    // function pilih(id, user) {
    //     document.getElementById('id_user').value = id
    //     document.getElementById('users').value = user
    // }


    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#tampil').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#foto").change(function() {
        readURL(this);
    });
    </script>
    @endpush