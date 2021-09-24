@extends('admin.layouts.main')

@section('title','Bimble - Galeri Kursus')
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Galeri Kursus {{ $kursus->nama_kursus }}</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('kursus.index') }}">Kursus</a></li>
                    <li class="breadcrumb-item active">Galeri Kursus </li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h4 class="card-title">{{ $kursus->nama_kursus }}</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @forelse ($items as $gallery)
                            @foreach (explode('|', $gallery->gambar) as $image)
                            <div class="col-sm-3">
                                <a href="/storage/image/{{$image}}" data-toggle="lightbox"
                                    data-title="Galeri - {{ $kursus->nama_kursus }}" data-gallery="gallery">
                                    <img src="/storage/image/{{$image}}" class="img-fluid mb-2" alt="white sample" />
                                </a>
                            </div>

                            @endforeach
                            @empty
                            <div class="col">
                                <div
                                    class="my-2 alert alert-warning col-lg-12 col-sm-12 col-md-12 text-center text-black font-weight-bold">
                                    Galeri Kursus Kosong <a href="{{ route('kursus.index') }}"
                                        class="btn btn-warning text-light btn-md">Kembali Ke Kursus</a>

                                </div>
                            </div>

                            @endforelse


                        </div>
                    </div>
                </div>
            </div>

            <!-- /.col -->
        </div>

        <!-- /.row (main row) -->
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection
@push('scripts')
<script>
    $(function () {
        $(document).on('click', '[data-toggle="lightbox"]', function (event) {
            event.preventDefault();
            $(this).ekkoLightbox({
                alwaysShowClose: true
            });
        });

        $('.filter-container').filterizr({
            gutterPixels: 3
        });
        $('.btn[data-filter]').on('click', function () {
            $('.btn[data-filter]').removeClass('active');
            $(this).addClass('active');
        });
    })

</script>
@endpush
