@extends('adminlte::page')
@section('title', 'Laporan Reservasi')
@section('content_header')

<head>
    <title>Laporan</title>
    <style>
    /* Gaya CSS untuk laporan */
    body {
        font-family: Arial, sans-serif;
    }

    h1 {

        margin-bottom: 20px;
    }

    table,
    td,
    th {
        border: 1px solid;
        padding: 8px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    tr:nth-child(even) {
        background-color: #f2f2f2;
    }
    </style>
</head>

<h1 class="m-0 text-dark">Laporan Reservasi</h1>
@stop
@section('content')


<body>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <form action="{{  url('download-report') }}" method="get">
                            <div class="form-group">
                                <label for="tgl_reservasi_wisata">Tanggal:</label>
                                <input type="date" name="tgl_reservasi_wisata" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="id_pelanggan">Pelanggan :</label>
                                <div class="input-group">
                                    <input type="hidden" name="id_pelanggan" id="id_pelanggan"
                                        value="{{old('id_pelanggan')}}">
                                    <input type="text" class="form-control
@error('pelanggan') is-invalid @enderror" placeholder="pelanggan" id="pelanggan" name="pelanggan"
                                        value="{{old('pelanggan')}}" aria-label="pelanggan" aria-describedby="cari"
                                        readonly>
                                    <button class="btn btn-warning" type="button" data-bs-toggle="modal" id="cari"
                                        data-bs-target="#staticBackdrop"></i>
                                        Cari Data Pelanggan</button>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-danger" target="_blank"><i class="fa fa-file-pdf"
                                    aria-hidden="true"></i>&nbsp;Generate PDF</button>

                            <!-- <a href="{{ url('download-report') }}" target="_blank">Generate PDF</a> -->
                        </form>

                        <!-- Modal -->
                        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false"
                            tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-scrollable p-5">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Pencarian Data Pelanggan
                                        </h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <table class="table table-hover table-bordered tablestripped" id="example2">
                                            <thead>
                                                <tr>
                                                    <th>No.</th>
                                                    <th>Nama Lengkap</th>
                                                    <th>No Telepon</th>
                                                    <th>User</th>
                                                    <th>Opsi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($pelanggan as $key => $pl)
                                                <tr>
                                                    <td>{{$key+1}}</td>
                                                    <td>{{$pl->nama_lengkap}}</td>
                                                    <td>{{$pl->no_hp}}</td>
                                                    <td>{{$pl->fuser->email}}</td>
                                                    <td>
                                                        <button type="button" class="btn btn-primary
btn-xs" onclick="pilih('{{$pl->id}}','{{$pl->fuser->email}}', '{{$pl->nama_lengkap}}', '{{$pl->no_hp}}',  )"
                                                            data-bs-dismiss="modal">
                                                            Pilih
                                                        </button>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

</body>
@stop
@push('js')

<script>
$('#example2').DataTable({
    "responsive": true,
});


function pilih(id, pl) {
    document.getElementById('id_pelanggan').value = id
    document.getElementById('pelanggan').value = pl
}
</script>
@endpush