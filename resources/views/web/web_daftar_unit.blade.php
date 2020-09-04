@extends('web.layouts.main')

@section('title','Bimble | Daftar Unit')
@section('content')

<div class="container-fluid py-5 px-lg-5">

    <div class="row">
        <div class="col-lg-3 pt-3">
            <form action="{{ route('unit.list') }}" class="pr-xl-3">
                <div class="mb-4">
                    <label for="form_search" class="form-label">Pencarian</label>
                    <div class="input-label-absolute input-label-absolute-right">
                        <div class="label-absolute"><i class="fa fa-search"></i></div>
                        <input type="search" id="search" name="keyword" placeholder="Cari Unit?" id="form_search"
                            class="cari form-control pr-4" value="{{ Request::get('keyword') }}">
                    </div>
                </div>

                <button type="submit" class="btn btn-primary"> <i class="fas fa-search mr-1"></i>

                </button>
            </form>

        </div>
        <div class="col-lg-9">

            <div class="d-flex justify-content-between align-items-center flex-column flex-md-row mb-4">
                <div class="mr-3" style="color: #322F56">

                    {{-- @if (Request::get('type') != null)
                    <span class="text-item text-capitalize"><strong> Kursus {{ $nama_type }}</strong></span>
                    @else
                    <strong>Semua Kursus</strong>
                    @endif --}}
                </div>

            </div>

            <div class="row">
                <!-- venue item-->
                @forelse ($unit as $item)
                <div data-marker-id="59c0c8e322f3375db4d89128" class="col-sm-6 col-xl-4 mb-5 hover-animate">
                    <div class="card card-kelas h-100 border-0 shadow">
                        <div class="card-img-top overflow-hidden gradient-overlay">
                            <img @if ($item->gambar_unit != null)
                            src="{{ Storage::url('public/'.$item->gambar_unit) }}"
                            @else
                            src="{{asset('assets/frontend/img/photo/photo-1426122402199-be02db90eb90.jpg')}}"
                            @endif
                            alt="{{ $item->nama_unit }}"
                            class="img-fluid" />
                            <a href="{{ route('unit.detail', $item->slug) }}" class="tile-link"></a>
                        </div>
                        <div class="card-body d-flex align-items-center">
                            <div class="w-100">
                                <h6 class="card-title"><a href="{{ route('unit.detail', $item->slug) }}"
                                        class="text-decoration-none text-dark">{{ $item->nama_unit }}</a></h6>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="mt-5 col alert alert-warning text-center" role="alert">
                    <strong>Pencarian tidak ditemukan </strong>
                    <a href="{{ route('unit.list') }}" class="btn btn-warning">Kembali</a>
                </div>
                @endforelse

            </div>
            <!-- Pagination -->
            <nav aria-label="Page navigation example">
                <ul class="pagination pagination-template d-flex justify-content-center">
                    {{ $unit->appends(Request::all())->links() }}
                </ul>
            </nav>
        </div>
    </div>
</div>

@endsection

@push('scripts')

@endpush
