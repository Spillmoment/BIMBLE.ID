@extends('admin.layouts.tutor')

@section('title','Unit - Halaman Kursus')

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
                <aside class="profile-nav alt">
                    <section class="card">
                        <div class="card-header  bg-primary">
                            <div class="media">
                                <a href="#">
                                    <img class="align-self-center mr-3" style="width:100px; height:80px;" alt="" src="{{ url('assets/images/kursus/'. $item->kursus->gambar_kursus) }}">
                                </a>
                                <div class="media-body">
                                    <h4 class="text-white display-6 mb-2">{{ $item->kursus->nama_kursus }}</h4>
                                    <p class="text-dark font-weight-bold">{{ auth()->user()->nama_unit }} </p>
                                    <p>{{ $item->type_id == 1 ? 'Private' : 'Kelompok' }}</p>
                                </div>
                            </div>
                        </div>
    
                        <ul class="list-group list-group-flush ">
                            <li class="list-group-item">
                                <div class="float-left">
                                    <span>{{ $item->status }}</span>
                                </div>
                                <div class="float-right">
                                    <a class="btn btn-success btn-sm" href="{{ route('unit.kursus.detail', $item->kursus->slug) }}"> <i class="fa fa-eye"></i> Detail </a>
                                    <a class="btn btn-success btn-sm" href="{{ route('unit.kursus.add',$item->id) }}"> <i class="fa fa-tasks"></i> Pengaturan </a>
                                </div>
                                </li>
                        </ul>
    
                    </section>
                </aside>
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
                $.ajax({
                    type: 'delete',
                    // dataType: "json",
                    url: '{{ route('unit.kursus.hapus') }}',
                    data: {
                        kursus_id: id_kursus
                    },
                    success: function (data) {
                        toastr.options.closeButton = true;
                        toastr.options.closeMethod = 'fadeOut';
                        toastr.options.closeDuration = 100;
                        toastr.warning(data.message);

                        setTimeout(function () {
                            location.reload();
                        }, 200);
                    }
                });
            }
        });

       
    });   
</script>
@endpush