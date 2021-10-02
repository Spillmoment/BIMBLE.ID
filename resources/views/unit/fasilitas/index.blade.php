@extends('unit.layouts.app')

@section('title','Unit - Halaman Fasilitas')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card border-light shadow-sm  component-section">
                <div class="card-header">
                    <h5>Pilihan Fasilitas Unit</h5>
                </div>
                <div class="card-body">
                    <form action="#" method="post" class="form-horizontal">
                        <div class="row form-group">

                            <div class="col-3 pt-3 form-check form-switch">
                                <input type="checkbox" class="form-check-input js-switch" data-nama="tv" value="tv"
                                    {{ in_array('tv',$fasilitas_unit) ? 'checked' : '' }}> Tv
                            </div>
                            <div class="col-3 pt-3 form-check form-switch">
                                <input type="checkbox" class="form-check-input js-switch" data-nama="kursi" value="kursi"
                                    {{ in_array('kursi',$fasilitas_unit) ? 'checked' : '' }}> Kursi
                            </div>
                            <div class="col-3 pt-3 form-check form-switch">
                                <input type="checkbox" class="form-check-input js-switch" data-nama="lcd" value="lcd"
                                    {{ in_array('lcd',$fasilitas_unit) ? 'checked' : '' }}> LCD
                            </div>
                            <div class="col-3 pt-3 form-check form-switch">
                                <input type="checkbox" class="form-check-input js-switch" data-nama="komputer" value="komputer"
                                    {{ in_array('komputer',$fasilitas_unit) ? 'checked' : '' }}> Komputer
                            </div>
                            <div class="col-3 pt-3 form-check form-switch">
                                <input type="checkbox" class="form-check-input js-switch" data-nama="kulkas" value="kulkas"
                                    {{ in_array('kulkas',$fasilitas_unit) ? 'checked' : '' }}> Kulkas
                            </div>
                            <div class="col-3 pt-3 form-check form-switch">
                                <input type="checkbox" class="form-check-input js-switch" data-nama="toilet" value="toilet"
                                    {{ in_array('toilet',$fasilitas_unit) ? 'checked' : '' }}> Toilet
                            </div>
                            <div class="col-3 pt-3 form-check form-switch">
                                <input type="checkbox" class="form-check-input js-switch" data-nama="wifi" value="wifi"
                                    {{ in_array('wifi',$fasilitas_unit) ? 'checked' : '' }}> Wifi
                            </div>

                            {{-- @endforeach --}}
                        </div>
                    </form>
                </div>
                <div class="card-footer"><h6 class="text-primary">Pilihan kursus boleh lebih dari satu</h6>
                </div>
            </div>
        </div>

    </div>

</div>


<!-- .animated -->

@endsection

@push('scripts')
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
                        const notyf = new Notyf({
                        position: {
                            x: 'right',
                            y: 'top',
                        },
                        types: [
                            {
                                type: 'success',
                                background: '#05A677',
                                icon: {
                                    className: 'fas fa-check',
                                    tagName: 'span',
                                    color: '#fff'
                                },
                                dismissible: false
                            }
                        ]
                    });
                    notyf.open({
                        type: 'success',
                        message: data.message
                    });
                        setTimeout(function () {
                            location.reload();
                        }, 300);
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
                        const notyf = new Notyf({
                                    position: {
                                        x: 'right',
                                        y: 'top',
                                    },
                                    types: [
                                        {
                                            type: 'success',
                                            background: '#05A677',
                                            icon: {
                                                className: 'fas fa-check',
                                                tagName: 'span',
                                                color: '#fff'
                                            },
                                            dismissible: false
                                        }
                                    ]
                                });
                                notyf.open({
                                    type: 'success',
                                    message: data.message
                                });
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
