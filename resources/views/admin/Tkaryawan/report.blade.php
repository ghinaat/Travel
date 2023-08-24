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
                <th>Id Karyawan</th>
                <th>Nama Karyawan</th>
                <th>Alamat</th>
                <th>Nomer Telepon</th>
                <th>Jabatan</th>
                <th>User Karyawan</th>

            </tr>
        </thead>
        <tbody>
            @php $i=1 @endphp
            @foreach($Tkaryawan as $key => $kr)
            <tr>
                <td>{{ $i++ }}</td>
                <td>{{$kr->id}}</td>
                <td>{{$kr->nama_karyawan}}</td>
                <td>{{$kr->alamat}}</td>
                <td>{{$kr->no_hp}}</td>
                <td>{{$kr->jabatan}}</td>
                <td>{{$kr->fuser->email}}</td>


            </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>