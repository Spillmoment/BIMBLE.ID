<table class="table table-hover table-striped table-responsive" id="simpananTable">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Kursus</th>
            <th>Kategori</th>
            <th>Deskripsi</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($kursus as $item)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $item->nama_kursus }}</td>
            <td>{{ $item->kategori->nama_kategori }}</td>
            <td>
                @php
                $convert = html_entity_decode($item->tentang);
                $deskripsi = strip_tags($convert);
                @endphp
                {{ $deskripsi }}

            </td>
            <td>{{ $item->status }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
