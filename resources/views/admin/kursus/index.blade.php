@extends('admin.layouts.app-manager')

@section('title', 'Admin - Halaman Kursus')

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

        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-4 pb-3">
            <div class="d-block mb-4 mb-md-0">
                <nav aria-label="breadcrumb" class="d-none d-md-inline-block">
                    <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
                        <li class="breadcrumb-item"><a href="#"><span class="fas fa-home"></span></a></li>
                        <li class="breadcrumb-item"><a href="#">Kursus</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Halaman Kursus</li>
                    </ol>
                </nav>
                <h2 class="h4 mt-1">Daftar Kursus</h2>
            </div>
        </div>

        <div class="d-flex flex-row-reverse bd-highlight">
            <div class="btn-group">
                <a href="{{ route('kursus.excel') }}" class="btn btn-sm btn-success mx-1">
                    <i class="fas fa-file-excel"></i> Export Excel</a>
                <a href="{{ route('kursus.pdf') }}" class="btn btn-sm btn-danger mx-1">
                    <i class="fas fa-file-pdf"></i> Export PDF</a>
                <a href="{{ route('kursus.create') }}" class="btn btn-primary btn-sm mx-1">
                    <i class="fas fa-plus"></i> Tambah Kursus
                </a>
            </div>
        </div>


        <div class="card border-light shadow-sm components-section mt-3">
            <div class="row my-1 mx-1">
                <div class="col-md-3">
                    <select id="filter-kategori" data-column="0" class="form-select filter">
                        <option selected>Pilih Kategori</option>
                        @foreach ($kategori as $item)
                        <option value="{{ $item->id }}">{{ $item->nama_kategori }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row">

                <div class="card-body">
                    <table class="table table-hover table-striped" id="kursusTable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Kursus</th>
                                <th>Kategori</th>
                                <th>Gambar Kursus</th>
                                <th width="210">Action</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                    <footer class="footer section py-2">

                </div>

            </div>
        </div>

        <div class="row justify-content-md-center">
            <div class="col-12 mb-4">
                <div class="card bg-yellow-alt shadow-sm">
                    <div class="card-header d-flex flex-row align-items-center flex-0">
                        <div class="d-block">
                            <div class="h5 font-weight-normal mb-2">Sales Value</div>
                            <h2 class="h3">$10,567</h2>
                            <div class="small mt-2"> 
                                <span class="font-weight-bold mr-2">Yesterday</span>                              
                                <span class="fas fa-angle-up text-success"></span>                                   
                                <span class="text-success font-weight-bold">10.57%</span>
                            </div>
                        </div>
                        <div class="d-flex ml-auto">
                            <a href="#" class="btn btn-secondary text-dark btn-sm mr-2">Month</a>
                            <a href="#" class="btn btn-primary btn-sm mr-3">Week</a>
                        </div>
                    </div>
                    <div class="card-body p-2">
                        <div class="ct-chart-sales-value ct-double-octave ct-series-g"></div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-xl-4 mb-4">
                <div class="card border-light shadow-sm">
                    <div class="card-body">
                        <div class="row d-block d-xl-flex align-items-center">
                            <div class="col-12 col-xl-5 text-xl-center mb-3 mb-xl-0 d-flex align-items-center justify-content-xl-center">
                                <div class="icon icon-shape icon-md icon-shape-blue rounded mr-4 mr-sm-0"><span class="fas fa-chart-line"></span></div>
                                <div class="d-sm-none">
                                    <h2 class="h5">Total Unit</h2>
                                    <h3 class="mb-1" id="label-count-unit1"></h3>
                                </div>
                            </div>
                            <div class="col-12 col-xl-7 px-xl-0">
                                <div class="d-none d-sm-block">
                                    <h2 class="h5">Total Unit</h2>
                                    <h3 class="mb-1" id="label-count-unit2"></h3>
                                </div>
                                <small><span id="unit-month-data"></span>, <span class="icon icon-small"><span class="fas fa-globe-europe"></span></span> Month</small> 
                                <div class="small mt-2" id="percent-unit-label">                               
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-xl-4 mb-4">
                <div class="card border-light shadow-sm">
                    <div class="card-body">
                        <div class="row d-block d-xl-flex align-items-center">
                            <div class="col-12 col-xl-5 text-xl-center mb-3 mb-xl-0 d-flex align-items-center justify-content-xl-center">
                                <div class="ct-chart-traffic-share ct-golden-section ct-series-a"></div>
                            </div>
                            <div class="col-12 col-xl-7 px-xl-0">
                                <h2 class="h5 mb-3">Traffic Share</h2>
                                <h6 class="font-weight-normal text-secondary" id="max-percent"></h6>
                                <h6 class="font-weight-normal text-blue" id="min-percent"></h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
</div>

@endsection
@push('scripts')
<script>
    let kategori = $('#filter-kategori').val()

    var datatable = $('#kursusTable').DataTable({
        processing: true,
        serverSide: true,
        ordering: true,
        ajax: {
            url: '{!! url()->current() !!}',
            data: function (d) {
                d.kategori = kategori
            }
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

    $('.filter').on('change', function () {
        kategori = $('#filter-kategori').val();
        datatable.ajax.reload();
    })

    $('button#deleteButton').on('click', function (e) {
        var name = $(this).data('name');
        e.preventDefault();
        swal({
                title: "Yakin!",
                text: "menghapus kursus  " + name + "?",
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

<script>
    const doc = document;
    doc.addEventListener("DOMContentLoaded", function(event) {
        //Chartist
    
        if(doc.querySelector('.ct-chart-sales-value')) {
            //Chart 5
            let siswa_chart =  <?php echo json_encode($siswa_chart) ?>;
            const unit_name = [];
            const total_siswa = [];
            for(let i=0; i<siswa_chart.length; i++){
                unit_name.push(siswa_chart[i].nama_unit)       
                total_siswa.push(siswa_chart[i].count)       
            }
            console.log(total_siswa)
              new Chartist.Line('.ct-chart-sales-value', {
                labels: unit_name,
                series: [
                    total_siswa
                ]
              }, {
                low: 0,
                showArea: true,
                fullWidth: true,
                plugins: [
                  Chartist.plugins.tooltip()
                ],
                axisX: {
                    // On the x-axis start means top and end means bottom
                    position: 'end',
                    showGrid: true
                },
                axisY: {
                    // On the y-axis start means left and end means right
                    showGrid: false,
                    showLabel: false,
                    labelInterpolationFnc: function(value) {
                        return '$' + (value / 1) + 'k';
                    }
                }
            });
        }
        
        var scroll = new SmoothScroll('a[href*="#"]', {
            speed: 500,
            speedAsDuration: true
        });
    
    });
    </script>

@endpush
