<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }}</title>

    @include('web.layouts.style')
    <link
        href="https://fonts.googleapis.com/css?family=Assistant:200,300,400,600,700,800|Playfair+Display:400,400i,700,700i,900,900i&display=swap"
        rel="stylesheet">

</head>

<body>

    <!-- Navbar -->
    <div class="container">
        <nav class="row navbar navbar-expand-lg navbar-light bg-white">
            <div class="navbar-nav ml-auto mr-auto mr-sm-auto mr-lg-0 mr-md-auto">
                <a href="{{ route('front.index') }}" class="navbar-brand">
                    <img src="{{ asset('assets/frontend/img/logo.png') }}" alt="">
                </a>
            </div>
            <ul class="navbar-nav mr-auto d-none d-lg-block">
                <li>
                    <span class="text-auto">
                        <span class="text-muted">
                            | &nbsp; belajar bersama kami di kursus bimble
                        </span>
                    </span>
                </li>
            </ul>

        </nav>
    </div>

    <section class="hero py-lg-5">
        <div class="container position-relative">
            <!-- Breadcrumbs -->
            <ol class="breadcrumb pl-0  justify-content-center">
                <li class="breadcrumb-item"><a href="{{ route('front.index') }}">Home</a></li>
                <li class="breadcrumb-item active">Halaman Kursus Sukses</li>
            </ol>

            @php
            $order = Session::get('order')
            @endphp

            @if (session('order') != null)
            @forelse($order as $item)
            @foreach ($item->kursus as $cours)
            <h2 class="hero-heading mt-2">Yayy! Kursus berhasil diambil</h2>
            <div class="row">
                <div class="col-xl-8 mx-auto">
                    <img width="200px" src="{{ Storage::url('public/'.$cours->gambar_kursus) }}"
                        class="img-fluid img-thumbnail">
                    <p class="text-lg text-muted mt-3 mb-3">{{ $cours->nama_kursus }}</p>
                    <p class="mb-0"><a href="{{ route('front.index') }}" class="btn btn-primary mr-4">Home</a><a
                            href="{{ route('order.view') }}" class="btn btn-outline-primary">Pesanan</a></p>
                </div>
            </div>
            @endforeach

            @empty
            @endforelse
            @else
            <h2 class="hero-heading mt-2">Kursus belum diambil</h2>
            <div class="row">
                <div class="col-xl-8 mx-auto">
                    <img width="200px"
                        src="https://cdn.dribbble.com/users/1219289/screenshots/4904617/picker_empty_state_icon_.jpg"
                        class="img-fluid img-thumbnail mb-5">
                    <p class="mb-0"><a href="{{ route('front.index') }}" class="btn btn-primary mr-4">Home</a><a
                            href="{{ route('order.view') }}" class="btn btn-outline-primary">Pesanan</a></p>
                </div>
            </div>

            @endif

        </div>
    </section>


</body>

</html>
