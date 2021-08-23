@extends('admin.layouts.tutor')

@section('title','Bimble - Dashboard Tutor')

@push('after-style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.2/switchery.min.css">
{{-- CDN untuk tost --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
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
                            {{-- @foreach ($kursus->kursus_unit as $kursus_unit) --}}
                                <div class="col-6 pt-3">
                                    <input type="checkbox" class="js-switch" data-id ="{{ $kursus->id }}" {{ $kursus->kursus_unit->contains('unit_id',Auth::user()->id) ? 'checked' : '' }}> {{ $kursus->nama_kursus }}
                                </div>
                                
                            {{-- @endforeach --}}
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
                <section class="card">
                    <div class="twt-feed blue-bg">
                        <div class="corner-ribon black-ribon">
                            <i class="fa fa-twitter"></i>
                        </div>
                        <div class="fa fa-twitter wtt-mark"></div>

                        <div class="media">
                            <a href="{{ route('unit.kursus.add',$item->kursus_id) }}">
                                <img class="align-self-center rounded-circle mr-3" style="width:85px; height:85px;" alt="" src="{{ url('assets/images/kursus/'. $item->kursus->gambar_kursus) }}">
                            </a>
                            <div class="media-body">
                                <h3 class="text-white display-6">{{ $item->kursus->nama_kursus }}</h3>
                                <p class="text-light">{{ auth()->user()->nama_unit }}</p>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            @endforeach

          </div>

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