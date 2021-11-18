@extends('admin.layouts.app-manager')

@section('title', 'Admin - Halaman Unit')

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
                        <li class="breadcrumb-item"><a href="#">Unit</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Halaman Unit</li>
                    </ol>
                </nav>
                <h2 class="h4">Table Unit</h2>
            </div>

            <div class="float-right mt-6">
                <br>
                <a href="{{ route('unit.create') }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-plus"></i> Tambah Unit
                </a>
            </div>

        </div>
        <div class="card border-light shadow-sm components-section">
            <div class="row my-1">
                <div class="col-md-3">
                    <select data-column="0" class="form-select filter-select">
                        <option selected>Pilih Status</option>
                        @foreach ($unit as $item)
                        <option value="{{ $item->id }}">{{ $item->status == '1' ? 'Aktif' : 'Nonaktif' }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <div class="btn-group float-right mr-2">
                        <a href="{{ route('unit.excel') }}" class="btn btn-sm btn-outline-success">Export Excel</a>
                        <a href="{{ route('unit.pdf') }}" class="btn btn-sm btn-outline-danger">Export PDF</a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="card-body">
                    <table class="table table-hover table-striped table-responsive" id="unitTable">
                        <thead class="font-weight-bold">
                            <tr>
                                <th>No</th>
                                <th>Nama Unit</th>
                                <th>Email</th>
                                <th>Alamat</th>
                                <th>Gambar Unit</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

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
    $(document).ready(function () {
        // AJAX DataTable
        var table = $('#unitTable').DataTable({
            /*  dom: 'lBfrtip',
             buttons: [
                 'copy', 'excel', 'pdf', 'csv', 'print',
             ], */
            processing: true,
            serverSide: true,
            ordering: true,
            ajax: {
                url: "{{ route('unit.index') }}",
            },
            columns: [{
                    "data": 'id',
                    "sortable": false,
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    data: 'nama_unit',
                    name: 'nama_unit'
                },
                {
                    data: 'email',
                    name: 'email'
                },
                {
                    data: 'alamat',
                    name: 'alamat'
                },
                {
                    data: 'gambar_unit',
                    name: 'gambar_unit'
                },
                {
                    data: 'status',
                    name: 'status'
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

        $('.filter-select').change(function () {
            table.columns($(this).data('column'))
                .search($(this).val())
                .draw();
        });

    })

</script>
@endpush
