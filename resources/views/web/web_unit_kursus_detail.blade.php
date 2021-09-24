@extends('web.layouts.main')

@section('title', 'Detail Kursus ' . $kursus_unit->kursus->nama_kursus )
@section('content')

<section style="background-image: url('{{ url('assets/images/kursus/'. $kursus_unit->kursus->gambar_kursus) }}');"
    class="pt-7 pb-5 d-flex align-items-end dark-overlay bg-cover">
    <div class="container overlay-content">
        <!-- Breadcrumbs -->
        <ol class="breadcrumb text-white justify-content-center no-border mb-0">
            <li class="breadcrumb-item"><a href="{{ route('front.index') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="#"
                    {{ $kursus_unit->kursus->nama_kursus }}</a></li>
            <li class="breadcrumb-item"><a href="{{ route('unit.detail', $kursus_unit->unit->slug) }}">
                    {{ $kursus_unit->unit->nama_unit }}</a></li>
            <li class="breadcrumb-item active">Detail Kursus </li>
        </ol>
        <div class="d-flex justify-content-between align-items-start flex-column flex-lg-row align-items-lg-end">
            <div class="text-white mb-4 mb-lg-0">
                <div class="badge badge-pill badge-transparent px-3 py-2 mb-4 text-capitalize">Kursus {{ $kursus_unit->type->nama_type }}</div>
                <h1 class="text-shadow verified">{{ $kursus_unit->kursus->nama_kursus  }}</h1>
                <p><i class="fa-map-marker-alt fas mr-2"></i> {{ $kursus_unit->unit->alamat }}</p>
                <p><i class="fas fa-home mr-2"></i>
                <a class="text-white" href="{{ route('unit.detail', $kursus_unit->unit->slug) }}"> Lihat Profil Unit <b>{{ $kursus_unit->unit->nama_unit }}</b>
                </a></p>
            </div>
        </div>
    </div>
</section>


