<center>
    <h3> List Kursus Unit {{ $unit->unit->nama_unit }}</h3>
</center>
<table class="table table-hover table-striped table-responsive" id="simpananTable">
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
        @foreach ($kursus_unit as $item)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $item->created_at != null ? $item->created_at->format('d F Y') : 'null' }}</td>
            <td>{{ $item->kursus->nama_kursus }}</td>
            <td>{{ $item->type->nama_type }}</td>
            <td>{{ $item->kursus->kategori->nama_kategori }}</td>
            <td> Rp.{{ number_format($item->biaya_kursus) }}</td>
            <td>{{ $item->status }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
