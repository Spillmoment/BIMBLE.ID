@extends('web.layouts.main')

@section('title','Bimble | Halaman Order')
@section('content')

{{-- crsf-token Meta --}}
<meta name="csrf-token" content="{{ csrf_token() }}">
{{-- CDN untuk switch button + cdn jquery --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.2/switchery.min.css">
{{-- CDN untuk tost --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">


<div class="container-fluid py-5 px-lg-5">
    <div class="row">
        @if ($order_status < 1) <div class="col-lg-3 pt-3">
            <form action="{{ route('order.post.pembayaran') }}" method="POST" enctype="multipart/form-data"
                class="pr-xl-3">
                @csrf
                <div class="mb-4">
                    <label for="form_search" class="form-label">Upload Bukti Transfer</label>
                    <div class="input-label-absolute input-label-absolute-right">
                        <input type="file" name="fileTransfer" class="form-control pr-4">
                    </div>
                </div>
                <div class="pb-4">
                    <div class="mb-4">
                        <button type="submit" class="btn btn-primary btn-upload btn-sm"> <i
                                class="far fa-paper-plane mr-1"></i>Kirim
                        </button>
                    </div>
                </div>
            </form>
    </div>
    @endif
    <div class="col-lg-9">
        <div class="d-flex justify-content-between align-items-center flex-column flex-md-row mb-4">

        </div>
        <div class="row">
            <!-- venue item-->
            @foreach ($order_kursus as $item)
            @foreach ( $item->kursus as $cours )
            <div data-marker-id="59c0c8e322f3375db4d89128" class="col-sm-6 col-xl-4 mb-5 hover-animate">
                <div class="card card-kelas h-100 border-0 shadow">
                    <div class="card-img-top overflow-hidden gradient-overlay">
                        <img src="{{ Storage::url('public/'.$cours->gambar_kursus) }}" alt="{{ $cours->nama_kursus }}"
                            class="img-fluid" /><a href="detail-kursus.html" class="tile-link"></a>
                        <div class="card-img-overlay-bottom z-index-20">
                            <div class="media text-white text-sm align-items-center">

                                @foreach ($cours->tutor as $tutor)
                                <img src="{{ Storage::url('public/'.$tutor->foto) }}" alt="John"
                                    class="avatar-profile avatar-border-white mr-2" />
                                <div class="media-body">{{ $tutor->nama_tutor }}</div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="card-body d-flex align-items-center">
                        <div class="w-100">
                            <h6 class="card-title"><a href="detail-kursus.html"
                                    class="text-decoration-none text-dark">{{ $cours->nama_kursus }}</a></h6>
                            <div class="d-flex card-subtitle mb-3">
                                <p class="flex-grow-1 mb-0 text-muted text-sm">{{ $cours->keterangan }}</p>
                                <p class="flex-shrink-1 mb-0 card-stars text-xs text-right"><i
                                        class="fa fa-star text-warning"></i><i class="fa fa-star text-warning"></i><i
                                        class="fa fa-star text-warning"></i><i class="fa fa-star text-warning"></i><i
                                        class="fa fa-star text-gray-300">
                                    </i>
                                </p>
                            </div>
                            <p class="card-text text-muted"><span class="h5 text-primary">Rp
                                    {{ $item->biaya_kursus }}</span> per
                                Bulan</p>
                            <p class="card-text text-muted">Dipotong diskon <span class="h6 text-danger">Rp
                                    {{ $cours->diskon_kursus }}% </p>
                            <input type="checkbox" data-id="{{ $item->id }}" data-order="{{ $item->id_order }}"
                                data-pendaf="{{ $item->id_pendaftar }}" data-kursus="{{ $cours->nama_kursus }}"
                                name="status" class="js-switch" {{ $item->status == 'PROCESS' ? 'checked' : '' }}>
                        </div>
                        <span id="deleteCart" data-id="{{ $item->id }}" class="badge badge-danger align-self-start"
                            style="cursor: pointer">x</span>
                    </div>
                </div>
            </div>
            @endforeach
            @endforeach
        </div>
        <!-- Pagination -->
        <h5 style="color: #322F56">Total tagihan Anda : Rp. <span id="total">{{ $total_tagihan }}</span></h5>

        @foreach ($order as $pesan)
        <div class="card mb-3" style="max-width: 540px;">
            <span id="deleteCheckout" data-id="{{ $pesan->id }}" class="badge badge-danger align-self-start"
                style="cursor: pointer">x</span>
            <div class="row no-gutters">
                <div class="col-md-4">
                    <img src="{{ asset('storage/uploads/bukti_pembayaran/'.$pesan->upload_bukti) }}" class="card-img"
                        alt="...">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title">Menunggu konfirmasi</h5>
                        <p class="card-text">
                            List kursus
                            <ul>
                                @foreach ($kursus_state as $list_kursus)
                                <li>{{ $list_kursus->kursus->first()->nama_kursus }}</li>
                                @endforeach
                            </ul>
                        </p>
                        <p class="card-text"><small class="text-muted">Pesanan
                                {{ $pesan->updated_at->diffForHumans() }}</small></p>
                      
                        @if ($pesan->status_kursus == 'FAILED')
                        <div class="progress">
                            <div class="progress-bar progress-bar-striped progress-bar-animated bg-danger"
                                role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0"
                                aria-valuemax="100">Gagal...</div>
                        </div>
                        <div class="alert alert-danger mt-3">
                            <h4 class="alert-heading">Perhatikan!</h4>
                            <hr>
                            <p class="mb-0">
                                <ol type="1">
                                    <li>No. rekening tujuan</li>
                                    <li>Jumlah tagihan anda sebesar Rp.{{ $pesan->total_tagihan }}</li>
                                </ol>
                            </p>
                        </div>
                        <form action="{{ route('order.patch.pembayaran') }}" method="POST" enctype="multipart/form-data"
                            class="pr-xl-3">
                            @csrf
                            @method('patch')
                            <div class="mb-4">
                                <label for="form_search" class="form-label">Upload bukti pembayaran</label>
                                <div class="input-label-absolute input-label-absolute-right">
                                    <input type="file" name="fileTransfer" class="form-control pr-4">
                                </div>
                            </div>
                            <div class="pb-4">
                                <div class="mb-4">
                                    <button type="submit" class="btn btn-primary"> <i
                                            class="far fa-paper-plane mr-1"></i>Update
                                    </button>
                                </div>
                            </div>
                        </form>
                        @else
                        <div class="progress">
                            <div class="progress-bar progress-bar-striped progress-bar-animated bg-warning"
                                role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0"
                                aria-valuemax="100">Proses...</div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        @endforeach

    </div>
</div>
</div>

@endsection

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.2/switchery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
    let elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
    elems.forEach(function (html) {
        let switchery = new Switchery(html, {
            size: 'small'
        });
    });

    $(document).ready(function () {
    $('.js-switch').change(function () {
        let status = $(this).prop('checked') === true ? 'PROCESS' : 'CANCEL';
        let orderId = $(this).data('id');
        let orderFk = $(this).data('order');
        let pendaftarId = $(this).data('pendaf');
        let namaKursus = $(this).data('kursus');
        $.ajax({
            type: "GET",
            dataType: "json",
            url: '{{ route('
            order.update.cancel ') }}',
            data: {
                'status': status,
                'order_id': orderId,
                'order_fk': orderFk,
                'id_pendaftar': pendaftarId,
                'nama_kursus': namaKursus
            },
            success: function (data) {
                toastr.options.closeButton = true;
                toastr.options.closeMethod = 'fadeOut';
                toastr.options.closeDuration = 100;
                toastr.success(data.message);

                document.getElementById("total").textContent = data.totalTagihan;
            }
        });
    });

    // function delete cart
    $("#deleteCart").on("click", function (e) {

        var nama = $(this).data('nama');

        // sweealert 
        swal({
                title: "Yakin ?",
                text: "mau dihapus order ini dengan kursus " + nama + " ",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {

                if (willDelete) {

                    e.preventDefault();
                    var id = $(this).data("id");
                    var token = $("meta[name='csrf-token']").attr("content");


                    $.ajax({
                        url: "/order/cart/" + id,
                        type: 'DELETE',
                        data: {
                            _token: token,
                            id: id
                        },
                        success: function (response) {
                            toastr.options.closeButton = true;
                            toastr.options.closeMethod = 'fadeOut';
                            toastr.options.closeDuration = 100;
                            toastr.warning(response.message);

                            document.getElementById("total").textContent = response
                                .totalTagihan;
                            setTimeout(function () {
                                location.reload();
                            }, 1500);
                        }
                    });

                } else {
                    // swal("Your imaginary file is safe!");
                }
            });

        return false;
    });

    // function delete checkout
    $("#deleteCheckout").on("click", function (e) {
        // sweealert 
        swal({
                title: "Yakin ?",
                text: "Membatalkan konfirmasi.",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {

                if (willDelete) {

                    e.preventDefault();
                    var id = $(this).data("id");
                    var token = $("meta[name='csrf-token']").attr("content");

                    $.ajax({
                        url: "/order/checkout/" + id,
                        type: 'DELETE',
                        data: {
                            _token: token,
                        },
                        success: function (response) {
                            setTimeout(function () {
                                location.reload();
                            }, 1500);
                        }
                    });

                } else {
                    // swal("Your imaginary file is safe!");
                }
            });

        return false;
    });


    })

    });

</script>
@endpush
