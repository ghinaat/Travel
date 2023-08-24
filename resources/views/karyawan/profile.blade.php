@extends('adminlte::page')
@section('title', 'Karyawan Profile')
@section('content_header')
<h1 class="m-0 text-dark">Karyawan Profile </h1>
@stop
@section('content')
<form action="{{route('karyawan.updateKaryawan')}}" method="post" enctype="multipart/form-data">
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

                                <img src="{{ asset('img/no-image.png') }}" class="rounded-circle mt-1" height="150"
                                    width="150" id="tampil">

                                <span class="font-weight-bold">

                                </span>
                            </div>

                        </div>
                    </div>
                    <div class="form-group">
                        <label for="nama_karyawan">Nama Lengkap</label>
                        <input type="text" class="form-control
@error('nama_karyawan') is-invalid @enderror" id="nama_karyawan" placeholder="Nama Lengkap" name="nama_karyawan"
                            value="{{Auth::user()->karyawan ->nama_karyawan ?? '' }}">
                        @error('nama_karyawan') <span class="textdanger">{{$message}}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="no_hp">Nomer Telepon</label>
                        <input type="number" class="form-control
@error('no_hp') is-invalid @enderror" id="no_hp" placeholder="Nomer Telepon" name="no_hp"
                            value="{{Auth::user()->karyawan ->no_hp ?? '' }}">
                        @error('no_hp') <span class="textdanger">{{$message}}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <textarea type="text" class="form-control"
                            name="alamat">{{Auth::user()->karyawan ->alamat ?? '' }}</textarea>
                        @error('alamat') <span class="textdanger">{{$message}}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="jabatan" class="form-label">Jabatan</label>
                        <input class="form-control" type="text" readonly value="{{Auth::user()->level }}">
                        @error('jabatan') <span class="textdanger">{{$message}}</span> @enderror
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
                    <a href="{{url('karyawan')}}" class="btn btn-default">
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
    </script>
    @endpush