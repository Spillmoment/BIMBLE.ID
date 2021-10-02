@extends('unit.layouts.app')

@section('title', 'Unit - Detail Siswa Unit')

@section('content')


@if(session('status'))
@push('scripts')
<script>
    swal({
        title: "Success",
        text: "{{session('status')}}",
        icon: "success",
        button: false,
        timer: 2000
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
                        <li class="breadcrumb-item"><a href="#">Unit</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Detail Siswa Unit</li>
                    </ol>
                </nav>

            </div>

        </div>
        <div class="card border-light shadow-sm components-section">
            <div class="card-header">
                <h3 class="card-title">Detail Siswa {{ $siswa->siswa->nama_siswa }}</h3>
            </div>
            <div class="row">
                <div class="card-body">
                    <table class="table table-striped mt-2">
                        <tr>
                            <th>Nama Siswa </th>
                            <td>{{ $siswa->siswa->nama_siswa }}</td>
                        </tr>

                        <tr>
                            <th>Jenis Kelamin</th>
                            <td>{{ $siswa->siswa->nama_siswa }}</td>
                        </tr>

                        <tr>
                            <th>Agama</th>
                            <td>{{ $siswa->siswa->agama }}</td>
                        </tr>

                        <tr>
                            <th>Email</th>
                            <td>{{ $siswa->siswa->email }}</td>
                        </tr>

                        <tr>
                            <th>Foto</th>
                            <td>
                                <img src="/storage/siswa/{{ $siswa->siswa->foto }}" width="400" height="400">
                            </td>
                        </tr>

                        <tr>
                            <th>Alamat</th>
                            <td>{{ $siswa->siswa->alamat }}</td>
                        </tr>


                        <tr>
                            <th>Action</th>
                            <td>
                                <form class="d-inline" action="{{ route('unit.siswa.update', $siswa->id) }}"
                                    method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" id="aktifButton" data-name="{{ $siswa->siswa->nama_unit }}"
                                        class="btn btn-success btn-sm">
                                        <i class="fa fa-check"></i>
                                        Konfirmasi
                                    </button>
                                </form>

                            </td>
                        </tr>
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
    $('button#aktifButton').on('click', function (e) {
        var name = $(this).data('name');
        e.preventDefault();
        swal({
                title: "Yakin!",
                text: "Menyetujui siswa " + name + "?",
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
