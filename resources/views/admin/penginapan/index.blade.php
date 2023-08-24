@extends('adminlte::page')
@section('title', 'List Penginapan')
@section('content_header')
<h1 class="m-0 text-dark">List Penginapan</h1>
@stop
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <a href="{{route('penginapan.create')}}" class="btn
                    btn-primary mb-2"><i class="fa fa-plus"></i>
                        Tambah
                    </a>
                    <table class="table table-hover table-bordered
                        table-stripped" id="example2">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Id Penginapan</th>
                                <th>Nama Penginapan</th>
                                <th>Deskripsi</th>
                                <th>Fasilitas</th>
                                <th>Foto1</th>
                                <th>Foto2</th>
                                <th>Foto3</th>
                                <th>Foto4</th>
                                <th>Foto5</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($penginapan as $key => $pn)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$pn->id}}</td>
                                <td id={{$key+1}}>{{$pn->nama_penginapan}}</td>
                                <td id={{$key+1}}>{{$pn->deskripsi}}</td>
                                <td id={{$key+1}}>{{$pn->fasilitas}}</td>
                                <td>
                                    <img src="{{'/storage/hotels/'.$pn->foto1}}"
                                        alt="{{'/storage/hotels/'.$pn->foto1}} tidak tampil" class="img-thumbnail"
                                        width="100" height="100">
                                </td>
                                <td>
                                    <img src="{{'/storage/hotels/'.$pn->foto2}}"
                                        alt="{{'/storage/hotels/'.$pn->foto2}} tidak tampil" class="img-thumbnail"
                                        width="100" height="100">
                                </td>
                                <td>
                                    <img src="{{'/storage/hotels/'.$pn->foto3}}"
                                        alt="{{'/storage/hotels/'.$pn->foto3}} tidak tampil" class="img-thumbnail"
                                        width="100" height="100">
                                </td>
                                <td>
                                    <img src="{{'/storage/hotels/'.$pn->foto4}}"
                                        alt="{{'/storage/hotels/'.$pn->foto4}} tidak tampil" class="img-thumbnail"
                                        width="100" height="100">
                                </td>
                                <td>
                                    <img src="{{'/storage/hotels/'.$pn->foto5}}"
                                        alt="{{'/storage/hotels/'.$pn->foto5}} tidak tampil" class="img-thumbnail"
                                        width="100" height="100">
                                </td>
                                <td>
                                    <a href="{{route('penginapan.edit', $pn)}}" class="btn btn-primary btn-xs">
                                        <i class="fas fa-pen" aria-hidden="true"></i> Edit
                                    </a>
                                    <a href="{{route('penginapan.destroy', $pn)}}"
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
    if (confirm('Apakah anda yakin akan menghapus Data Penginapan ? \"' + document.getElementById(dt)
            .innerHTML + '\" ?')) {
        $("#delete-form").attr('action', $(el).attr('href'));
        $("#delete-form").submit();
    }
}
</script>
@endpush