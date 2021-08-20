@extends('admin.layouts.tutor')

@section('title','Unit - Halaman Fasilitas')

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
                    Pilihan fasilitas
                </div>
                <div class="card-body card-block">
                    <form action="#" method="post" class="form-horizontal">
                      <div class="row form-group">                            
                          {{-- @foreach ($fasilitas_unit as $fasilitas) --}}
                          {{-- {{ $check_item = implode(',', $fasilitas_unit) }} --}}
                          {{-- @endforeach --}}
                          {{-- {{ implode(',', $fasilitas_unit) }} --}}
                          
                          <div class="col-3 pt-3">
                              <input type="checkbox" class="js-switch" data-nama="tv" value="tv" {{ in_array('tv',$fasilitas_unit) ? 'checked' : '' }}> Tv
                          </div>
                          <div class="col-3 pt-3">
                              <input type="checkbox" class="js-switch" data-nama="kursi" value="kursi" {{ in_array('kursi',$fasilitas_unit) ? 'checked' : '' }}> Kursi
                          </div>
                          <div class="col-3 pt-3">
                              <input type="checkbox" class="js-switch" data-nama="lcd" value="lcd" {{ in_array('lcd',$fasilitas_unit) ? 'checked' : '' }}> LCD
                          </div>
                          <div class="col-3 pt-3">
                              <input type="checkbox" class="js-switch" data-nama="komputer" value="komputer" {{ in_array('komputer',$fasilitas_unit) ? 'checked' : '' }}> Komputer
                          </div>
                          <div class="col-3 pt-3">
                              <input type="checkbox" class="js-switch" data-nama="kulkas" value="kulkas" {{ in_array('kulkas',$fasilitas_unit) ? 'checked' : '' }}> Kulkas
                          </div>
                          <div class="col-3 pt-3">
                              <input type="checkbox" class="js-switch" data-nama="toilet" value="toilet" {{ in_array('toilet',$fasilitas_unit) ? 'checked' : '' }}> Toilet
                          </div>
                              
                          {{-- @endforeach --}}
                        </div>
                    </form>
                </div>
                <div class="card-footer"><small class="text-secondary">Pilihan kursus boleh lebih dari satu</small></div>
            </div>
        </div>

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
            let item = $(this).data('nama');
            if (status === true) {
                $.ajax({
                    type: 'post',
                    // dataType: "json",
                    url: '{{ route('unit.fasilitas.tambah') }}',
                    data: {
                        item: item
                    },
                    success: function (data) {
                        toastr.options.closeButton = true;
                        toastr.options.closeMethod = 'fadeOut';
                        toastr.options.closeDuration = 100;
                        toastr.success(data.message);
                    }
                });
            } else {
                $.ajax({
                    type: 'delete',
                    // dataType: "json",
                    url: '{{ route('unit.fasilitas.hapus') }}',
                    data: {
                        item: item
                    },
                    success: function (data) {
                        toastr.options.closeButton = true;
                        toastr.options.closeMethod = 'fadeOut';
                        toastr.options.closeDuration = 100;
                        toastr.warning(data.message);
                    }
                });
            }
        });
    });   
</script>
@endpush
