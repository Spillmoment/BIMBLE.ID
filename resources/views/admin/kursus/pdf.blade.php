<!doctype html>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <title>Data Kursus</title>
</head>

<style type="text/css">
    table tr td,
    table tr th {
        font-size: 9pt;
    }

</style>
<center>
    <h5>Laporan Data Kursus</h4>
    </h5>
</center>


<body>
    <table class="table table-hover table-bordered table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Kursus</th>
                <th>Kategori</th>
                <th>Keterangan</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($kursus as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->nama_kursus }}</td>
                <td>{{ $item->kategori->nama_kategori }}</td>
                <td>{{ $item->keterangan }}</td>
                <td>{{ $item->status }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>
