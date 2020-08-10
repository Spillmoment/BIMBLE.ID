@extends('web.layouts.main')

@section('title','Bimble | Daftar Kursus')
@section('content')

<div class="container-fluid py-5 px-lg-5">

    <div class="row">
        <div class="col-lg-3 pt-3">
            <form action="#" class="pr-xl-3">
                <div class="mb-4">
                    <label for="form_search" class="form-label">Pencarian</label>
                    <div class="input-label-absolute input-label-absolute-right">
                        <div class="label-absolute"><i class="fa fa-search"></i></div>
                        <input type="search" name="keyword" placeholder="Cari Kursus?" id="form_search"
                            class="form-control pr-4" value="{{ Request::get('keyword') }}">
                    </div>
                </div>
                <div class="float-right">
                    <button type="submit" class="btn btn-primary"> <i class="fas fa-search mr-1"></i>
                </div>
                </button>
            </form>

        </div>
        <div class="col-lg-9">

            <div class="row">
                <!-- venue item-->
                @foreach ($kursus as $item)
                <div data-marker-id="59c0c8e322f3375db4d89128" class="col-sm-6 col-xl-4 mb-5 hover-animate">
                    <div class="card card-kelas h-100 border-0 shadow">
                        <div class="card-img-top overflow-hidden gradient-overlay">
                            <img src="{{ Storage::url('public/'. $item->gambar_kursus) }}"
                                alt="{{ $item->nama_kursus }}" class="img-fluid" /><a
                                href="{{ route('front.detail', $item->slug) }}" class="tile-link"></a>
                            <div class="card-img-overlay-top d-flex justify-content-between align-items-center">
                                <div class="badge badge-transparent badge-pill px-3 py-2">Popular</div>
                            </div>
                        </div>
                        <div class="card-body d-flex align-items-center">
                            <div class="w-100">
                                <h6 class="card-title"><a href="{{ route('front.detail', $item->slug) }}"
                                        class="text-decoration-none text-dark">{{ $item->nama_kursus }}</a></h6>
                                <div class="d-flex card-subtitle mb-3">
                                    <p class="flex-grow-1 mb-0 text-muted text-sm">{{ $item->keterangan }}</p>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                @endforeach

            </div>
            <!-- Pagination -->
            <nav aria-label="Page navigation example">
                <ul class="pagination pagination-template d-flex justify-content-center">
                    {{ $kursus->appends(Request::all())->links() }}
                </ul>
            </nav>
        </div>
    </div>
</div>

@endsection
