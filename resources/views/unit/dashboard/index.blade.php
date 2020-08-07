@extends('admin.layouts.tutor')

@section('title','Bimble - Dashboard Tutor')

@section('content')
<div class="content">
    <!-- Animated -->
    <div class="animated fadeIn">
        <!-- Widgets  -->
        <div class="row">

            <div class="col-lg-4 col-md-3">
                <div class="card">
                    <div class="card-body">
                        <div class="stat-widget-five">
                            <div class="stat-icon dib flat-color-2">
                                <i class="pe-7s-browser"></i>
                            </div>
                            <div class="stat-content">
                                <div class="text-left dib">
                                    <div class="stat-text"><span class="count">10</span></div>
                                    <div class="stat-heading">Kursus</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-3">
                <div class="card">
                    <div class="card-body">
                        <div class="stat-widget-five">
                            <div class="stat-icon dib flat-color-2">
                                <i class="pe-7s-user"></i>
                            </div>
                            <div class="stat-content">
                                <div class="text-left dib">
                                    <div class="stat-text"><span class="count">10</span></div>
                                    <div class="stat-heading">Fasilitas</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- <div class="col-lg-3 col-md-3">
                <div class="card">
                    <div class="card-body">
                        <div class="stat-widget-five">
                            <div class="stat-icon dib flat-color-2">
                                <i class="pe-7s-user"></i>
                            </div>
                            <div class="stat-content">
                                <div class="text-left dib">
                                    <div class="stat-text"><span class="count">{{ $pendaftar }}</span>
        </div>
        <div class="stat-heading">Pendaftar</div>
    </div>
</div>
</div>
</div>
</div>
</div>

<div class="col-lg-3 col-md-3">
    <div class="card">
        <div class="card-body">
            <div class="stat-widget-five">
                <div class="stat-icon dib flat-color-2">
                    <i class="pe-7s-cart"></i>
                </div>
                <div class="stat-content">
                    <div class="text-left dib">
                        <div class="stat-text"><span class="count">{{ $order }}</span></div>
                        <div class="stat-heading">Order</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> --}}



</div>

<div class="row">
    <div class="col-md-8">
        <div class="card card-shadow">
            <div class="card-header">
                <strong>Profil Unit</strong>
            </div>
            <div class="card-body">

                <strong>Nama Unit</strong><br>
                <input type="text" value="{{ Auth::guard('unit')->user()->nama_unit }}" readonly
                    class="form-control mt-2 mb-2">
                <strong>Alamat</strong><br>
                <input type="text" value="{{ Auth::guard('unit')->user()->alamat }}" readonly
                    class="form-control mt-2 mb-2">
                <strong>Email</strong><br>
                <input type="text" value="{{ Auth::guard('unit')->user()->email }}" readonly
                    class="form-control mt-2 mb-2">
                <strong>Username</strong><br>
                <input type="text" value="{{ Auth::guard('unit')->user()->username }}" readonly
                    class="form-control mt-2 mb-2">
                <strong>Deskripsi Unit</strong><br>
                <textarea rows="3" type="text" readonly
                    class="form-control mt-2">{{ Auth::guard('unit')->user()->deskripsi }}</textarea>
            </div>
        </div>
    </div>


</div>
</div>


</div>


<!-- .animated -->

@endsection
