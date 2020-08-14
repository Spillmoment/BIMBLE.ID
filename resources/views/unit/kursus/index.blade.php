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
        <div class="col-sm-8">
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

        <div class="col-sm-4">
            <div class="card">
                <div class="card-header">
                    <strong>Harga kursus</strong>
                </div>
                <div class="card-body card-block">
                    <div class="invalid-feedback">
                        {{$errors->first('biaya_kursus')}}
                    </div>
                    @foreach ($list_kursus as $kursus)
                    @foreach ($kursus->kursus_unit as $kursus_unit)
                    <form class="form-group" action="{{ route('unit.kursus.harga') }}" method="post">
                        <div class="form-group" id="price">
                            <label for="company" class=" form-control-label">{{ $kursus->nama_kursus }}</label>
                            <div class="col col-md-12">
                                <div class="input-group">
                                    
                                        @csrf
                                        @method('put')
                                        <input type="hidden" name="id" value="{{ $kursus_unit->id }}">
                                        <input type="text" id="biaya_kursus" name="biaya_kursus" class="input-sm form-control-sm form-control" value="{{ $kursus_unit->biaya_kursus }}">
                                        <button type="submit" class="btn btn-outline-primary btn-sm btn-harga" data-kursus="{{ $kursus->id }}"><i class="fa fa-pencil"></i></button>
                                    
                                </div>
                            </div> 
                        </div>
                    </form>
                    @endforeach
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="card">
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

        // $('.btn-harga').click(function () {
        //     let kursus_id = $(this).data('kursus');
        //     let biaya_kursus = $('#biaya_kursus').val();
        //     $.ajax({
        //         type: 'put',
        //         url: '{{ route('unit.kursus.harga') }}',
        //         data: {
        //             kursus_id: kursus_id,
        //             biaya_kursus: biaya_kursus
        //         },
        //         success: function (data) {
        //             toastr.options.closeButton = true;
        //             toastr.options.closeMethod = 'fadeOut';
        //             toastr.options.closeDuration = 100;
        //             toastr.success(data.message);

        //             setTimeout(function () {
        //                 location.reload();
        //             }, 200);
        //         }
        //     });
        // });
    });   
</script>
@endpush
