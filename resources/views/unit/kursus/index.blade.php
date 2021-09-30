@extends('unit.layouts.app')

@section('title', 'Unit - Halaman Kursus')

@section('content')

<div class="row mb-3">
    <div class="col-sm-12">

        <div class="card border-light shadow-sm components-section">
            <div class="card-header">
                Pilihan kursus
            </div>
            <div class="card-body card-block">
                <form action="#" method="post" class="form-horizontal">
                    <div class="row form-group">                            
                        @foreach ($list_kursus as $kursus)
                            <div class="col-6 pt-3 form-check form-switch">
                                <input type="checkbox" class="form-check-input js-switch"  id="flexSwitchCheckChecked" data-id ="{{ $kursus->id }}" {{ $kursus->kursus_unit->contains('unit_id',Auth::user()->id) ? 'checked' : '' }}> {{ $kursus->nama_kursus }}
                            </div>
                        @endforeach
                    </div>
                </form>
            </div>
            <div class="card-footer"><span class="text-warning font-weight-bold">Pilihan kursus boleh lebih dari satu</span></div>
        </div>
    </div>

   
    </div>

      <div class="row my-3">
        @foreach ($kursus_unit as $item)
        <div class="col-md-4 my-2">
            <div class="card" style="width: 20rem;">
                <img src="{{ url('assets/images/kursus/'. $item->kursus->gambar_kursus) }}" class="card-img-top" alt="...">
                <div class="card-body">
                  <h5 class="card-title">{{ $item->kursus->nama_kursus }}</h5>
                  <a href="{{ route('unit.kursus.add',$item->kursus_id) }}" class="btn btn-primary float-right"> <i class="fas fa-eye"></i> Detail</a>
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

@endsection

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
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
