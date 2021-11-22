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
    <h5>Laporan Unit Format PDF</h4>
    </h5>
</center>


<body>
    <table class="table table-hover table-bordered table-striped">
        <thead>

            <tr>
                <th>No</th>
                <th>Nama Unit</th>
                <th>Deskripsi</th>
                <th>Alamat</th>
                <th>Email</th>
                <th>No Telepon</th>
                <th>Whats App</th>
                <th>Telegram</th>
                <th>Instagram</th>
                <th>Status</th>
            </tr>

        </thead>
        <tbody>
            @foreach ($unit as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->nama_unit }}</td>
                <td>
                    @php
                    $convert = html_entity_decode( $item->deskripsi );
                    $deskripsi = strip_tags($convert);
                    @endphp
                    {{ $deskripsi }}
                </td>
                <td>{{ $item->alamat }}</td>
                <td>{{ $item->email }}</td>
                <td>{{ $item->no_telp }}</td>
                <td>{{ $item->whatsapp }}</td>
                <td>{{ $item->telegram }}</td>
                <td>{{ $item->instagram }}</td>
                <td>{{ $item->status == '1' ? 'aktif' : 'nonaktif' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>
