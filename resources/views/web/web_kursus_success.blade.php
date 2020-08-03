@extends('web.layouts.main')

@section('title','Bimble - Kursus ' . Auth::user()->nama_pendaftar )
@section('content')

      <section class="py-5 bg-gray-100"> 
          <div class="container">
        
            <ol class="breadcrumb pl-0  justify-content-center">
              <li class="breadcrumb-item"><a href="{{ route('front.index') }}">Home</a></li>
              <li class="breadcrumb-item active">Kursus Saya</li>
            </ol>

          <div class="row mb-5">  
            
              <div class="col-md-8">
                <h4 class="mt-2">Daftar Kursus {{ Auth::user()->nama_pendaftar }}</h4>

                @if ($check == null)
                <div class="col alert alert-info text-md mb-3 mt-5">
                    <div class="media align-items-center">
                        <div class="media-body text-center">
                            <strong>Anda masih belum memiliki kursus</strong>
                        </div>
                    </div>
                </div>
                @endif

              </div>
            
           <div class="row mt-3">
               @forelse ($kursus_success as $row)
               @foreach ($row->kursus as $cours)
            <div class="col-lg-4 col-sm-6 mb-4 hover-animate">
              <div class="card shadow border-0 h-100"><a href="{{ route('front.detail',$cours->slug) }}"><img src="{{ Storage::url('public/'.$cours->gambar_kursus) }}" alt="{{ $cours->nama_kursus }}" class="img-fluid card-img-top"/></a>
                <div class="card-body"><a href="#" class="text-uppercase text-muted text-sm letter-spacing-2">{{ $cours->kategori->first()->nama_kategori }}</a>
                  <h5 class="my-2"><a href="{{ route('front.detail',$cours->slug) }}" class="text-dark"> {{ $cours->nama_kursus }}</a></h5>
                  <p class="my-2 text-muted text-sm">{{ $cours->keterangan }}</p>
                  <a href="{{ route('user.kursus.kelas', $cours->slug) }}" class="btn btn-link pl-0">Review<i class="fa fa-comment-dots ml-2"></i></a>
                </div>
              </div>
            </div>
            @endforeach
            @empty
            @endforelse

        </div>   
        
                    <!-- Pagination -->
                    <nav aria-label="Page navigation example">
                      <ul class="pagination pagination-template d-flex justify-content-center">
                          {{ $kursus_success->links() }}
                      </ul>
                  </nav>
        </div>
    </div>
      </section>
      
@endsection