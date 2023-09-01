@extends('adminlte::page')
@section('title', 'List Berita')
@section('content_header')
<h1 class="m-0 text-dark">List Berita</h1>
@stop
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">

                    <a href="{{route('berita.create')}}" class="btn
                    btn-primary mb-2">
                        Tambah
                    </a>
                    <table class="table table-hover table-bordered
                        table-stripped" id="example2">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Judul</th>
                                <th>Berita</th>
                                <th>Tanggal Upload</th>
                                <th>Kategori Berita</th>
                                <th>Foto</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($berita as $key => $br)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td id={{$key+1}}>{{$br->judul}}</td>
                                <td id={{$key+1}}>{{$br->berita}}</td>
                                <td id={{$key+1}}>{{$br->tgl_post}} </td>
                                <td id={{$key+1}}>{{$br->fberita->kategori_berita}}</td>
                                <td>
                                    <img src="{{'/storage/berita/'.$br->foto}}" alt="storage/{{$br->foto}} tidak tampil"
                                        class="img-thumbnail" width="100" height="100">
                                </td>

                                <td>
                                    <a href="{{route('berita.edit', $br)}}" class="btn btn-primary btn-xs">
                                        <i class="fas fa-pen" aria-hidden="true"></i> 
                                    </a>
                                    <a href="{{route('berita.destroy', $br)}}"
                                        onclick="notificationBeforeDelete(event, this, <?php echo $key+1; ?>)"
                                        class="btn btn-danger btn-xs">
                                        <i class="fa fa-trash" aria-hidden="true"></i> 
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
    if (confirm('Apakah anda yakin akan menghapus Data Berita ? \"' + document.getElementById(dt)
            .innerHTML + '\" ?')) {
        $("#delete-form").attr('action', $(el).attr('href'));
        $("#delete-form").submit();
    }
}
</script>
@endpush