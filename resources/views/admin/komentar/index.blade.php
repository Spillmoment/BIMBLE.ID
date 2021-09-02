@extends('admin.layouts.manager')
@section('title','Bimble - Data Review Kursus')


@section('content')

<div class="breadcrumbs">
    <div class="breadcrumbs-inner">
        <div class="row m-0">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Data Review Kursus</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="{{ route('unit.index') }}">Data Review Kursus</a></li>
                            <li class="active">List Review Kursus </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('after-script')
@if(session('status'))
<script>
    swal({
        title: "Success",
        text: "{{session('status')}}",
        icon: "success",
        button: false,
        timer: 2000
    });
</script>
@elseif(session('success'))
<script>
    swal({
        title: "Success",
        text: "{{session('success')}}",
        icon: "success",
        timer: 2000
    });
</script>
@endif
@endpush

<div class="content">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">Table Review Kursus</strong>
                    </div>
                    <div class="card-body">
                        <table id="bootstrap-data-table" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th width="100">Nama</th>
                                    <th width="100">Email</th>
                                    <th>Komentar</th>
                                    <th>Kursus</th>
                                    <th>Unit</th>
                                    <th width="100">Option</th>
                                </tr>
                            </thead>
                            <tbody>
                              
                              @foreach ($komentar as $r)
                              <tr>
                                    <td scope="row"> {{$loop->iteration}} </td>

                                    <td>{{ $r->nama }}</td>
                                    <td> {{ $r->email }} </td>
                                    <td>{{ $r->komentar }}</td>
                                    
                                    @foreach ($r->kursus_unit as $item)  
                                    <td> {{ $item->kursus->nama_kursus }} </td>
                                    <td> {{ $item->unit->nama_unit }} </td>
                                    @endforeach
                                  
                                    <td>
                                        <form class="d-inline" action="{{route('komentar.destroy', [$r->id])}}"
                                            method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" id="deleteButton" data-name="{{ $item->kursus->nama_kursus }}"
                                                class="btn btn-danger btn-sm">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>

                                  </tr>
                                  @endforeach
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>


        </div>
    </div><!-- .animated -->
</div>
@endsection

@push('after-script')
@include('admin.includes.datatable')
<script>
    $('button#deleteButton').on('click', function (e) {
        var name = $(this).data('name');
        e.preventDefault();
        swal({
                title: "Yakin!",
                text: "Menghapus review kursus  " + name + "?",
                icon: "warning",
                dangerMode: true,
                buttons: {
                    cancel: "Cancel",
                    confirm: "OK",
                },
            })
            .then((willDelete) => {
                if (willDelete) {
                    $(this).closest("form").submit();
                }
            });
    });

</script>
@endpush
