@extends('unit.layouts.app')

@section('title', 'Unit - Halaman Cek Gaji')
@section('content')

{{-- @if(session('status'))
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
@endif --}}

<div class="row">
    <div class="col-12 mb-4">

        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-4 pb-3">
            <div class="d-block mb-4 mb-md-0">
                <nav aria-label="breadcrumb" class="d-none d-md-inline-block">
                    <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
                        <li class="breadcrumb-item"><a href="{{ route('unit.home') }}"><span class="fas fa-home"></span></a></li>
                        <li class="breadcrumb-item"><a href="{{ route('unit.salary') }}">Cek Salary</a></li>
                    </ol>
                </nav>
                <h2 class="h4 mt-1">History Gaji</h2>
            </div>

        </div>
        
        <div class="card border-light shadow-sm components-section mt-3">
            <div class="row my-1 mx-1">
                <div class="col-md-3">
                    <select data-column="0" id="status_form" class="form-select filter-select">
                        <option value="">Pilih Status</option> 
                        @foreach ($status as $item)
                            <option value="{{ $item->id }}">{{ $item->status }}</option>
                        @endforeach
                        {{-- <option value="active">Aktif</option>
                        <option value="inactive">Tidak Aktif</option> --}}
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="card-body">
                    <table class="table table-hover table-striped table-responsive" id="salaryTable" width="100%">
                        <thead class="font-weight-bold">
                            <tr>
                                <th>No.</th>
                                <th>Tanggal</th>
                                <th>Untuk Admin</th>
                                <th>Untuk Unit</th>
                                <th>Total Bersih</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
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
        var table = $('#salaryTable').DataTable({
            /*  dom: 'lBfrtip',
             buttons: [
                 'copy', 'excel', 'pdf', 'csv', 'print',
             ], */
            processing: true,
            serverSide: true,
            ordering: true,
            ajax: {
                url: "{{ route('unit.salary') }}",
            },
            columns: [{
                    "data": 'id',
                    "sortable": false,
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    data: 'created_at',
                    name: 'created_at'
                },
                {
                    data: 'rule_gaji_lppk',
                    name: 'rule_gaji.lppk'
                },
                {
                    data: 'rule_gaji_unit',
                    name: 'rule_gaji.unit'
                },
                {
                    data: 'nominal',
                    name: 'nominal'
                },
                {
                    data: 'status',
                    name: 'status',
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