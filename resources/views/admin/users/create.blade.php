@extends('adminlte::page')
@section('title', 'Tambah User')
@section('content_header')
<h1 class="m-0 text-dark">Tambah User</h1>
@stop
@section('content')
<form action="{{route('users.store')}}" method="post">
    @csrf
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <div class="form-group">
                        <label for="exampleInputEmail">Email
                            address</label>
                        <input type="email" class="form-control
@error('email') is-invalid @enderror" id="exampleInputEmail" placeholder="Masukkan Email" name="email"
                            value="{{old('email')}}">
                        @error('email') <span class="textdanger">{{$message}}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword">Password</label>
                        <input type="password" class="form-control
@error('password') is-invalid @enderror" id="exampleInputPassword" placeholder="Password" name="password">
                        @error('password') <span class="textdanger">{{$message}}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword">Konfirmasi
                            Password</label>
                        <input type="password" class="form-control" id="exampleInputPassword"
                            placeholder="Konfirmasi Password" name="password_confirmation">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputlevel">Level</label>
                        <select class="form-control @error('level') isinvalid @enderror" id="exampleInputlevel"
                            name="level">
                            <option value="admin" @if(old('level')=='admin' )selected @endif>Admin</option>
                            <option value="bendahara" @if(old('level')=='bendahara' )selected @endif>Bendahara</option>
                            <option value="pelanggan" @if(old('level')=='pelanggan' )selected @endif>Pelanggan</option>
                            <option value="pemilik" @if(old('level')=='pemilik' )selected @endif>Pemilik</option>
                        </select>
                        @error('level') <span class="textdanger">{{$message}}</span> @enderror
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{route('users.index')}}" class="btn btn-default">
                        Batal
                    </a>
                </div>
            </div>
        </div>
    </div>
    @stop