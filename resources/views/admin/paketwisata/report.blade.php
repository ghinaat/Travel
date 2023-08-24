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
                <th>Id Berita</th>
                <th>Judul</th>
                <th>Berita</th>
                <th>Tanggal Upload</th>
                <th>Kategori Berita</th>
                <th>Foto</th>

            </tr>
        </thead>
        <tbody>
            @php $i=1 @endphp
            @foreach($berita as $key => $br)
            <tr>
                <td>{{ $i++ }}</td>
                <td>{{$br->id}}</td>
                <td>{{$br->judul}}</td>
                <td>{{$br->berita}}</td>
                <td>{{$br->tgl_post}} </td>
                <td>{{$br->fberita->kategori_berita}}</td>
                <td>
                    <img src="{{ asset('/storage/berita/1685274080.png') }}"
                        alt="{{'/storage/berita/'.$br->foto}} tidak tampil" width="100" height="100">
                </td>

            </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>