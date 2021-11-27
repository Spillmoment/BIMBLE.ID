@extends('admin.layouts.app-manager')

@section('title', 'Admin - Detail Halaman Siswa')

@section('content')

<div class="row">
    <div class="col-12 mb-4">

        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-4 pb-3">
            <div class="d-block mb-4 mb-md-0">
                <nav aria-label="breadcrumb" class="d-none d-md-inline-block">
                    <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
                        <li class="breadcrumb-item"><a href="#">
                                <span class="fas fa-home"></span></a></li>
                        <li class="breadcrumb-item"><a href="{{ route('siswa.unit') }}">Kursus</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('siswa-konfirmasi.index') }}">Halaman Detail
                                Siswa</a></li>
                    </ol>
                </nav>
            </div>

        </div>

    </div>
    <div class="row justify-content-md-center">
        <div class="col-10 col-lg-8">
            <div class="card border-0 shadow">
                <div class="card-header border-bottom d-flex align-items-center justify-content-between">
                    <h5 class="fs-5 fw-bold mb-0">Detail Siswa {{  $data->siswa->nama_siswa  }}</h5>
                    <span class="font-weight-bold">{{ $data->created_at->format('d M Y') }}</span>
                </div>
                <div class="card-body">
                    <div class="row mt-2 mb-1 align-items-center">
                        <div class="col-sm-3">Nama</div>
                        <div class="col-sm-9 fs-6 text-primary">{{ $data->siswa->nama_siswa }}</div>
                    </div>
                    <div class="row mt-2 mb-1 align-items-center">
                        <div class="col-sm-3">Jenis Kelamin</div>
                        <div class="col-sm-9 fs-6 text-primary">
                            {{ $data->siswa->jenis_kelamin == 'L' ? 'Laki-Laki' : 'Perempuan' }}</div>
                    </div>
                    <div class="row mt-2 mb-1 align-items-center">
                        <div class="col-sm-3">Alamat</div>
                        <div class="col-sm-9 fs-6 text-primary">
                            {{ substr($data->siswa->alamat_province, strpos($data->siswa->alamat_province, ".") + 1) }}
                            -
                            {{ substr($data->siswa->alamat_district, strpos($data->siswa->alamat_district, ".") + 1) }}
                            -
                            {{ substr($data->siswa->alamat_sub_district, strpos($data->siswa->alamat_sub_district, ".") + 1) }}
                            -
                            {{ substr($data->siswa->alamat_village, strpos($data->siswa->alamat_village, ".") + 1) }}
                        </div>
                    </div>
                    <div class="row mt-2 mb-1 align-items-center">
                        <div class="col-sm-3">Email</div>
                        <div class="col-sm-9 fs-6 text-primary">{{ $data->siswa->email }}</div>
                    </div>
                    <div class="row mt-2 mb-1 align-items-center">
                        <div class="col-sm-3">No. Telepon</div>
                        <div class="col-sm-9 fs-6 text-primary">{{ $data->siswa->no_telp }}</div>
                    </div>

                    <div class="d-flex align-items-center justify-content-between border-bottom py-1">
                    </div>

                    <div class="row mt-2 mb-1 align-items-center">
                        <div class="col-sm-3">Unit Pengelola</div>
                        <div class="col-sm-9 fs-6 text-primary">{{ $data->kursus_unit->unit->nama_unit }}</div>
                    </div>
                    <div class="row mt-2 mb-1 align-items-center">
                        <div class="col-sm-3">Kursus</div>
                        <div class="col-sm-9 fs-6 text-primary">{{ $data->kursus_unit->kursus->nama_kursus }}</div>
                    </div>
                    <div class="row mt-2 mb-1 align-items-center">
                        <div class="col-sm-3">Type</div>
                        <div class="col-sm-9 fs-6 text-primary">{{ $data->kursus_unit->type->nama_type }}</div>
                    </div>
                    <div class="row mt-2 mb-1 align-items-center">
                        <div class="col-sm-3">Biaya</div>
                        <div class="col-sm-9 fs-6 text-primary">@currency($data->kursus_unit->biaya_kursus)</div>
                    </div>

                    <div class="d-flex align-items-center justify-content-between border-bottom py-1">
                    </div>

                    <div class="row mt-2 mb-1 align-items-center">
                        <div class="col-sm-3">Nilai</div>
                        <div class="col-sm-9 fs-6 text-primary">
                            {{ $data->nilai != null ? $data->nilai  : '---' }}</div>
                    </div>

                    <div class="row mt-2 mb-1 align-items-center">
                        <div class="col-sm-3">Predikat</div>
                        <div class="col-sm-9 fs-6 text-primary">
                            {{ $data->predikat != null ? $data->nilai  : '---' }}
                        </div>
                    </div>

                    <div class="row mt-2 mb-1 align-items-center">
                        <div class="col-sm-3">Sertifikat</div>
                        <div class="col-sm-9 fs-6 text-primary">
                            {{ $data->sertifikat != null ? $data->sertifikat : '---' }}
                        </div>
                    </div>

                    <div class="row mt-2 mb-1 align-items-center">
                        <div class="col-sm-3">Status</div>
                        <div class="col-sm-9 fs-6 text-primary">
                            @switch ($data->status_sertifikat)
                            @case('daftar')
                            <button class="btn btn-primary btn-sm">Daftar</button>
                            @break
                            @case('terima')
                            <button class="btn btn-info btn-sm">Siswa</button>
                            @break
                            @case('lulus')
                            <button class="btn btn-success btn-sm">Lulus</button>
                            @break
                            @default
                            <button class="btn btn-gray btn-sm">Tuntas</button>
                            @break
                            @endswitch
                        </div>
                    </div>

                    <br>
                    @if ($data->sertifikat == null)
                    <form action="{{ route('siswa.unit.confirm', $data->id) }}" method="post">
                        @csrf
                        @method('HEAD')
                        <button class="btn w-100 btn-success mt-2 confirm" data-name="{{ $data->siswa->nama_siswa }}"
                            data-file="{{ $data->file }}" type="submit">Konfirmasi Sertifikat</button>
                    </form>
                    @else
                    <form action="{{ route('siswa.unit.confirm_down', $data->id) }}" method="post">
                        @csrf
                        @method('HEAD')
                        <button class="btn w-100 btn-danger mt-2 confirm-down"
                            data-name="{{ $data->siswa->nama_siswa }}" data-file="{{ $data->file }}"
                            type="submit">Batalkan Sertifikat</button>
                    </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    $('.confirm').on('click', function (event) {
        var name = $(this).data('name');
        event.preventDefault();
        swal({
            title: 'Apakah Anda Yakin?',
            text: "Mengkonfirmasi Sertifikat Siswa " + name,
            icon: 'warning',
            buttons: ["Cancel", "Yes!"],
        }).then((willConfirm) => {
            if (willConfirm) {
                $(this).closest("form").submit();
            }
        });
    });

    $('.confirm-down').on('click', function (event) {
        var name = $(this).data('name');
        event.preventDefault();
        swal({
            title: 'Apakah Anda Yakin?',
            text: "Membatalakn Sertifikat Siswa " + name,
            icon: 'warning',
            buttons: ["Cancel", "Yes!"],
        }).then((willConfirm) => {
            if (willConfirm) {
                $(this).closest("form").submit();
            }
        });
    });

</script>

@endpush
