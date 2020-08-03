<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Eh-Bimble | Halaman Pesanan</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">

    @include('web.layouts.style')

    {{-- CDN untuk switch button + cdn jquery --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.2/switchery.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.2/switchery.min.js"></script>

    {{-- CDN untuk tost --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    {{-- crsf-token Meta --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body style="padding-top: 72px;">
 

    @include('web.layouts.header')
    
    <section class="pt-3 py-5">
        <div class="container-fluid">

            <ol class="breadcrumb pl-0 justify-content-center">
                <li class="breadcrumb-item"><a href="{{ route('front.index') }}">Home</a></li>
                <li class="breadcrumb-item active">Pesanan</li>
              </ol>

            <div class="d-flex justify-content-between align-items-center flex-column flex-lg-row mb-5">
                <div class="mr-3">
                    <p class="mb-3 mb-lg-0 ml-4">Anda memiliki
    
                        @if ($order_kursus != null)
                        <strong>{{ $order_kursus->count() }} Pesanan Kursus</strong>
                        @else
                        <strong>0 Pesanan Kursus</strong>
                        @endif
    
                    </p>
                </div>
            </div>
            <div class="container-fluid mb-4">
                <div class="row">
    
                    <div class="col-9 mb-5">
    
                        @if (session('status'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                <span class="sr-only">Close</span>
                            </button>
                            <span>{{ session('status') }} </span>
                        </div>
                        @endif
    
                        <div class="card shadow">
                            <ul class="nav nav-pills mb-3 mx-3 my-3" id="pills-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home"
                                        role="tab" aria-controls="pills-home" aria-selected="true">Daftar Pesanan</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile"
                                        role="tab" aria-controls="pills-profile" aria-selected="false">Status Pesanan</a>
                                </li>
    
                            </ul>
    
                            <div class="tab-content" id="pills-tabContent">
                                {{-- Daftar Pesanan --}}
                                <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                                    aria-labelledby="pills-home-tab">
                                    <div class="table-responsive">
                                        <table class="table table-responsive">
                                            <thead>
                                                <tr class="text-sm">
                                                    <th scope="col"> </th>
                                                    <th scope="col" width="400">Kursus</th>
                                                    <th scope="col" width="180">Mentor</th>
                                                    <th scope="col" class="text-right">Harga</th>
                                                    <th> Cancel</th>
                                                    <th> Option</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse($order_kursus as $item)
                                                @foreach ( $item->kursus as $cours )
                                                <tr>
                                                    <td><img width="100px"
                                                            src="{{ Storage::url('public/'.$cours->gambar_kursus) }}"
                                                            alt="{{ $cours->nama_kursus }}" /> </td>
                                                    <td>{{ $cours->nama_kursus }}</td>
                                                    <td>{{ $cours->tutor->first()->nama_tutor }}</td>
                                                    </td>
                                                    <td> @currency($cours->biaya_kursus -
                                                        ($cours->biaya_kursus * ($cours->diskon_kursus/100))).00</td>
                                                    <td> <input type="checkbox" data-id="{{ $item->id }}" data-order="{{ $item->id_order }}"
                                                        data-pendaf="{{ $item->id_pendaftar }}" data-kursus="{{ $cours->nama_kursus }}"
                                                        name="status" class="js-switch" {{ $item->status == 'PROCESS' ? 'checked' : '' }}> </td>
                                                    <td class="text-right"><button class="deleteCart btn btn-sm btn-danger"
                                                            id="" data-id="{{ $item->id }}" data-nama_kursus="{{ $cours->nama_kursus }}"><i
                                                                class="fa fa-trash"></i> </button> </td>
                                                </tr>
                                                @endforeach
                                                @empty
                                              <table>
                                                  <tbody>
                                                    <div class="alert alert-warning text-sm mb-3 mt-3 col">
                                                        <div class="media align-items-center">
                                                          <div class="media-body text-center ">Pesanan <strong>kursus</strong> anda kosong </div>
                                                        </div>
                                                      </div>
                                                  </tbody>
                                              </table>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="card-body border-top">
                                        Total Tagihan:
                                        @if ($total_tagihan != 0)
                                        <span class="font-weight-bold" id="total">
                                            @currency($total_tagihan).00
                                        </span>
                                        @else
                                        0
                                        @endif
                                    </div>
                                </div>
    
    
                                {{-- Tab Status Pesanan --}}
                                <div class="tab-pane fade ml-3" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
    
                                    <!-- Tabel kirim bukti pembayaran -->
                                    <div class="row justify-content-md-center m-3">
                                    @forelse($order as $pesan)
                                        @if ($pesan->status_kursus == 'PENDING')
                                            <div class="card border-0 shadow col-md-8">
                                                <div class="card-header bg-gray-100 border-0">
                                                    <div class="media align-items-center">
                                                        <div class="col-md-8">
                                                            <div class="media-body">
                                                                <p class="subtitle text-sm text-primary">Pembayaran</p> 
                                                                <small class="text-muted">{{ $pesan->updated_at->diffForHumans() }}</small>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <button id="deleteCheckout" data-id="{{ $pesan->id }}" type="button" class="close" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-sm-8">
                                                               <table class="table text-sm mb-0">
                                                        <tr>
                                                            <th class="pl-0">Kursus yang diambil</th>
                                                            <td class="pr-0 text-primary font-weight-bold">
                                                                <ul style="list-style-type:circle">
                                                                    @foreach ($kursus_state as $list_kursus)
                                                                    <li>{{ $list_kursus->kursus->first()->nama_kursus }}
                                                                    </li>
                                                                    @endforeach
                                                                </ul>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="pr-0 text-right text-primary" colspan="2">
                                                                <div class="progress-bar progress-bar-striped progress-bar-animated bg-warning"
                                                                role="progressbar" style="width: 100%" aria-valuenow="100"
                                                                aria-valuemin="0" aria-valuemax="100">Proses...</div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <img src="{{ asset('storage/uploads/bukti_pembayaran/'.$pesan->upload_bukti) }}" 
                                                                class="img-fluid img-thumbail card-img" alt="upload_bukti">
                                                        </div>
                                                    </div>
                                                   
                                                </div>
                                            </div> 
                                            
                                        @elseif ($pesan->status_kursus == 'FAILED')
                                        <div class="card border-0 shadow col-md-8">
                                                <div class="card-header bg-gray-100 border-0">
                                                    <div class="media align-items-center">
                                                        <div class="media-body">
                                                            <p class="subtitle text-sm text-primary">Pembayaran</p> {{ $pesan->updated_at->diffForHumans() }}
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-sm-8">
                                                            <table class="table text-sm mb-0">
                                                               
                                                                <tr>
                                                                    <td class="pr-0 text-primary font-weight-bold">
                                                                        <div class="alert alert-info mt-3">
                                                                            <h4 class="alert-heading">Perhatikan!</h4>
                                                                            <hr>
                                                                            <p class="mb-0">
                                                                                <ol type="1">
                                                                                    <li>No. rekening tujuan</li>
                                                                                    <li>Jumlah tagihan anda sebesar <strong>@currency($pesan->total_tagihan).00</strong>
                                                                                    </li>
                                                                                </ol>
                                                                            </p>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="pr-0 text-right text-primary">
                                                                        <div class="progress-bar progress-bar-striped progress-bar-animated bg-danger"
                                                                        role="progressbar" style="width: 100%" aria-valuenow="100"
                                                                        aria-valuemin="0" aria-valuemax="100">Bukti Transfer Gagal...</div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="pr-0 text-right border-0">
                                                                        <form action="{{ route('order.patch.pembayaran') }}" method="POST"
                                                                            enctype="multipart/form-data" class="pr-xl-3">
                                                                            @csrf
                                                                            @method('patch')
                                                                            <div class="mb-4">
                                                                                <label for="form_search" class="form-label">Silahkan upload ulang
                                                                                    bukti transfer</label>
                                                                                <div class="input-label-absolute input-label-absolute-right">
                                                                                    <input type="file" name="fileTransfer" class="form-control-file pr-4">
                                                                                    <img class="img-target my-3" width="200px">
                                                                                </div>
                                                                            </div>
                                                                            <div class="pb-4">
                                                                                <div class="mb-4">
                                                                                    <button type="submit" class="btn btn-primary btn-sm"> <i
                                                                                            class="far fa-paper-plane mr-1"></i>Update
                                                                                    </button>
                                                                                </div>
                                                                            </div>
                                                                        </form> 
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <img src="{{ asset('storage/uploads/bukti_pembayaran/'.$pesan->upload_bukti) }}"
                                                                class="img-fluid img-thumbail card-img" alt="upload_bukti">
                                                        </div>
                                                    </div>

                                                 
                                                </div>
                                            </div>                                            
                                                                                      
                                        @endif

                                        @empty
                                        <div class="alert alert-warning col text-center mb-5 mt-3" role="alert">
                                            Data pesanan anda kosong, silahkan upload <strong>bukti transfer</strong> jika sudah
                                            mengambil kursus
                                        </div>
                                    @endforelse
                                    </div>
                                    <!-- End tabel kirim bukti pembayaran -->
                                
                                </div>
                            </div>
                        </div>
                    </div>
    
                    {{-- Upload bukti transfer --}}
                    <div class="col">
    
                        @if ($order_process > 0)
                        <div class="card shadow">
                            <div class="card-body">
                                <span>Upload Bukti Transfer :</span>
                                <span class="float-right h5"></span>
                                <hr>
                              @if ($order_status > 0)
                                <div class="alert alert-warning" role="alert">
                                    <strong>Silahkan menunggu konfirmasi untuk upload</strong>
                                </div>
                                  @else
                                  <form action="{{ route('order.post.pembayaran') }}" method="POST"
                                  enctype="multipart/form-data">
                                  @csrf
                                  <input type="file" name="upload_bukti_transfer"
                                      class="form-control-file pr-4 @error('upload_bukti_transfer') is-invalid @enderror">
                                  @error('upload_bukti_transfer')
                                  <div class="invalid-feedback">
                                      {{ $message }}
                                  </div>
                                  @enderror
                                  <img class="img-target my-3" width="200px">
                                  <br>
                                  <button type="submit" class="btn btn-primary float-right btn-md">Kirim</button>
                              </form>
                              @endif
    
                            </div> <!-- card-body.// -->
                        </div> <!-- card .// -->
                        @else
                       
                        @endif
                    </div>
    
                </div>
            </div>
    
            <!-- Pagination -->
            <nav aria-label="Page navigation example">
                <ul class="pagination pagination-template d-flex justify-content-center">
                    {{ $order_kursus->links() }}
                </ul>
            </nav>
        </div>
    </section>

    @include('web.layouts.footer')
    
    @include('web.layouts.script')

<script>
    $(document).ready(function () {
        var readURL = function (input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                    reader.onload = function (e) {
                        $('.img-target').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }

        $(".form-control-file").on('change', function () {
            readURL(this);
        });
    });

</script>

<script>

    let elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
    elems.forEach(function(html) {
        let switchery = new Switchery(html,  { size: 'small' });
    });

    $(document).ready(function(){
        $('.js-switch').change(function () {
            let status = $(this).prop('checked') === true ? 'PROCESS' : 'CANCEL';
            let orderId = $(this).data('id');
            let orderFk = $(this).data('order');
            let pendaftarId = $(this).data('pendaf');
            let namaKursus = $(this).data('kursus');
            $.ajax({
                type: "GET",
                dataType: "json",
                url: '{{ route('order.update.cancel') }}',
                data: {'status': status, 'order_id': orderId, 'order_fk': orderFk, 'id_pendaftar': pendaftarId, 'nama_kursus': namaKursus},
                success: function (data) {
                    toastr.options.closeButton = true;
                    toastr.options.closeMethod = 'fadeOut';
                    toastr.options.closeDuration = 100;
                    toastr.success(data.message);

                    document.getElementById("total").textContent=data.totalTagihan;
                }
            });
        });

        // function delete cart
        $(".deleteCart").on("click",function(e){

            var nama_kursus = $(this).data('nama_kursus');

            // sweealert 
            swal({
                title: "Yakin ?",
                text: "Anda akan menghapus pesanan kursus " + nama_kursus +" ",
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
                        url: "/order/cart/"+id,
                        type: 'DELETE',
                        data: {
                            _token: token,
                                id: id
                        },
                        success: function (response){
                            toastr.options.closeButton = true;
                            toastr.options.closeMethod = 'fadeOut';
                            toastr.options.closeDuration = 100;
                            toastr.warning(response.message);

                            document.getElementById("total").textContent=response.totalTagihan;
                            setTimeout(function(){
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
        $("#deleteCheckout").on("click",function(e){
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

                // e.preventDefault();
                var id = $(this).data("id");
                var token = $("meta[name='csrf-token']").attr("content");

                $.ajax({
                    dataType: "json",
                    url: "/order/checkout/"+id,
                    type: 'patch',
                    data: {
                        _token: token
                    },
                    success: function (response){
                        setTimeout(function(){
                            location.reload(); 
                        }, 500); 
                    }
                });

            } else {
                // swal("Your imaginary file is safe!");
            }
        });

        return false;
        });
        
    });

</script>


</body>
</html>
