@extends('admin.layouts.tutor')
@section('title','Bimble - Nilai Kursus')

@section('content')

<div class="breadcrumbs">
    <div class="breadcrumbs-inner">
        <div class="row m-0">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Data Nilai Kursus </h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="{{ route('nilai.index') }}">Data Nilai Kursus</a></li>
                            <li class="active">List Nilai Kursus </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="content">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-shadow">
                    <div class="card-body">

                        @if ($message = Session::get('success'))
                        @push('after-script')
                        <script>
                            swal({
                                title: "Success",
                                text: $message,
                                icon: "success",
                                button: false,
                                timer: 2000
                            });
                        </script>
                    @endpush
                       @endif

                        <div class="card-header bg-primary text-light">
                            <div class="card-title">
                                List Nilai Kursus
                                <span style="font-size: 15px"
                                    class="badge badge-danger badge-lg badge-pill">{{ $kursus->nama_kursus }}</span>
                            </div>
                        </div>

                        <ul class="nav nav-pills my-3" id="pills-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home"
                                    role="tab" aria-controls="pills-home" aria-selected="true">Siswa</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile"
                                    role="tab" aria-controls="pills-profile" aria-selected="false">Pendaftar</a>
                            </li>
                        </ul>

                        <div class="tab-content" id="pills-tabContent">
                            {{-- Siswa --}}
                            <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                                aria-labelledby="pills-home-tab">
                                <div class="card-header my-3">
                                    <strong class="card-title">Table Nilai Siswa</strong>
                                </div>
                                <table id="bootstrap-data-table" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Nama</th>
                                            <th scope="col">Alamat</th>
                                            <th scope="col">Nilai</th>
                                            <th scope="col">Keterangan</th>
                                            <th scope="col">Opsi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($siswa as $siswa)
                                        <tr>
                                            <th scope="row">{{ $loop->iteration }}</th>
                                            <td>{{ $siswa->nama_siswa }}</td>
                                            <td>{{ $siswa->alamat }}</td>
                                            <td>
                                             @if ($siswa->nilai != null)
                                             {{ $siswa->nilai }}
                                             @else
                                             belum ada
                                             @endif
                                            </td>
                                            <td>
                                                @if ($siswa->keterangan != null)
                                                {{ $siswa->keterangan }}
                                                @else
                                                belum ada
                                                @endif
                                            </td>
                                            <td>
                                                <a href="#modal-edit" data-remote="{{ route('siswa.nilai',$siswa->id ) }}"
                                                    data-toggle="modal" data-target="#modal-edit"
                                                    data-title="Detail Nilai {{ $siswa->nama_siswa }}"
                                                    class="btn btn-warning btn-sm ml-3 mb-3">
                                                    <i class="fa fa-pencil"></i> </a>
                                            </td>
                                        </tr>

                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            {{-- Pendaftar --}}
                            <div class="tab-pane fade" id="pills-profile" role="tabpanel"
                                aria-labelledby="pills-profile-tab">
                                <div class="card-header my-3">
                                    <strong class="card-title">Table Nilai Pendaftar</strong>
                                </div>
                                <table id="bootstrap-data-table2" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Nama</th>
                                            <th scope="col">Alamat</th>
                                            <th scope="col">Nilai</th>
                                            <th scope="col">Keterangan</th>
                                            <th scope="col">Option</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($order_detail as $order_detail)
                                        <tr>
                                            <td> {{ $loop->iteration }} </td>
                                            @foreach ($order_detail->pendaftar as $pendaftar)
                                            <td>{{ $pendaftar->nama_pendaftar }}</td>
                                            <td>{{ $pendaftar->alamat }}</td>

                                            @if(isset($pendaftar->nilai->nilai))
                                            <td>{{ $pendaftar->nilai->nilai }}</td>
                                            <td>{{ $pendaftar->nilai->keterangan }}</td>
                                            <td>
                                                <a href="#modal-edit" data-remote="{{ route('nilai.edit',$pendaftar->nilai->id ) }}"
                                                    data-toggle="modal" data-target="#modal-edit"
                                                    data-title="Detail Nilai {{ $pendaftar->nama_pendaftar }}"
                                                    class="btn btn-warning btn-sm ml-3 mb-3">
                                                    <i class="fa fa-pencil"></i> </a>
                                            </td>
                                            @else
                                            <form action="{{ route('nilai.store') }}" method="post">
                                                @csrf
                                                <input type="hidden" name="idPendaftar" value="{{ $pendaftar->id }}">
                                                <input type="hidden" name="idKursus"
                                                    value="{{ $order_detail->id_kursus }}">
                                                <td>
                                                    <input type="text" name="nilai" id="nilai"
                                                        class="text-center col-sm-4 form-control {{ $errors->first('nilai') ? 'is-invalid' : '' }}"
                                                        placeholder="-" required>
                                                    <div class="invalid-feedback">
                                                        {{$errors->first('nilai')}}
                                                    </div>
                                                </td>
                                                <td>
                                                    <input type="text" name="keterangan" id="keterangan"
                                                        class="text-center col-sm-4 form-control {{ $errors->first('keterangan') ? 'is-invalid' : '' }}"
                                                        placeholder="-" required>
                                                    <div class="invalid-feedback">
                                                        {{$errors->first('keterangan')}}
                                                    </div>
                                                </td>
                                                <td>
                                                    <button type="submit" id="btn_nilai_pendaftar"
                                                        class="btn btn-primary btn-sm ml-3 mb-3"> <i class="fa fa-plus"
                                                            aria-hidden="true"></i> </button>
                                                </td>
                                            </form>
                                            @endif

                                        </tr>

                                        @endforeach
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div><!-- .animated -->
</div>

@endsection


@push('after-script')
<script>
    
    $('#bootstrap-data-table2').DataTable();

    $('button#deleteButton').on('click', function (e) {
        var name = $(this).data('name');
        e.preventDefault();
        swal({
                title: "Yakin!",
                text: "menghapus nilai  " + name + "?",
                icon: "warning",
                dangerMode: true,
                buttons: {
                    cancel: "Cancel",
                    confirm: "OK",
                },
            })
            .then((willDelete) => {
                if (willDelete) {
                    $(this).closest("form").submit();
                }
            });
    });

</script>
@endpush
