@extends('adminlte::page')
@section('title', 'List Paket Wisata')
@section('content_header')
<h1 class="m-0 text-dark">List Paket Wisata</h1>
@stop
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <a href="{{route('pktwisata.create')}}" class="btn
btn-primary mb-2"><i class="fa fa-plus"></i>
                        Tambah
                    </a>
                    <table class="table table-hover table-bordered
table-stripped" id="example2">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Id Paket Wisata</th>
                                <th>Nama Paket</th>
                                <th>Deskirpsi</th>
                                <th>Fasilitas</th>
                                <th>Harga</th>
                                <th>Diskon</th>
                                <th>Foto1</th>
                                <th>Foto2</th>
                                <th>Foto3</th>
                                <th>Foto4</th>
                                <th>Foto5</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pktwisata as $key => $pw)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$pw->id}}</td>
                                <td id={{$key+1}}>{{$pw->nama_paket}}</td>
                                <td id={{$key+1}}>{{$pw->deskripsi}}</td>
                                <td id={{$key+1}}>{{$pw->fasilitas}}</td>
                                <td id={{$key+1}}>{{ 'Rp ' . number_format($pw->harga_per_pack, 0, ',', '.') }}</td>
                                <td id={{$key+1}}>{{ $pw->diskon ? $pw->diskon . '%' : '-' }}</td>
                                <td>
                                    <img src="{{'/storage/paket/'.$pw->foto1}}" alt="{{$pw->foto1}} tidak tampil"
                                        class="img-thumbnail">
                                </td>
                                <td>
                                    <img src="{{'/storage/paket/'.$pw->foto2}}" alt="{{$pw->foto2}} tidak tampil"
                                        class="img-thumbnail">
                                </td>
                                <td>
                                    <img src="{{'/storage/paket/'.$pw->foto3}}" alt="{{$pw->foto3}} tidak tampil"
                                        class="img-thumbnail">
                                </td>
                                <td>
                                    <img src="{{'/storage/paket/'.$pw->foto4}}" alt="{{$pw->foto4}} tidak tampil"
                                        class="img-thumbnail">
                                </td>
                                <td>
                                    <img src="{{'/storage/paket/'.$pw->foto5}}" alt="{{$pw->foto5}} tidak tampil"
                                        class="img-thumbnail">
                                </td>
                                <td>
                                    <a href="{{route('pktwisata.edit',
$pw)}}" class="btn btn-primary btn-xs"><i class="fas fa-pen" aria-hidden="true"></i>
                                        Edit
                                    </a>
                                    <a href="{{route('pktwisata.destroy', $pw)}}"
                                        onclick="notificationBeforeDelete(event, this, <?php echo $key+1; ?>)"
                                        class="btn btn-danger btn-xs">
                                        <i class="fa fa-trash" aria-hidden="true"></i> Delete
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
@push('js')
<form action="" id="delete-form" method="post">
    @method('delete')
    @csrf
</form>
<script>
$('#example2').DataTable({
    "responsive": true,
});

function notificationBeforeDelete(event, el, dt) {
    event.preventDefault();
    if (confirm('Apakah anda yakin akan menghapus data Paket Wisata \"' + document.getElementById(dt).innerHTML +
            '\" ?')) {
        $("#delete-form").attr('action', $(el).attr('href'));
        $("#delete-form").submit();
    }
}
</script>
@endpush