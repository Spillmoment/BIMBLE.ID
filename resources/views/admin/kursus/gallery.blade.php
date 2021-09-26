@extends('admin.layouts.app')

@section('title', 'Admin - Galeri Kursus')

@section('content')

@if (session('status'))
@push('scripts')
<script>
    swal({
        title: "Good job!",
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
                        <li class="breadcrumb-item"><a href="#">Kursus</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Galeri Kursus</li>
                    </ol>
                </nav>

            </div>

        </div>
        <div class="card card-primary">
            <div class="card-header">
                <h4 class="card-title">Galeri {{ $kursus->nama_kursus }}</h4>
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
                            class="alert alert-primary col-lg-12 col-sm-12 col-md-12 text-center text-light font-weight-bold">
                            <big>Galeri Kursus Kosong</big> <a href="{{ route('kursus.index') }}"
                                class="btn btn-info text-light btn-md">Kembali Ke Kursus</a>

                        </div>
                    </div>

                    @endforelse


                </div>
            </div>
        </div>
    </div>
</div>

@endsection
