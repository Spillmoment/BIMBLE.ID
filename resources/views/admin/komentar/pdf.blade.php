<!doctype html>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <title>Data Komentar Kursus</title>
</head>

<style type="text/css">
    table tr td,
    table tr th {
        font-size: 9pt;
    }

</style>
<center>
    <h5>Laporan Data Komentar Kursus</h4>
    </h5>
</center>


<body>
    <table class="table table-hover table-bordered table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Siswa</th>
                <th>Email</th>
                <th>Kursus</th>
                <th>Unit</th>
                <th>Komentar</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($komentar as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->nama }}</td>
                <td>{{ $item->email }}</td>
                <td>
                    @foreach ($item->kursus_unit as $row)
                    {{ $row->kursus->nama_kursus }}
                    @endforeach
                </td>
                <td>
                    @foreach ($item->kursus_unit as $row)
                    {{ $row->unit->nama_unit }}
                    @endforeach
                </td>
                <td>{{ $item->komentar }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>
