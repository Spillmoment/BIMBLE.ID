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
          
            @forelse ($kursus_unit as $item)
           <div class="col-md-4">
            <div class="card" style="width: 18rem;">
                <img class="card-img-top" src="{{ url('assets/images/kursus/'. $item->kursus->gambar_kursus) }}" alt="{{ $item->kursus->nama_kursus }}">
                <div class="card-body">
                  <h5 class="card-title">{{ $item->kursus->nama_kursus }}</h5>
                  <a href="{{ route('unit.kursus.add',$item->id) }}" class="btn btn-primary btn-sm btn-block"> <i class="fa fa-eye"></i> Detail</a>
                </div>
              </div>
           </div>
           @empty
                 <div class="alert alert-primary justify-content-center" role="alert">
                     <h4><center>Belum ada kursus yang dipilih</center></h4>
                 </div>
             @endforelse
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