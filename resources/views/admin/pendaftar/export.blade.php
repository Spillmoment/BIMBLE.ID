<table class="table table-hover table-striped table-responsive" id="simpananTable">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Unit</th>
            <th>Email</th>
            <th>No Telepon</th>
            <th>Alamat</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($unit as $item)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $item->nama_unit }}</td>
            <td>{{ $item->email }}</td>
            <td>{{ $item->no_telp }}</td>
            <td>{{ $item->alamat }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
