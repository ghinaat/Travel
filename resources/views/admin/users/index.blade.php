@extends('adminlte::page')
@section('title', 'List User')
@section('content_header')
<h1 class="m-0 text-dark">List User</h1>
@stop
@section('content')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <a href="{{route('users.create')}}" class="btn btn-primary mb-2">
                       Tambah
                    </a>
                    <table class="table table-hover table-bordered
table-stripped" id="example2">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Email</th>
                                <th>Level</th>
                                <th>Aktif</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $key => $user)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td id={{$key+1}}>{{$user->email}}</td>
                                <td id={{$key+1}}>{{$user->level}}</td>
                                <td id={{$key+1}}>{{$user->aktif}}</td>
                                <td>
                                    <a href="{{route('users.edit',
$user)}}" class="btn btn-primary btn-xs"><i class="fas fa-pen" aria-hidden="true"></i>
                                    </a>
                                    <a href="{{route('users.destroy', $user)}}"
                                        onclick="notificationBeforeDelete(event, this, <?php echo $key+1; ?>)"
                                        class="btn btn-danger btn-xs"><i class="fa fa-trash" aria-hidden="true"></i>
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
    if (confirm('Apakah anda yakin akan menghapus Data Pelanggan ? \"' + document.getElementById(dt)
            .innerHTML + '\" ?')) {
        $("#delete-form").attr('action', $(el).attr('href'));
        $("#delete-form").submit();
    }
}
</script>
@endpush