@extends('adminlte::page')
@section('title', 'List Karyawan')
@section('content_header')
<h1 class="m-0 text-dark">List Karyawan</h1>
@stop
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class=table-responsive>

                    <a href="{{route('TKaryawan.create')}}" class="btn
btn-primary mb-2"><i class="fa fa-plus"></i>
                        Tambah
                    </a>
                    <table class="table table-hover table-bordered
table-stripped" id="example2">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Id Karyawan</th>
                                <th>Nama Karyawan</th>
                                <th>Alamat</th>
                                <th>Nomer Telepon</th>
                                <th>Jabatan</th>
                                <th>User Karyawan</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($Tkaryawan as $key => $kr)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td id={{$key+1}}>{{$kr->id}}</td>
                                <td id={{$key+1}}>{{$kr->nama_karyawan}}</td>
                                <td id={{$key+1}}>{{$kr->alamat}}</td>
                                <td id={{$key+1}}>{{$kr->no_hp}}</td>
                                <td id={{$key+1}}>{{$kr->jabatan}}</td>
                                <td id={{$key+1}}>{{$kr->fuser->email}}</td>
                                <td>
                                    <a href="{{route('TKaryawan.edit',
$kr)}}" class="btn btn-primary btn-xs"><i class="fas fa-pen" aria-hidden="true"></i>
                                        Edit
                                    </a>
                                    <a href="{{route('TKaryawan.destroy',
$kr)}}" onclick="notificationBeforeDelete(event, this, <?php echo $key+1; ?>)" class="btn btn-danger btn-xs">
                                        <i class="fa fa-trash" aria-hidden="true"></i>Delete
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
    if (confirm('Apakah anda yakin akan menghapus Data Karyawan ? \"' + document.getElementById(dt)
            .innerHTML + '\" ?')) {
        $("#delete-form").attr('action', $(el).attr('href'));
        $("#delete-form").submit();
    }
}
</script>
@endpush