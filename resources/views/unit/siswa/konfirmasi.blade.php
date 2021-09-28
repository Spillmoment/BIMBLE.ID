@extends('admin.layouts.tutor')

@section('title','Unit - Konfirmasi Siswa')

@push('after-style')
{{-- CDN untuk tost --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
@endpush

@section('content')
<!-- Breadcrumbs-->
<div class="breadcrumbs">
    <div class="breadcrumbs-inner">
        <div class="row m-0">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Nilai Siswa</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="#">Siswa</a></li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.breadcrumbs-->

<div class="content">

    <div class="row">

        <table class="table table-dark">
          <tr>
            <td>Nama</td>
            <td>Kelas</td>
            <td>Tipe</td>
            <td>Aksi</td>
          </tr>

          @foreach ($semua_siswa as $data)
          <tr>
            <td>{{ $data->siswa->nama_siswa }}</td>
            <td>{{ $data->kursus_unit->kursus->nama_kursus }}</td>
            <td>{{ $data->kursus_unit->type->nama_type }}</td>
            <td><button class="btn btn-primary" id="btn-konfirm" data-siswa="{{ $data->id }}">Diterima</button></td>
          </tr>

          @endforeach
        </table>

        <div class="col-lg-12">
            <div class="card">
            </div>
        </div>
    </div>

</div>

@endsection

@push('after-script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#btn-konfirm').click(function () {
            let siswa = $(this).data('siswa');
            $.ajax({
                type: 'put',
                // dataType: "json",
                url: '{{ route('unit.konfirmasi.update') }}',
                data: {
                    siswa: siswa
                },
                success: function (data) {
                    toastr.options.closeButton = true;
                    toastr.options.closeMethod = 'fadeOut';
                    toastr.options.closeDuration = 100;
                    toastr.success(data.message);
                    setTimeout(function () {
                                    location.reload();
                                }, 100);
                },
                error: function () {
                    toastr.options.closeButton = true;
                    toastr.options.closeMethod = 'fadeOut';
                    toastr.options.closeDuration = 100;
                    toastr.error('Terjadi kesalahan requesting.');
                }
            });
            
        });
    });   
</script>
@endpush