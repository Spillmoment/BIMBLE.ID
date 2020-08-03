@extends('web.layouts.main')

@section('title','Bimble | Review ' . $kursus->nama_kursus)
@section('content')

<section class="hero py-6 py-lg-7 text-white dark-overlay">
   
    @if ($kursus->galleries->count() != null)
    <img src="{{ Storage::url($kursus->galleries->first()->image) }}" alt="Text page" class="bg-image">        
    @else
    <img src="{{asset('assets/frontend/img/photo/photo-1426122402199-be02db90eb90.jpg')}}" alt="Text page" class="bg-image">
    @endif

    <div class="container overlay-content">
      <!-- Breadcrumbs -->
      <ol class="breadcrumb text-white justify-content-center no-border mb-0">
        <li class="breadcrumb-item"><a href="{{ route('front.index') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('user.kursus.success') }}">Kursus Saya</a></li>
        <li class="breadcrumb-item active">Halaman Review Kursus </li>
      </ol>
      <h1 class="hero-heading">Review {{ $kursus->nama_kursus }}</h1>
    </div>
  </section>

  <div class="container py-5">
    <div class="row">
      <div class="col-lg-8"> 
              
        @if (session('flash'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
                <strong>{{ session('flash') }}</strong>
            </div>
        @endif

          <div class="text-block">
              <div class="py-1">
                <h5>Review Komentar anda tentang kursus ini</h5>
                    <form id="contact-form" method="POST" action="/user/kursus/{{ $kursus->slug }}" class="form mb-2">
                        @csrf
                      <div class="form-group">
                        <label for="review" class="form-label">Review *</label>
                        <textarea rows="4" id="review" placeholder="Masukkan Review Anda" required="required" class="form-control @error('textkomen') is-invalid @enderror" name="textkomen"></textarea>
                        @error('textkomen')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                      </div>
                   
                      <button type="submit" class="btn btn-primary btn-active">Kirim Review</button>
                    </form>
            
                </div>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="card border-0 shadow">
            <div class="card-body p-4">
              <div class="text-block pb-3">
                <div class="media align-items-center">
                  <div class="media-body">
                    <h6> <a href="{{ route('front.detail', $kursus->slug) }}" class="text-reset">{{ $kursus->nama_kursus }}</a></h6>
                    <p class="text-muted text-sm mb-0">{{ $kursus->keterangan }}</p>
                   
                  </div><a href="{{ route('front.detail', $kursus->slug) }}"><img src="{{ Storage::url('public/'. $kursus->gambar_kursus) }}" alt="" width="100" class="ml-3 rounded"></a>
                </div>
              </div>
              <div class="text-block py-3">
                <ul class="list-unstyled mb-0">
                  <li class="mb-3"><i class="fas fa-comment-dots fa-fw text-muted mr-2"></i>
                    <a href="{{ route('front.review',$kursus->slug) }}">
                      {{ $komentar->count() }} Review</li>
                    </a>
                </ul>
              </div>
              <div class="text-block pt-3 pb-0">
                <table class="w-100">
                  <tbody>
                      <tr>
                        <th class="font-weight-normal pt-2 pb-3">Lama Kursus</th>
                        <td class="text-right pt-2 pb-3">{{ $kursus->lama_kursus }} Hari</td>
                      </tr>
                    <tr>
                      <th class="font-weight-normal py-2">Tanggal Order</th>
                      <td class="text-right py-2">{{ $kursus->created_at->format('d F Y') }}</td>
                    </tr>
                  </tbody>
                  <tfoot>
                    <tr class="border-top">
                      <th class="pt-3">Total</th>
                      <td class="font-weight-bold text-right pt-3">@currency($kursus->biaya_kursus -
                        ($kursus->biaya_kursus * ($kursus->diskon_kursus/100))).00</td>
                    </tr>
                  </tfoot>
                </table>
              </div>
            </div>
            {{-- <div class="card-footer bg-primary-light py-4 border-0">
              <div class="media align-items-center">
                <div class="media-body">
                  <h6 class="text-primary">Flexible – free cancellation</h6>
                  <p class="text-sm text-primary opacity-8 mb-0">Cancel within 48 hours of booking to get a full refund. <a href="#" class="text-reset ml-3">More details</a></p>
                </div>
                <svg class="svg-icon svg-icon svg-icon-light w-3rem h-3rem ml-2 text-primary">
                  <use xlink:href="#diploma-1"> </use>
                </svg>
              </div>
            </div> --}}
          </div>
      </div>
    </div>
  </div>

@endsection
@push('scripts')
<script>
    $(document).ready(function () {
        $('.btn-active').on('click', function () {
            var $this = $(this);
            $('button').css("opacity", 0.4);
            var loadingText =
                '<button class="spinner-grow spinner-grow-sm"></button> Sedang Diproses...';
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
