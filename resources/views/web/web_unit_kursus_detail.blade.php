@extends('web.layouts.main')

@section('title', 'Unit - ' . $unit->nama_unit )
@section('content')

<section style="background-image: url('{{ Storage::url('public/'. $kursus_unit->kursus->gambar_kursus) }}');"
    class="pt-7 pb-5 d-flex align-items-end dark-overlay bg-cover">
    <div class="container overlay-content">
         <!-- Breadcrumbs -->
         <ol class="breadcrumb text-white justify-content-center no-border mb-0">
            <li class="breadcrumb-item"><a href="{{ route('front.index') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('unit.detail', $kursus_unit->unit->slug) }}">Unit {{ $kursus_unit->unit->nama_unit }}</a></li>
            <li class="breadcrumb-item active">Detail Kursus </li>
        </ol>
        <div class="d-flex justify-content-between align-items-start flex-column flex-lg-row align-items-lg-end">
            <div class="text-white mb-4 mb-lg-0">
             
            <h1 class="text-shadow verified">{{ $kursus_unit->kursus->nama_kursus  }}</h1>
            <p><i class="fas fa-home mr-2"></i>{{  $kursus_unit->unit->nama_unit }}</p>
         
        </div>
    </div>
    </div>
</section>


<div class="container py-5">
    <div class="row">
        <div class="col-lg-8">
            <div class="text-block">
                <h4>Tentang Kursus Ini</h4>
                <p class="text-muted font-weight-light">{{ $kursus_unit->kursus->tentang }}</p>
            </div>

          
            <div class="card border-0 shadow">
                <div class="card-body p-4">
                    <div class="text-block pb-3">
                        <div class="media align-items-center">
                            <div class="media-body">
                                <h6> <a href="#" class="text-reset"></a>
                                {{ $kursus_unit->kursus->nama_kursus }}
                                </h6>
                                <p class="text-muted text-sm mb-0"> {{ $kursus_unit->kursus->keterangan }}</p>
    
                            </div>
                            <img
                                src="{{ Storage::url('public/'. $kursus_unit->kursus->gambar_kursus) }}"
                                alt="" width="100" class="ml-3 rounded">
                        </div>
                    </div>
    
                    <div class="text-block pt-1 pb-0">
                        <table class="w-100">
                            <tr>
                                <th class="pt-3">Harga</th>
                                <td class="font-weight-bold text-right pt-3">@currency($unit->kursus_unit->first()->biaya_kursus).00</td>
                            </tr>
                        </table>
                    </div>
                </div>
                
                <div class="card-footer bg-light py-2 border-top">
                    <div class="media align-items-center">
                        <div class="media-body">
                            <h6 class="text-primary text-center mb-2">Hubungi Kami </h6>
                            <div class="clearfix my-3">
                                <button type="submit" class="btn btn-success btn-sm">
                                    <img src="{{ asset('assets/frontend/img/logo/wa.png') }}" width="20px">
                                    <a href="https://api.whatsapp.com/send?phone={{ $unit->whatsapp }}&text=Halo%20Admin%20{{ $kursus_unit->unit->nama_unit }}%20Saya%20Mau%20Order%20Kursus%20{{ $kursus_unit->kursus->nama_kursus }}"
                                        target="_blank" class="text-white text-decoration-none"> Whats App </a>
                                </button>
                                <button type="submit" class="btn btn-primary btn-sm">
                                    <img src="{{ asset('assets/frontend/img/logo/telegram.png') }}" width="20px">
                                    <a href="https://t.me/{{ $unit->telegram }}" target="_blank"
                                        class="text-white text-decoration-none">Telegram</a>
                                </button>
                                <button type="submit" class="btn btn-secondary btn-sm">
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
                    <form id="contact-form" method="post" action="{{ route('komentar.post', $kursus_unit->id) }}" class="form">
                        @csrf
                        <div class="form-group">
                            <label for="name" class="form-label">Nama Lengkap</label>
                            <input type="text" name="nama" id="name" placeholder="Masukkan Nama" required="required"
                                class="form-control {{ $errors->first('nama') ? 'is-invalid' : '' }}" value="{{ old('nama') }}">
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
                                required="required" class="form-control {{ $errors->first('komentar') }}">{{ old('komentar') }}</textarea>
                                <div class="invalid-feedback">
                                    {{ $errors->first('komentar') }}
                                </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Kirim</button>
                    </form>
                </div>
            </div>

        </div>

        <div class="col-lg-4">

            {{-- <div class="text-block">
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
                           
                            @forelse ($kursus_lainya as $item)
                            @if ($item->kursus->slug != $kursus_unit->kursus->slug)
                            <li class="list-group-item d-flex justify-content-between aligns-items-center">
                                {{ $item->kursus->nama_kursus }}
                                <a href="{{ route('unit.detail.kursus', [$item->unit->slug, $item->kursus->slug]) }}">
                                    <span class="badge badge-primary badge-pill">
                                        <i class="fas fa-eye"></i>
                                    </span>
                                </a>
                            </li>
                            @endif
                            @empty
                            <div class="alert alert-warning text-sm mb-3 mt-3 col">
                                <div class="media align-items-center">
                                    <div class="media-body text-center ">Belum ada <strong>Kursus</strong> lainya
                                    </div>
                                </div>
                            </div>
                            @endforelse
                            
                        </ul>
                    </div>
                </div>
            </div> --}}
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
    });

</script>
@endpush
