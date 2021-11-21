<table class="table table-hover table-striped table-responsive" id="simpananTable">
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
