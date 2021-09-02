@extends('admin.layouts.tutor')

@section('title','Unit - Halaman Kursus')

@push('after-style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.2/switchery.min.css">
{{-- CDN untuk tost --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-beta/css/bootstrap.min.css" />
<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,500&amp;subset=latin-ext" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />

<style>
    .card-custom {
    overflow: hidden;
    min-height: 200px;
    box-shadow: 0 0 15px rgba(10, 10, 10, 0.3);
  }

  .card-custom-img {
    height: 200px;
    min-height: 200px;
    background-repeat: no-repeat;
    background-size: cover;
    background-position: center;
    border-color: inherit;
  }

  /* First border-left-width setting is a fallback */
  .card-custom-img::after {
    position: absolute;
    content: '';
    top: 161px;
    left: 0;
    width: 0;
    height: 0;
    border-style: solid;
    border-top-width: 40px;
    border-right-width: 0;
    border-bottom-width: 0;
    border-left-width: 545px;
    border-left-width: calc(575px - 5vw);
    border-top-color: transparent;
    border-right-color: transparent;
    border-bottom-color: transparent;
    border-left-color: inherit;
  }
</style>
@endpush

@section('content')
<div class="content">
    
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    Pilihan kursus
                </div>
                <div class="card-body card-block">
                    <form action="#" method="post" class="form-horizontal">
                        <div class="row form-group">                            
                            @foreach ($list_kursus as $kursus)
                                <div class="col-6 pt-3">
                                    <input type="checkbox" class="js-switch" data-id ="{{ $kursus->id }}" {{ $kursus->kursus_unit->contains('unit_id',Auth::user()->id) ? 'checked' : '' }}> {{ $kursus->nama_kursus }}
                                </div>
                            @endforeach
                        </div>
                    </form>
                </div>
                <div class="card-footer"><small class="text-secondary">Pilihan kursus boleh lebih dari satu</small></div>
            </div>
        </div>

       
        </div>

          <div class="row">
          
            @foreach ($kursus_unit as $item)
            <div class="col-md-4">
                <div class="card card-custom bg-white border-white border-0" style="height: 380px">
                    <div class="card-custom-img" style="background-image: url({{ url('assets/images/kursus/'. $item->kursus->gambar_kursus) }});"></div>
                    <div class="card-body" style="overflow-y: auto">
                        <h4 class="card-title">{{ $item->kursus->nama_kursus }}</h4>
                        <p class="card-text">{{ $item->kursus->keterangan }}</p>
                    </div>
                    <div class="card-footer" style="background: inherit; border-color: inherit;">
                        <a href="{{ route('unit.kursus.add',$item->kursus_id) }}" class="btn btn-outline-primary">Detail</a>
                    </div>
                </div>           
            </div>
            @endforeach

          </div>

          <nav aria-label="Page navigation example">
            <ul class="pagination pagination-template d-flex ">
                {{ $kursus_unit->appends(Request::all())->links() }}
            </ul>
        </nav>

</div>


<!-- .animated -->

@endsection

@push('after-script')
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
</script>
<script>
    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('.js-switch').change(function () {
            let status = $(this).prop('checked');
            let id_kursus = $(this).data('id');
            if (status === true) {
                $.ajax({
                    type: 'post',
                    // dataType: "json",
                    url: '{{ route('unit.kursus.tambah') }}',
                    data: {
                        kursus_id: id_kursus
                    },
                    success: function (data) {
                        toastr.options.closeButton = true;
                        toastr.options.closeMethod = 'fadeOut';
                        toastr.options.closeDuration = 100;
                        toastr.success(data.message);

                        setTimeout(function () {
                            location.reload();
                        }, 200);
                    }
                });
            } else {
                swal({
                    title: "Apakah anda yakin?",
                    text: "Jika data dihapus, semua data yang berkaitan dengan kursus ini akan terhapus Permanen!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            type: 'delete',
                            // dataType: "json",
                            url: '{{ route('unit.kursus.hapus') }}',
                            data: {
                                kursus_id: id_kursus
                            },
                            success: function (data) {
                                swal({
                                    title: "Success",
                                    text: data.message,
                                    icon: "success",
                                    button: false,
                                    timer: 2000
                                });
                                setTimeout(function () {
                                    location.reload();
                                }, 200);
                            }
                        });
                    } else {
                        swal("Hapus berhasil digagalkan!");
                        setTimeout(function () {
                            window.location.replace('/unit/kursus');
                        }, 200);
                    }
                });
                
            }
        });

       
    });   
</script>
@endpush