<!DOCTYPE html>
<html>

<head>
    <title>Laporan</title>
    <style>
    /* Gaya CSS untuk laporan */
    body {
        font-family: Arial, sans-serif;
    }

    h1 {
        text-align: center;
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

<body>
    <h1>Laporan</h1>

    <table id="example1" class="table table-bordered table-striped">

        <thead>
            <tr>
                <th>No.</th>

                <th>Id Pelanggan</th>
                <th>Id Paket</th>
                <th>Tanggal Reservasi</th>
                <th>Harga</th>
                <th>Jumlah Peserta</th>
                <th>Diskon</th>
                <th>Nilai Diskon</th>
                <th>Status Reservasi</th>
                <th>Total Bayar</th>




            </tr>
        </thead>
        <tbody>
            @php $i=1 @endphp
            @foreach($reservasi as $key => $rv)
            <tr>
                <td>{{$key+1}}</td>

                <td id={{$key+1}}>{{$rv->fpelanggan->nama_lengkap}}</td>
                <td id={{$key+1}}>{{$rv->fpaket->nama_paket}}</td>
                <td id={{$key+1}}>{{$rv->tgl_reservasi_wisata}}</td>


                <td id={{$key+1}}>{{ 'Rp ' . number_format($rv->harga, 0, ',', '.') }}</td>
                <td id={{$key+1}}>{{$rv->jumlah_peserta}}</td>
                <td id={{$key+1}}>{{ $rv->diskon ? $rv->diskon . '%' : '-' }}</td>
                <td id={{$key+1}}>{{ 'Rp ' . number_format($rv->nilai_diskon, 0, ',', '.') }}</td>
                <td id={{$key+1}}>{{$rv->status_reservasi_wisata}}</td>
                <td id={{$key+1}}>{{ 'Rp ' . number_format($rv->total_bayar, 0, ',', '.') }}</td>

                <!-- tambahkan kolom lainnya sesuai kebutuhan -->
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="9"><b>Total Reservasi<b></td>
                <td>Rp {{ number_format($reservasi->sum('total_bayar'), 0, ',', '.') }}</td>

            </tr>
        </tfoot>
    </table>

</body>

</html>