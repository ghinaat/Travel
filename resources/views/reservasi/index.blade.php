@extends('adminlte::page')
@section('title', 'List Reservasi')
@section('content_header')
<h1 class="m-0 text-dark">List Reservasi</h1>
@stop
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">

                    <a href="{{route('reservasi.create')}}" class="btn
                    btn-primary mb-2"><i class="fa fa-plus"></i>
                        Tambah
                    </a>
                    <table class="table table-hover table-bordered
                        table-stripped" id="example2">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Id Reservasi</th>
                                <th>Id Pelanggan</th>
                                <th>Id Paket</th>
                                <th>Tanggal Reservasi</th>
                                <th>Harga</th>
                                <th>Jumlah Peserta</th>
                                <th>Diskon</th>
                                <th>Nilai Diskon</th>
                                <th>Total</th>
                                <th>Bukti Transfer</th>
                                <th>Status Reservasi</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($reservasi as $key => $rv)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$rv->id}}</td>
                                <td id={{$key+1}}>{{$rv->fpelanggan->nama_lengkap}}</td>
                                <td id={{$key+1}}>{{$rv->fpaket->nama_paket}}</td>
                                <td id={{$key+1}}>{{$rv->tgl_reservasi_wisata}}</td>


                                <td id={{$key+1}}>{{ 'Rp ' . number_format($rv->harga, 0, ',', '.') }}</td>
                                <td id={{$key+1}}>{{$rv->jumlah_peserta}}</td>
                                <td id={{$key+1}}>{{ $rv->diskon ? $rv->diskon . '%' : '-' }}</td>
                                <td id={{$key+1}}>{{ 'Rp ' . number_format($rv->nilai_diskon, 0, ',', '.') }}</td>
                                <td id={{$key+1}}>{{ 'Rp ' . number_format($rv->total_bayar, 0, ',', '.') }}</td>
                                <td>
                                    <img src="{{'/storage/reservasi/'.$rv->file_bukti_tf}}"
                                        alt="{{$rv->file_bukti_tf}} tidak tampil" class="img-thumbnail">
                                </td>
                                <td id={{$key+1}}>{{$rv->status_reservasi_wisata}}</td>

                                <td>
                                    <a href="{{route('reservasi.edit', $rv)}}" class="btn btn-primary btn-xs">
                                        <i class="fas fa-pen" aria-hidden="true"></i> Edit
                                    </a>
                                    <a href="{{route('reservasi.destroy', $rv)}}"
                                        onclick="notificationBeforeDelete(event, this, <?php echo $key+1; ?>)"
                                        class="btn btn-danger btn-xs">
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
    if (confirm('Apakah anda yakin akan menghapus Data Reservasi ? \"' + document.getElementById(dt)
            .innerHTML + '\" ?')) {
        $("#delete-form").attr('action', $(el).attr('href'));
        $("#delete-form").submit();
    }
}
</script>
@endpush