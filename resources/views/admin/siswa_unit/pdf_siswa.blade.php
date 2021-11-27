<!doctype html>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <title>Export Laporan Unit {{ $kursus_unit->unit->nama_unit }}</title>
</head>

<style type="text/css">
    table tr td,
    table tr th {
        font-size: 9pt;
        width: 100%;
    }

</style>
<center>
    <h5>Laporan Siswa Kursus {{ Str::ucfirst($kursus_unit->type->nama_type) }}
        Unit {{ $kursus_unit->unit->nama_unit }}</h4>
    </h5>
</center>


<body>
    <br>
    <table class="table table-hover table-bordered table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Nama Siswa</th>
                <th>Kursus</th>
                <th>Type Kursus</th>
                <th>Kategori</th>
                <th>Biaya Kursus</th>
                <th>Status</th>
                <th>Nilai</th>
                <th>Predikat</th>
            </tr>

        </thead>
        <tbody>
            @foreach ($query as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->created_at != null ? $item->created_at->format('d F Y') : 'null' }}</td>
                <td>{{ $item->siswa->nama_siswa }}</td>
                <td>{{ $item->kursus_unit->kursus->nama_kursus }}</td>
                <td>{{ Str::ucfirst($item->kursus_unit->type->nama_type) }}</td>
                <td>{{ $item->kursus_unit->kursus->kategori->nama_kategori }}</td>
                <td> @currency($item->kursus_unit->biaya_kursus)</td>
                <td>{{ $item->status_sertifikat }}</td>
                <td>{{ $item->nilai != null ? $item->nilai : 'Nilai belum ada' }}</td>
                <td>{{ $item->predikat != null ? $item->predikat : 'Predikat belum ada'  }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>
