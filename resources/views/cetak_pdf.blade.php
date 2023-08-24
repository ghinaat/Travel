<!DOCTYPE html>
<html>

<head>
    <title>Membuat Laporan PDF Dengan DOMPDF Laravel</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <style type="text/css">
    table tr td,
    table tr th {
        font-size: 9pt;
    }
    </style>


    <table class="table table-hover table-bordered
                        table-stripped" id="example2">
        <thead>
            <tr>
                <th>No.</th>
                <th>Id Berita</th>
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
                <td>{{$br->id}}</td>
                <td id={{$key+1}}>{{$br->judul}}</td>
                <td id={{$key+1}}>{{$br->berita}}</td>
                <td id={{$key+1}}>{{$br->tgl_post}} </td>
                <td id={{$key+1}}>{{$br->fberita->kategori_berita}}</td>
                <td>
                    <img src="{{'/storage/berita/'.$br->foto}}" alt="storage/{{$br->foto}} tidak tampil"
                        class="img-thumbnail" width="100" height="100">
                </td>


            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>