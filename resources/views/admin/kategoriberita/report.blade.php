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
                <th>Id Kategori Berita</th>
                <th>Kategori Berita</th>

            </tr>
        </thead>
        <tbody>
            @php $i=1 @endphp
            @foreach($ktberita as $key => $kb)

            <tr>
                <td>{{ $i++ }}</td>
                <td>{{$key+1}}</td>
                <td>{{$kb->id}}</td>
                <td>{{$kb->kategori_berita}}</td>

            </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>