@extends('admin.layouts.app-manager')

@section('title', 'Admin - Detail Pendaftar Unit')

@section('content')

<div class="row">
    <div class="col-12 mb-4">

        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-4 pb-3">
            <div class="d-block mb-4 mb-md-0">
                <nav aria-label="breadcrumb" class="d-none d-md-inline-block">
                    <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
                        <li class="breadcrumb-item"><a href="#"><span class="fas fa-home"></span></a></li>
                        <li class="breadcrumb-item"><a href="#">Unit</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Detail Pendaftar Unit</li>
                    </ol>
                </nav>
                <h2 class="h4 mt-1">Table Unit</h2>
            </div>

        </div>
        <div class="card border-light shadow-sm components-section mt-3">
            <div class="card-header">
                <h3 class="card-title">Detail Pendaftar Unit {{ $unit->nama_unit }}</h3>
            </div>
            <div class="row">
                <div class="card-body">
                    <table class="table table-striped mt-2">
                        <tr>
                            <th>Nama Unit </th>
                            <td>{{ $unit->nama_unit }}</td>
                        </tr>

                        <tr>
                            <th>No Telepon</th>
                            <td>{{ $unit->no_telp }}</td>
                        </tr>

                        <tr>
                            <th>Email</th>
                            <td>{{ $unit->email }}</td>
                        </tr>

                        <tr>
                            <th>File Alumni</th>
                            <td>
                                <a class="btn btn-primary btn-sm" target="_blank"
                                    href="/storage/file/{{ $unit->bukti_alumni }}">
                                    <i class="fas fa-eye"></i> Preview
                                </a>
                                <a class="btn btn-primary btn-sm" target="_blank"
                                    href="{{ route('download',$unit->bukti_alumni) }}">
                                    <i class="fas fa-download"></i> Download
                                </a>
                            </td>
                        </tr>

                        <tr>
                            <th>Action</th>
                            <td>
                                <form class=" d-inline"
                                    action="{{ route('pendaftar-unit.status', $unit->id) }}?status=1" method="POST">
                                    @csrf
                                    @method('HEAD')
                                    <button type="submit" id="aktifButton" data-name="{{ $unit->nama_unit }}"
                                        class="btn btn-success btn-sm">
                                        <i class="fa fa-check"></i>
                                        Konfirmasi
                                    </button>
                                </form>

                                <form class="d-inline" action="{{route('pendaftar-unit.destroy', [$unit->id])}}"
                                    method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" id="deleteButton" data-name="{{ $unit->nama_unit }}"
                                        class="btn btn-danger btn-sm">
                                        <i class="fa fa-trash"></i>
                                        Delete
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
    $('button#deleteButton').on('click', function (e) {
        var name = $(this).data('name');
        e.preventDefault();
        swal({
                title: "Yakin!",
                text: "Menghapus Pendaftar Unit  " + name + "?",
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

    $('button#aktifButton').on('click', function (e) {
        var name = $(this).data('name');
        e.preventDefault();
        swal({
                title: "Yakin!",
                text: "Menyetujui Unit " + name + "?",
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
