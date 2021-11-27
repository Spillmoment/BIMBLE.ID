<!doctype html>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <title>Export Laporan Unit</title>
</head>

<style type="text/css">
    table tr td,
    table tr th {
        font-size: 9pt;
        width: 100%;
    }

</style>
<center>
    <h5>Laporan Kursus Kelompok Unit {{ $kursus_unit->unit->nama_unit }}</h4>
    </h5>
</center>


<body>
    <table class="table table-hover table-bordered table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Nama Kursus</th>
                <th>Type Kursus</th>
                <th>Kategori</th>
                <th>Biaya Kursus</th>
                <th>Status</th>
            </tr>

        </thead>
        <tbody>
            @foreach ($query as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->created_at != null ? $item->created_at->format('d F Y') : 'null' }}</td>
                <td>{{ $item->kursus->nama_kursus }}</td>
                <td>{{ Str::ucfirst($item->type->nama_type) }}</td>
                <td>{{ $item->kursus->kategori->nama_kategori }}</td>
                <td> @currency($item->biaya_kursus)</td>
                <td>{{ $item->status }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>
