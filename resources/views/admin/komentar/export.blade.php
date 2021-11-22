<table class="table table-hover table-striped table-responsive" id="simpananTable">
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
