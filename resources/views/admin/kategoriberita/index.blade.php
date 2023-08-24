@extends('adminlte::page')
@section('title', 'List Kategori Berita')
@section('content_header')
<h1 class="m-0 text-dark">List Kategori Berita</h1>
@stop
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    @if(auth()->user()->level=='pemilik' )
                    <a href="{{ route('generate.report') }}">Generate PDF</a>
                    <a href="{{route('ktberita.create')}}" class="btn
btn-primary mb-2"> Tambah </a>
                    @else
                    <a href="{{route('ktberita.create')}}" class="btn
btn-primary mb-2"> <i class="fa fa-plus"></i>Tambah</a>
                    @endif


                    <table class="table table-hover table-bordered
table-stripped" id="example2">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Id Kategori Berita</th>
                                <th>Kategori Berita</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($ktberita as $key => $kb)
                            <tr>
                                <td id={{$key+1}}>{{$key+1}}</td>
                                <td id={{$key+1}}>{{$kb->id}}</td>
                                <td id={{$key+1}}>{{$kb->kategori_berita}}</td>
                                <td>
                                    <a href="{{route('ktberita.edit',
$kb)}}" class="btn btn-primary btn-xs"><i class="fas fa-pen" aria-hidden="true"></i>
                                        Edit
                                    </a>
                                    <a href="{{route('ktberita.destroy', $kb)}}"
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
    if (confirm('Apakah anda yakin akan menghapus data Kategori Berita \"' + document.getElementById(dt).innerHTML +
            '\" ?')) {
        $("#delete-form").attr('action', $(el).attr('href'));
        $("#delete-form").submit();
    }
}
</script>
@endpush