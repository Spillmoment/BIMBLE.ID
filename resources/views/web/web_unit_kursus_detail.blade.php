@extends('web.layouts.main')

@section('title', $kursus_unit->kursus->nama_kursus )

@section('content')

<section style="background-image: url('{{ url('assets/images/kursus/'. $kursus_unit->kursus->gambar_kursus) }}');"
    class="pt-7 pb-5 d-flex align-items-end dark-overlay bg-cover">
    <div class="container overlay-content">
        <!-- Breadcrumbs -->
        <ol class="breadcrumb text-white justify-content-center no-border mb-0">
            <li class="breadcrumb-item"><a href="{{ route('front.index') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="#" {{ $kursus_unit->kursus->nama_kursus }}</a> </li> <li
                    class="breadcrumb-item"><a href="{{ route('unit.detail', $kursus_unit->unit->slug) }}">
                        {{ $kursus_unit->unit->nama_unit }}</a></li>
            <li class="breadcrumb-item active">Detail Kursus </li>
        </ol>
        <div class="d-flex justify-content-between align-items-start flex-column flex-lg-row align-items-lg-end">
            <div class="text-white mb-4 mb-lg-0">
                <div class="badge badge-pill badge-transparent px-3 py-2 mb-4 text-capitalize">Kursus
                    {{ $kursus_unit->type->nama_type }}</div>
                <h1 class="text-shadow verified">{{ $kursus_unit->kursus->nama_kursus  }}</h1>
                <p><i class="fa-map-marker-alt fas mr-2"></i> {{ $kursus_unit->unit->alamat }}</p>
                <p><i class="fas fa-home mr-2"></i>
                    <a class="text-white" href="{{ route('unit.detail', $kursus_unit->unit->slug) }}"> Lihat Profil Unit
                        <b>{{ $kursus_unit->unit->nama_unit }}</b>
                    </a></p>
            </div>
        </div>
    </div>
</section>


