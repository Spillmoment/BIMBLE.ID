<table class="table">
    <thead>
        <tr>
            <th>Nama Siswa</th>
            <th>Kursus</th>
            <th>Unit</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($siswa as $item)
        <tr>
            <td scope="row">{{ $item->siswa->nama_siswa }}</td>
            <td>{{ $item->kursus_unit->kursus->nama_kursus }}</td>
            <td>{{ $item->kursus_unit->unit->nama_unit }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
