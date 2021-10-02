@extends('admin.layouts.app-manager')

@section('title', 'Admin - Halaman Siswa Unit')

@section('content')

@if (session('status'))
@push('scripts')
<script>
    swal({
        title: "Berhasil",
        text: "{{ session('status') }}",
        icon: "success",
        button: false,
        timer: 3000
    });

</script>
@endpush
@endif

<div class="row">
    <div class="col-12 mb-4">

        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center py-4">
            <div class="d-block mb-4 mb-md-0">
                <nav aria-label="breadcrumb" class="d-none d-md-inline-block">
                    <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
                        <li class="breadcrumb-item"><a href="#"><span class="fas fa-home"></span></a></li>
                        <li class="breadcrumb-item"><a href="{{ route('siswa.unit') }}">Kursus</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Halaman Siswa Unit</li>
                    </ol>
                </nav>
                <h2 class="h4">Table Siswa Unit</h2>
            </div>

        </div>
        <div class="card border-light shadow-sm components-section">
            <div class="row">
                <div class="card-body">
                    <table class="table table-hover" id="siswaTable">
                        <thead>
                            <tr>
                                <th>Nama Siswa</th>
                                <th>Kursus</th>
                                <th>Foto</th>
                                <th>Status</th>
                                <th>File</th>
                                <th>Sertifikat</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($siswa as $item)
                            <tr>
                                <td>{{ $item->siswa->nama_siswa }}</td>
                                <td>
                                    {{ $item->kursus_unit->kursus->nama_kursus }} 
                                    <br>
                                    <span class="blockquote-footer">{{ $item->kursus_unit->type->nama_type }}</footer>
                                </td>
                                <td><img src="{{ url('storage/siswa/'. $item->siswa->foto) }}" height="70px"
                                        width="100px"></td>
                                <td>
                                    @php
                                    $sertif = $item->status_sertifikat
                                    @endphp
                                    @if ($sertif == 'daftar')
                                    <button class="btn btn-primary btn-sm">Daftar</button>
                                    @elseif($sertif == 'terima')
                                    <button class="btn btn-info btn-sm">Siswa</button>
                                    @elseif($sertif == 'lulus')
                                    <button class="btn btn-success btn-sm">Lulus</button>
                                    @else
                                    <button class="btn btn-gray btn-sm">Tuntas</button>
                                    @endif
                                </td>
                                <td>
                                    @isset($item->file)
                                    <button class="btn btn-primary btn-sm" data-toggle="modal"
                                        data-target="#modal-file"> <i class="fas fa-eye"></i> Detail
                                    </button>
                                    <!-- Modal Content -->
                                    <div class="modal fade" id="modal-file" tabindex="-1" role="dialog" aria-labelledby="modal-file"
                                    aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h2 class="h6 modal-title">Detail Bukti Upload </h2>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <img src="{{ asset('storage/pembayaran/'.$item->file) }}" width="600" height="450">
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-link text-danger ml-auto"
                                                        data-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @else
                                    N/A
                                    @endisset
                                </td>
                                <td>
                                    @if ($item->status_sertifikat == 'sertifikat')
                                    <a href="{{ route('sertifikat.download', $item->sertifikat) }}" class="btn btn-primary btn-sm "> <i class="fas fa-print"></i> Cetak
                                    </a>
                                    @else
                                    <button class="btn btn-danger btn-sm "> <i class="fas fa-times"></i>
                                        Belum tersedia
                                    </button>
                                    @endif
                                </td>
                                <td>
                                    @if ($item->status_sertifikat == 'sertifikat')
                                        <a class="btn btn-warning btn-sm" href="{{ route('siswa.unit.confirm_down', $item->id) }}"> <i class="fas fa-check"></i> Hapus Sertifikat </a>
                                    @else
                                        <a class="btn btn-primary btn-sm" href="{{ route('siswa.unit.confirm', $item->id) }}"> <i class="fas fa-check"></i> Setujui </a>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <footer class="footer section py-2">

                </div>

            </div>
        </div>

    </div>
</div>

@endsection
@push('scripts')
<script>
    // AJAX DataTable
    var datatable = $('#kursusTable').DataTable({
        processing: true,
        serverSide: true,
        ordering: true,
        ajax: {
            url: '{!! url()->current() !!}',
        },
        columns: [{
                "data": 'id',
                "sortable": false,
                render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            {
                data: 'nama_kursus',
                name: 'nama_kursus'
            },
            {
                data: 'kategori',
                name: 'kategori.nama_kategori'
            },
            {
                data: 'gambar_kursus',
                name: 'gambar_kursus'
            },
            {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false,
                width: '20%'
            },
        ],

    });

</script>
@endpush
