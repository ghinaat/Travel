@extends('adminlte::page')
@section('title', 'List Obyek Wisata')
@section('content_header')
<h1 class="m-0 text-dark">List Obyek Wisata</h1>
@stop
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <a href="{{route('obwisata.create')}}" class="btn
btn-primary mb-2"><i class="fa fa-plus"></i>
                        Tambah
                    </a>
                    <table class="table table-hover table-bordered
table-stripped" id="example2">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Id Obyek Wisata</th>
                                <th>Nama Wisata</th>
                                <th>Deskripsi</th>
                                <th>Kategori Wisata</th>
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
                            @foreach($obwisata as $key => $ow)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$ow->id}}</td>
                                <td id={{$key+1}}>{{$ow->nama_wisata}}</td>
                                <td id={{$key+1}}>{{$ow->deskripsi_wisata}}</td>
                                <td id={{$key+1}}>{{$ow->fobykwisata->kategori_wisata}}</td>
                                <td id={{$key+1}}>{{$ow->fasilitas}}</td>
                                <td>
                                    <img src="{{'/storage/obyek/'.$ow->foto1}}" alt="{{$ow->foto1}} tidak tampil"
                                        class="img-thumbnail">
                                </td>
                                <td>
                                    <img src="{{'/storage/obyek/'.$ow->foto2}}" alt="{{$ow->foto2}} tidak tampil"
                                        class="img-thumbnail">
                                </td>
                                <td>
                                    <img src="{{'/storage/obyek/'.$ow->foto3}}" alt="{{$ow->foto3}} tidak tampil"
                                        class="img-thumbnail">
                                </td>
                                <td>
                                    <img src="{{'/storage/obyek/'.$ow->foto4}}" alt="{{$ow->foto4}} tidak tampil"
                                        class="img-thumbnail">
                                </td>
                                <td>
                                    <img src="{{'/storage/obyek/'.$ow->foto5}}" alt="{{$ow->foto5}} tidak tampil"
                                        class="img-thumbnail">
                                </td>

                                <td>
                                    <a href="{{route('obwisata.edit',
$ow)}}" class="btn btn-primary btn-xs"><i class="fas fa-pen" aria-hidden="true"></i>
                                        Edit
                                    </a>
                                    <a href="{{route('obwisata.destroy', $ow)}}"
                                        onclick="notificationBeforeDelete(event, this, <?php echo $key+1; ?>)"
                                        class="btn btn-danger btn-xs"><i class="fa fa-trash" aria-hidden="true"></i>
                                        Delete
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
    if (confirm('Apakah anda yakin akan menghapus Data Obyek Wisata ? \"' + document.getElementById(dt)
            .innerHTML + '\" ?')) {
        $("#delete-form").attr('action', $(el).attr('href'));
        $("#delete-form").submit();
    }
}
</script>
@endpush