<div class="container py-6">
    <div class="row">
        <div class="col-lg-8">

            <div class="text-block mb-2">
                <h4 class="mb-4">Deskripsi </h4>
                <p class="text-muted font-weight-light"> {!! $kursus_unit->kursus->tentang !!}</p>
            </div>

            <div class="text-block mb-2">
                <h4 class="mb-3">Kurikulum Kursus</h4>

                <!--Accordion wrapper-->
                <div class="accordion md-accordion mt-2" id="accordionEx" role="tablist" aria-multiselectable="true">
                    <!-- Accordion card -->
                    <div class="card border-1">
                        <!-- Card header -->
                        @forelse ($materis as $materi)
                        <div class="card-header" role="tab" id="headingThree3">
                            <a class="collapsed" data-toggle="collapse" data-parent="#accordionEx"
                                href="#collapseThree3" aria-expanded="false" aria-controls="collapseThree3">
                                <span class="text-muted"> Modul {{ $materi->bab }}</span>
                                <br>
                                <span class="mt-2 font-weight-bold text-dark">{{ $materi->judul }}</span> <i
                                    class="fas fa-angle-down rotate-icon float-right"></i>

                            </a>
                        </div>

                        <!-- Card body -->
                        <div id="collapseThree3" class="collapse" role="tabpanel" aria-labelledby="headingThree3"
                            data-parent="#accordionEx">
                            <div class="card-body">
                                {!! $materi->konten !!}
                            </div>
                        </div>
                        @empty
                        <div class="col">
                            <br>
                            <div class="alert alert-info col-lg-12 col-sm-12 col-md-12 text-center text-black">
                                <h5><i class="fa fa-info-circle" aria-hidden="true"></i> <strong> Info! </strong>
                                </h5>
                                <p>Kurikulum kursus masih belum tersedia</p>
                            </div>
                        </div>
                        @endforelse

                    </div>
                    <!-- Accordion card -->

                </div>
                <!-- Accordion wrapper -->
            </div>

            {{-- Jadwal section --}}
            <div class="card border-0 shadow-lg mt-3">
                <div class="card-header">
                    <h6 class="text-primary"> Jadwal Kursus </h6>
                </div>
                <div class="card-body p-4">
                    <div class="text-block pt-1 pb-0">
                        <table class="w-100">
                            @php
                            $init_hari = array('','Senin','Selasa','Rabu','Kamis','Jum\'at','Sabtu','Minggu')
                            @endphp
                            @forelse ($jadwals as $jadwal)
                            <tr>
                                <th class="pt-3">{{ $init_hari[$jadwal->hari] }}</th>
                                <td class="pt-3 text-capitalize">
                                    {{ substr($jadwal->waktu_mulai, 0,-3) }} -
                                    {{ substr($jadwal->waktu_selesai, 0,-3) }} </td>
                            </tr>
                            @empty
                            <div class="col">
                                <div class="alert alert-info col-lg-12 col-sm-12 col-md-12 text-center text-black">
                                    <h5><i class="fa fa-info-circle" aria-hidden="true"></i> <strong> Info! </strong>
                                    </h5>
                                    <p>Jadwal kursus masih belum tersedia.</p>
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

                @auth('siswa')
                <button type="button" data-toggle="collapse" data-target="#leaveReview" aria-expanded="false"
                    aria-controls="leaveReview" class="btn btn-outline-primary">Review Kursus Ini</button>
                <div id="leaveReview" class="collapse mt-4">
                    <h5 class="mb-4">Tinggalkan Review</h5>
                    <form id="contact-form" method="post" action="{{ route('komentar.post', $kursus_unit->id) }}"
                        class="form">
                        @csrf
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
                @endauth


            </div>
        </div>

        <div class="col-lg-4 mt-3">

            <!-- Section Mentor -->
            <div class="card border-0 shadow-lg mt-1">
                <div class="card-header bg-gray-200">
                    <h6 class="text-primary text-center">Profil Mentor </h6>
                </div>
                <div class="card-body p-4">
                    @forelse ($mentor as $item)
                    <div class="text-block pb-3">
                        <div class="media align-items-center">
                            <img src="{{ Storage::url('public/' . $item->foto) }}" alt="" width="90" height="80"
                                class="rounded-circle mr-3">
                            <div class="media-body">
                                <h6> <a href="detail-rooms.html" class="text-reset">{{ $item->nama_mentor }}</a>
                                </h6>
                                <p class="text-muted text-sm mb-0">{{ $item->kompetensi }}</p>
                            </div>
                        </div>
                        <hr>
                        <p class="text-muted font-weight-900 text-sm">
                            {{ $item->pengalaman }}
                        </p>
                    </div>
                    @empty
                    <div class="alert alert-info" role="alert">
                        <span>Belum ada mentor yang terdaftar di kursus ini.</span>
                    </div>
                    @endforelse


                </div>

            </div>
            <!-- -->

            <!-- Section Kursus -->
            <div class="card border-0 shadow-lg">
                <div class="card-header text-primary text-center bg-gray-200">
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
                        </div>
                    </div>

                    <div class="text-block pt-1 pb-0">
                        <table class="w-100">
                            <tr>
                                <th class="pt-3 text-gray-700">Unit Pengelola</th>
                                <td class="font-weight-bold text-right pt-3 text-capitalize">
                                    {{ $kursus_unit->unit->nama_unit }} </td>
                            </tr>
                            <tr>
                                <th class="pt-3 text-gray-700">Type Kursus</th>
                                <td class="font-weight-bold text-right pt-3 text-capitalize">
                                    {{ $kursus_unit->type->nama_type }} </td>
                            </tr>
                            <tr>

                                <th class="pt-3 text-gray-700">Harga</th>
                                <td class="font-weight-bold text-right pt-3">
                                    @if ($kursus_unit->biaya_kursus != null)
                                    @currency($kursus_unit->biaya_kursus)
                                    @else
                                    Harga belum ada
                                    @endif
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>

                <!-- Section Detail Kursus -->
                <div class="card-footer bg-light py-2 border-top">
                    <div class="media align-items-center">
                        <div class="media-body">
                            @guest('siswa')
                            <p class="text-primary text-sm"> Belum punya akun ? </p>
                            <a href="{{ route('siswa.register') }}" class="btn btn-success btn-block">Register</a>
                            @endguest

                            @auth('siswa')
                            @if ($check_kursus != null)
                            @if ($check_kursus->file != null)
                            <div class="alert alert-info col-lg-12 col-sm-12 col-md-12 text-center text-black">
                                <span class="font-weight-500">
                                    Konfirmasi pembayaran anda akan segera di cek oleh admin
                                </span>
                            </div>
                            @else
                            <div class="alert alert-info col-lg-12 col-sm-12 col-md-12 text-center text-black">
                                <span class="font-weight-500">
                                    Silahkan melakukan konfirmasi pembayaran sesuai dengan harga kursus yang tertera
                                </span>
                            </div>
                            @endif
                            @else
                            @if ($check_success != null)
                            <div class="alert alert-success col-lg-12 col-sm-12 col-md-12 text-center text-black">
                                <span class="font-weight-900">
                                    Selamat anda sudah mengambil
                                    <br> kursus <strong>
                                        {{ $check_success->kursus_unit->kursus->nama_kursus }}
                                    </strong>
                                </span>
                            </div>
                            <a class="btn btn-success btn-block" href="{{ route('user.kursus') }}">Lihat Kursus</a>
                            @else
                            <form action="{{ route('user.pesan', $kursus_unit->id) }}" method="post">
                                @csrf
                                <button type="submit" class="btn btn-primary btn-block btn-rounded-md btn-active">
                                    Pesan
                                </button>
                            </form>
                            @endif
                            @endif
                            @endauth
                        </div>
                    </div>
                </div>
                <!-- -->

            </div>
            <!-- -->

            <!-- Section Detail Pembayaran -->
            @auth('siswa')
            @if ($check_kursus != null)
            <div class="card border-0 shadow-lg mt-1">
                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-primary alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            <span class="sr-only">Close</span>
                        </button>
                        <strong>{{ session('status') }}</strong>
                    </div>
                    @endif
                    <div class="text-block">
                        <div class="media align-items-center">
                            <div class="">

                                <img src="https://alzafa.com/wp-content/uploads/2016/12/logo-bank-bni-e1429736787644.jpeg"
                                    width="120px" height="40px">
                                <p style="color: 34364a;" class="my-1"> PT.BIMBLE ID (Admin Bimble)</p>
                                <p class="font-weight-bold" class="my-1">0826428529</p>
                                <hr>

                                @if ($check_kursus->file == null)
                                <div class="form-group">
                                    <form action="{{ route('sertifikat.update', $check_kursus->id) }}" method="post"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('put')
                                        <label for="bukti">Upload Bukti Pembayaran: </label>
                                        <input type="file" class="form-control-file" name="file" id="bukti" required>
                                        <small id="fileHelpId" class="form-text text-muted">Upload harus format
                                            jpg/png</small>
                                        <br>
                                        <button type="submit" class="text-light btn btn-block"
                                            style="background-color: #2447f9;">Konfirmasi
                                            Pembayaran</button>
                                    </form>
                                </div>
                                @else
                                <div class="form-group">
                                    <form action="{{ route('sertifikat.update', $check_kursus->id) }}" method="post"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('put')
                                        <label for="bukti">Update Bukti Pembayaran: </label>
                                        <input type="file" class="form-control-file" name="file" id="bukti" required>
                                        <small id="fileHelpId" class="form-text text-muted">Upload harus format
                                            jpg/png</small>
                                        <br>
                                        <button type="submit" class="text-light btn btn-block"
                                            style="background-color: #2447f9;">Update
                                            Pembayaran</button>
                                    </form>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            @endauth
            <!-- -->


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
