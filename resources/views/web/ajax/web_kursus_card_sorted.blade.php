<div class="row">
    @forelse ($kursus as $krs)
    <div data-marker-id="59c0c8e33b1527bfe2abaf92" class="col-sm-6 col-xl-4 mb-5 hover-animate">
        <div class="card h-100 border-0 shadow">
            <div class="card-img-top overflow-hidden gradient-overlay"> <img
                    src="{{ Storage::url('public/'.$krs->gambar_kursus) }}" alt="{{ $krs->nama_kursus }}"
                    class="img-fluid" /><a href="{{ route('front.detail', [$krs->slug]) }}" class="tile-link"></a>
                <div class="card-img-overlay-bottom z-index-20">
                    <div class="media text-white text-sm align-items-center">
                        @foreach ($krs->tutor as $sensei)
                        <img src="{{ Storage::url('public/'.$sensei->foto) }}" alt="{{ $sensei->nama_tutor }}"
                            class="avatar-profile avatar-border-white mr-2" height="50px" />
                        <div class="media-body">{{ $sensei->nama_tutor }}</div>
                        @endforeach
                    </div>
                </div>

            </div>
            <div class="card-body d-flex align-items-center">
                <div class="w-100">
                    <h6 class="card-title"><a href="{{ route('front.detail', [$krs->slug]) }}"
                            class="text-decoration-none text-dark">{{$krs->nama_kursus}}</a></h6>
                    <div class="d-flex card-subtitle mb-3">
                        <p class="flex-grow-1 mb-0 text-muted text-sm">
                            @foreach ($krs->kategori as $item)

                            {{$item->nama_kategori}}</p>
                        @endforeach
                        </p>
                        <p class="flex-shrink-1 mb-0 card-stars text-xs text-right">
                            @php
                            $minat_kursus = $krs->order_detail_count/10;
                            $rating = round($minat_kursus*2)/2;
                            @endphp

                            @for($x = 5; $x > 0; $x--)
                            @php
                            if($rating > 0.5) {
                            echo '<i class="fa fa-star text-warning"></i>';
                            } elseif($rating <= 0 ) { echo '<i class="fa fa-star text-gray-300"></i>' ; } else {
                                echo '<i class="fa fa-star-half text-warning"></i>' ; } $rating--; @endphp @endfor </p>
                                </div> @if ($krs->diskon_kursus == 0)
                                <p class="card-text text-muted"><span class="h4 text-primary">
                                        @currency($krs->biaya_kursus)</span>
                                    per Bulan</p>
                                @else
                                <p class="card-text text-muted">
                                    <span class="h4 text-primary"> @currency($krs->biaya_kursus -
                                        ($krs->biaya_kursus * ($krs->diskon_kursus/100)))</span>
                                    per Bulan
                                </p>
                                <p class="card-text ">
                                    <strike>
                                        <span class="h6 text-danger">@currency($krs->biaya_kursus)</span>
                                    </strike>
                                    <strong class="ml-2">Diskon</strong> @currency($krs->diskon_kursus)%
                                </p>

                                @endif
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col text-center mb-5">
            <img width="200px" src="https://i.pinimg.com/originals/ea/66/cd/ea66cdf309ec3341db8d38bb298afa0f.gif">
            <p class="font-weight-bold mt-3" style="color: #071C4D;"> Pencarian tidak ditemukan
            </p>
            <a href="{{ route('front.kursus') }}" class="btn btn-primary btn-md">
                <i class="fas fa-caret-left fa-1x"></i> Kembali
            </a>
        </div>
        @endforelse
    </div>


    