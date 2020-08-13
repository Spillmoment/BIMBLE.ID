@extends('web.layouts.main')

@section('title', 'Unit - ' . $unit->nama_unit )
@section('content')

<section class="hero py-6 py-lg-7 text-white dark-overlay"><img
        src="{{asset('assets/frontend/img/photo/photo-1426122402199-be02db90eb90.jpg')}}" alt="Text page"
        class="bg-image">
    <div class="container overlay-content">
        <!-- Breadcrumbs -->
        <ol class="breadcrumb text-white justify-content-center no-border mb-0">
            <li class="breadcrumb-item"><a href="{{ route('front.index') }}">Home</a></li>
            <li class="breadcrumb-item active">Unit Kursus </li>
        </ol>
        <h1 class="hero-heading">Selamat Datang Di Unit {{ $unit->nama_unit }}</h1>
        <img src="{{ Storage::url('public/' . $unit->gambar_unit) }}" class="avatar avatar-xl img-fluid">
    </div>
</section>

<div class="container py-5">
    <div class="row">
        <div class="col-lg-8">
            <div class="text-block">
                <h4>Tentang Kami</h4>
                <p class="text-muted font-weight-light">{{ $unit->deskripsi }}</p>
            </div>

            <div class="text-block">
                <h5 class="mb-4">Mentor Team </h5>

                <div class="col">
                    <div class="row py-3">
                        <div class="col-sm-3 mb-lg-0 mb-3">
                            <div class="card border-0 hover-animate ">
                                <img src="https://vignette.wikia.nocookie.net/naruto/images/2/21/Sasuke_Part_3_V2.png/revision/latest?cb=20170627161720&path-prefix=id"
                                    alt="" class="card-img-top rounded-circle avatar avatar-xl" height="150px"
                                    width="150px" />
                                <h6 class="my-2">Uchiha Sasuke</h6>
                                <p class="text-muted text-xs text-uppercase">Sharingan Developer </p>
                            </div>
                        </div>
                        <div class="col-sm-3 mb-lg-0 mb-3">
                            <div class="card border-0 hover-animate">
                                <img src="https://vignette.wikia.nocookie.net/naruto/images/0/0c/Madara_img2.png/revision/latest?cb=20170704141235&path-prefix=id"
                                    alt="" class="card-img-top  rounded-circle avatar avatar-xl" height="150px"
                                    width="150px" />
                                <h6 class="my-2">Uchiha Madara</h6>
                                <p class="text-muted text-xs text-uppercase">Rinnegan Developer </p>
                            </div>
                        </div>
                        <div class="col-sm-4 mb-lg-0 mb-3">
                            <div class="cardborder-0 hover-animate">
                                <img src="https://vignette.wikia.nocookie.net/xianb/images/e/e0/Teams.PNG/revision/latest/scale-to-width-down/340?cb=20161015215417"
                                    alt="" class="card-img-top  rounded-circle avatar avatar-xl" height="150px"
                                    width="150px" />
                                <h6 class="my-2">Uchiha Shisui</h6>
                                <p class="text-muted text-xs text-uppercase">Genjutsu Developer </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-block">
                <h4 class="mb-4">Fasilitas</h4>
                <div class="row">
                    <div class="col-md-4">
                        <ul class="list-unstyled text-muted">
                            <li class="mb-2"><i class="fa fa-wifi text-secondary w-1rem mr-3 text-center"></i> <span
                                    class="text-sm">Wifi</span></li>
                            <li class="mb-2"><i class="fa fa-tv text-secondary w-1rem mr-3 text-center"></i> <span
                                    class="text-sm">TV Kabel</span></li>
                            <li class="mb-2"><i class="fa fa-snowflake text-secondary w-1rem mr-3 text-center"></i>
                                <span class="text-sm">Air conditioning</span></li>
                            <li class="mb-2"><i
                                    class="fa fa-thermometer-three-quarters text-secondary w-1rem mr-3 text-center"></i>
                                <span class="text-sm">Heating</span></li>
                        </ul>
                    </div>
                    <div class="col-md-4">
                        <ul class="list-unstyled text-muted">
                            <li class="mb-2"><i class="fa fa-bath text-secondary w-1rem mr-3 text-center"></i><span
                                    class="text-sm">Toiletteries</span></li>
                            <li class="mb-2"><i class="fa fa-utensils text-secondary w-1rem mr-3 text-center"></i><span
                                    class="text-sm">Equipped Kitchen</span></li>
                            <li class="mb-2"><i class="fa fa-laptop text-secondary w-1rem mr-3 text-center"></i><span
                                    class="text-sm">Desk for work</span></li>
                            <li class="mb-2"><i class="fa fa-tshirt text-secondary w-1rem mr-3 text-center"></i><span
                                    class="text-sm">Washing machine</span></li>
                        </ul>
                    </div>
                </div>
            </div>


            <div class="text-block">
                <h5 class="mb-4">Galeri </h5>
                <div class="row gallery mb-3 ml-n1 mr-n1">

                    <div class="col-lg-4 col-6 px-1 mb-2">
                        <a href="{{asset('assets/frontend/img/photo/photo-1426122402199-be02db90eb90.jpg')}}"
                            data-fancybox="gallery" title="">
                            <img src="{{asset('assets/frontend/img/photo/photo-1426122402199-be02db90eb90.jpg')}}"
                                alt="" class="img-fluid mt-2"></a>
                    </div>

                    {{-- <div class="alert alert-warning text-sm mb-3 mt-3 col">
                    <div class="media align-items-center">
                        <div class="media-body text-center ">Belum ada <strong>Gallery</strong> untuk kursus ini
                        </div>
                    </div>
                </div> --}}

                </div>
            </div>


        </div>

        <div class="col-lg-4">
            <div class="card border-0 shadow">
                <div class="card-body p-4">
                    <div class="text-block pb-3">
                        <div class="media align-items-center">
                            <div class="media-body">
                                <h6> <a href="detail-rooms.html" class="text-reset">Belajar Bahasa Inggris</a></h6>
                                <p class="text-muted text-sm mb-0">Kursus terbaik untuk belajar inggris</p>

                            </div><img
                                src="https://images.squarespace-cdn.com/content/v1/5187cd71e4b0046126ddd7c5/1572397982967-W0KYMTST8W3GQA8Y3MS0/ke17ZwdGBToddI8pDm48kJFFD1DPuPyuJTJuKYnHMqUUqsxRUqqbr1mOJYKfIPR7LoDQ9mXPOjoJoqy81S2I8N_N4V1vUb5AoIIIbLZhVYxCRW4BPu10St3TBAUQYVKcarqm0CNTWK74Ln61sO77r7mRilwo1Bm_II3kb7M1nc_wILYhviYIDiXtjoEAJEUw/Kriteria+Tempat+Kursus+Inggris+Terbaik+yang+Bisa+Anda+Pilih.jpg"
                                alt="" width="100" class="ml-3 rounded">
                        </div>
                    </div>

                    <div class="text-block pt-1 pb-0">
                        <table class="w-100">
                            <tr>
                                <th class="pt-3">Harga</th>
                                <td class="font-weight-bold text-right pt-3">$499.50</td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="card-footer bg-light py-2 border-top">
                    <div class="media align-items-center">
                        <div class="media-body">
                            <h6 class="text-primary text-center mb-2">Hubungi Kami</h6>
                            <div class="clearfix my-3">
                                <button type="submit" class="btn btn-success btn-sm">
                                    <img src="{{ asset('assets/frontend/img/logo/wa.png') }}" width="20px">
                                    <a href="https://api.whatsapp.com/send?phone={{ $unit->whatsapp }}&text=Halo%20Admin%20Saya%20Mau%20Order%20Kursus%20laravel"
                                        target="_blank" class="text-white text-decoration-none"> Whats App </a>
                                </button>
                                <button type="submit" class="btn btn-primary btn-sm">
                                    <img src="{{ asset('assets/frontend/img/logo/telegram.png') }}" width="20px">
                                    <a href="https://t.me/{{ $unit->telegram }}" target="_blank"
                                        class="text-white text-decoration-none">Telegram</a>
                                </button>
                                <button type="submit" class="btn btn-secondary btn-sm mt-1">
                                    <img src="https://www.freepnglogos.com/uploads/amazing-instagram-logo-png-image-16.png"
                                        width="20px">
                                    <a href="https://www.instagram.com/{{ $unit->instagram }}" target="_blank"
                                        class="text-white text-decoration-none">Instagram</a>
                                </button>
                            </div>

                        </div>

                    </div>
                </div>
            </div>


            <div class="pt-4">
                <button type="button" data-toggle="collapse" data-target="#leaveReview" aria-expanded="false"
                    aria-controls="leaveReview" class="btn btn-outline-primary">Review Kursus Ini</button>
                <div id="leaveReview" class="collapse mt-4">
                    <h5 class="mb-4">Tinggalkan Review</h5>
                    <form id="contact-form" method="get" action="#" class="form">

                        <div class="form-group">
                            <label for="name" class="form-label">Nama Lengkap</label>
                            <input type="text" name="name" id="name" placeholder="Masukkan Nama" required="required"
                                class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" id="email" placeholder="Masukkan Email" required="required"
                                class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="review" class="form-label">Review</label>
                            <textarea rows="4" name="review" id="review" placeholder="Masukkan Review"
                                required="required" class="form-control"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Kirim</button>
                    </form>
                </div>
            </div>

            <div class="text-block">
                <!-- Detail Kursus -->
                <div class="card border-0 shadow">
                    <div class="card-header bg-gray-100 pt-3 pb-2 border-0">
                        <div class="media align-items-center">
                            <div class="media-body">
                                <p class="subtitle text-sm text-primary">Kursus Kami Lainya</p>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <ul class="list-group">
                            <li class="list-group-item d-flex justify-content-between aligns-items-center">
                                Laravel
                                <a href="#">
                                    <span class="badge badge-primary badge-pill">
                                        <i class="fas fa-eye"></i>
                                    </span>
                                </a>
                            </li>
                            <li class="list-group-item d-flex justify-content-between aligns-items-center">
                                React JS
                                <a href="#">
                                    <span class="badge badge-primary badge-pill">
                                        <i class="fas fa-eye"></i>
                                    </span>
                                </a>
                            </li>
                            <li class="list-group-item d-flex justify-content-between aligns-items-center">
                                Node JS
                                <a href="#">
                                    <span class="badge badge-primary badge-pill">
                                        <i class="fas fa-eye"></i>
                                    </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection



@push('scripts')
<script>
    $(document).ready(function () {
        $('.btn-primary').on('click', function () {
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
    })

</script>
@endpush