<div class="container pt-5 pb-6">
    <div class="row">
        <div class="col-lg-8">

            <ul class="nav nav-pills nav-justified mb-3" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab"
                        aria-controls="pills-home" aria-selected="true">Deskripsi</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab"
                        aria-controls="pills-profile" aria-selected="false">Materi</a>
                </li>

            </ul>
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active py-1" id="pills-home" role="tabpanel"
                    aria-labelledby="pills-home-tab">
                    <div class="text-block">
                      <p class="text-muted font-weight-light"> {!! $kursus_unit->kursus->tentang !!}</p> 
                    </div>
                </div>
                <div class="tab-pane fade py-2" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                    <div class="card border-0 shadow-lg">
                        <div class="card-body">
                            {!! $kursus_unit->kursus->materi !!}
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-block ">
                <h4 class="mb-4">Fasilitas </h4>
                <div class="row mt-3">
                    @forelse ($unit->fasilitas as $f)
                    <div class="col-md-6">
                        <ul class="list-unstyled text-muted">
                                <li class="mb-2">
                                <i class="
                                   {{ $f->item != '' ? 'fa fa-check' : '' }}
                                   {{ $f->item == 'wifi' ? 'fa fa-wifi' : '' }}
                                   {{ $f->item == 'tv' ? 'fa fa-tv' : '' }}
                                   {{ $f->item == 'toilet' ? 'fa fa-shower' : '' }}
                                   {{ $f->item == 'komputer' ? 'fa fa-laptop' : '' }}
                                    text-secondary w-1rem mr-3 text-center"></i> 
                                    <span class="text-sm">{{ $f->item }}</span></li>
                            </ul>
                        </div>
                        @empty
                        <div class="col">
                            <div class="alert alert-info col-lg-12 col-sm-12 col-md-12 text-center text-black">
                            <h5><i class="fa fa-info-circle" aria-hidden="true"></i> <strong> Info! </strong></h5>
                             <p>Belum ada fasilitas untuk kursus ini</p>
                        </div>
                    </div>
                        @endforelse
                 
                </div>
            </div>

            <div class="text-block mb-2">
                <h4 class="mb-3">Galeri </h4>
                <div class="row gallery ml-n1 mr-n1">
                    @forelse ($gallery as $item)
                    @foreach (explode('|', $item->gambar) as $image)
                    <div class="col-lg-4 col-6 px-1 mb-2">
                        <a href="/storage/image/{{$image}}" data-fancybox="gallery" title="{{ $kursus_unit->kursus->nama_kursus }}">
                            <img src="/storage/image/{{$image}}" alt="" class="img-fluid mt-2"></a>
                    </div>
                    @endforeach

                    @empty
                    <div class="col">
                        <div class="alert alert-info col-lg-12 col-sm-12 col-md-12 text-center text-black">
                        <h5><i class="fa fa-info-circle" aria-hidden="true"></i> <strong> Info! </strong></h5>
                         <p>Belum ada galeri untuk kursus ini</p>
                    </div>
                </div>
                    @endforelse
                </div>
            </div>

           

        </div>

        <div class="col-lg-4">

            <div class="card border-0 shadow-lg">
                <div class="card-header text-primary text-center">
                    <h6 class="text-primary text-center">Detail Kursus </h6>
                </div>
                <div class="card-body p-4">
                    <div class="text-block pb-3">
                        <div class="media align-items-center">
                            <div class="">
                                <h6> <a href="#" class="text-reset"></a>
                                    {{ $kursus_unit->kursus->nama_kursus }}
                                </h6>
                                <p class="text-muted text-sm mb-0"> {{ $kursus_unit->kursus->keterangan }}</p>
                            </div>
                            <img src="{{ Storage::url('public/'. $kursus_unit->kursus->gambar_kursus) }}" alt=""
                                width="100" class="ml-3 rounded">
                        </div>
                    </div>

                    <div class="text-block pt-1 pb-0">
                        <table class="w-100">
                            <tr>
                                <th class="pt-3">Unit Kursus</th>
                                <td class="font-weight-bold text-right pt-3 text-capitalize"> {{ $kursus_unit->unit->nama_unit }} </td>
                            </tr>
                            <tr>
                                <th class="pt-3">Type Kursus</th>
                                <td class="font-weight-bold text-right pt-3 text-capitalize"> {{ $kursus_unit->type->nama_type }} </td>
                            </tr>
                            <tr>
                               
                                <th class="pt-3">Harga</th>
                                <td class="font-weight-bold text-right pt-3">
                                    @if ($kursus_unit->biaya_kursus != null)
                                    @currency($kursus_unit->biaya_kursus).00
                                    @else
                                    Harga belum ada
                                    @endif
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>

                <div class="card-footer bg-light py-2 border-top">
                    <div class="media align-items-center">
                        <div class="media-body">
                            @guest('siswa')
                                <p class="text-primary text-sm"> Belum punya akun ? </p>
                                <a href="{{ route('siswa.register') }}" class="btn btn-success btn-block">Register</a>
                            @endguest

                            @auth('siswa')
                                @if ($check_kursus != null)
                                <div class="alert alert-success" role="alert">
                                    <a href="{{ route('user.kursus') }}" class="btn btn-success btn-block">Lihat Kursus</a>
                                </div>
                                @else
                                <form action="{{ route('user.pesan', $kursus_unit->id) }}" method="post">
                                    @csrf
                                    <button type="submit" class="btn btn-primary btn-block btn-rounded-md btn-active">
                                        Pesan
                                    </button>
                                
                                </form>
                                @endif
                            @endauth
                            
                        </div>

                    </div>
                </div>
            </div>

            {{-- Jadwal section --}}

            <div class="card border-0 shadow-lg mt-3">
                <div class="card-header text-primary text-center">
                    <h6 class="text-primary text-center"> </h6>
                </div>
                <div class="card-body p-4">
                    <div class="text-block pb-3">
                        <div class="media align-items-center">
                            <div class="">
                                <h6> <a href="#" class="text-reset"></a>
                                    Jadwal Kursus
                                </h6>
                                <p class="text-muted text-sm mb-0"> {{ $kursus_unit->kursus->keterangan }}</p>
                            </div>
                            <img src="{{ Storage::url('public/'. $kursus_unit->kursus->gambar_kursus) }}" alt="" width="100" class="ml-3 rounded">
                        </div>
                    </div>

                    <div class="text-block pt-1 pb-0">
                        <table class="w-100">
                            @php
                                $init_hari = array('','Senin','Selasa','Rabu','Kamis','Jum\'at','Sabtu','Minggu')
                            @endphp
                            @forelse ($jadwals as $jadwal)
                            <tr>
                                <th class="pt-3">{{ $init_hari[$jadwal->hari] }}</th>
                                <td class="font-weight-bold text-right pt-3 text-capitalize"> {{ substr($jadwal->waktu_mulai, 0,-3) }} - {{ substr($jadwal->waktu_selesai, 0,-3) }} </td>
                            </tr> 
                            @empty
                            <div class="col">
                                <div class="alert alert-info col-lg-12 col-sm-12 col-md-12 text-center text-black">
                                <h5><i class="fa fa-info-circle" aria-hidden="true"></i> <strong> Info! </strong></h5>
                                 <p>Jadwal masih belum tersedia, silahkan hubungi unit pada kontak diatas.</p>
                            </div>
                        </div>
                            @endforelse
                            
                        </table>
                    </div>
                </div>

                <div class="card-footer bg-light py-2 border-top">
                    <div class="media align-items-center">
                        <div class="media-body">
                            <h6 class="text-primary text-center mb-2"> </h6>
                        </div>

                    </div>
                </div>
            </div>
        {{-- End jadwal section --}}

            
            <div class="pt-4">
                @if (session('message'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                    </button>
                    <strong>{{ session('message') }}</strong>
                </div>
                @endif

                <button type="button" data-toggle="collapse" data-target="#leaveReview" aria-expanded="false"
                    aria-controls="leaveReview" class="btn btn-outline-primary">Review Kursus Ini</button>
                <div id="leaveReview" class="collapse mt-4">
                    <h5 class="mb-4">Tinggalkan Review</h5>
                    <form id="contact-form" method="post" action="{{ route('komentar.post', $kursus_unit->id) }}"
                        class="form">
                        @csrf
                        <div class="form-group">
                            <label for="name" class="form-label">Nama Lengkap</label>
                            <input type="text" name="nama" id="name" placeholder="Masukkan Nama" required="required"
                                class="form-control {{ $errors->first('nama') ? 'is-invalid' : '' }}"
                                value="{{ old('nama') }}">
                            <div class="invalid-feedback">
                                {{ $errors->first('nama') }}
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" id="email" placeholder="Masukkan Email" required="required"
                                class="form-control {{ $errors->first('email') }}" value="{{ old('email') }}">
                            <div class="invalid-feedback">
                                {{ $errors->first('email') }}
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="review" class="form-label">Review</label>
                            <textarea rows="4" name="komentar" id="review" placeholder="Masukkan Review"
                                required="required"
                                class="form-control {{ $errors->first('komentar') }}">{{ old('komentar') }}</textarea>
                            <div class="invalid-feedback">
                                {{ $errors->first('komentar') }}
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-kirim">Kirim</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection



@push('scripts')
<script>
    $(document).ready(function () {
        $('.btn-kirim').on('click', function () {
            var $this = $(this);
            $('button').css("opacity", 0.4);
            var loadingText =
                '<button class="spinner-grow spinner-grow-sm"></button> Mengirim ...';
            if ($(this).html() !== loadingText) {
                $this.data('original-text', $(this).html());
                $this.html(loadingText);
            }
            setTimeout(function () {
                $this.html($this.data('original-text'));
            }, 3000);
        });
    });

</script>
@endpush
