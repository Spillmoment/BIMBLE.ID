@extends('admin.layouts.tutor')

@section('title','Unit - Detail Kursus')
@section('content')
<div class="breadcrumbs">
    <div class="breadcrumbs-inner">
        <div class="row m-0">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Detail Kursus {{ $kursus->nama_kursus }}</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="{{ route('unit.kursus.home') }}">Data Kursus</a></li>
                            <li class="active">Detail Kursus </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="content">

    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab"
                aria-controls="pills-home" aria-selected="true">Private</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab"
                aria-controls="pills-profile" aria-selected="false">Kelompok</a>
        </li>

    </ul>

    <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
            <div class="card">
                <div class="card-body">
                    <h4 class="box-title">Detail Kursus
                        <span class="badge badge-primary badge-pill badge-lg" style="font-size: 15px;">
                            {{ $kursus->nama_kursus }}
                        </span>
                    </h4>

                    <table class="table table-bordered mt-2">
                        <tr>
                            <th>Nama Kursus </th>
                            <td>{{ $kursus->nama_kursus }}</td>
                        </tr>

                        <tr>
                            <th>Biaya Kursus</th>
                            <td>

                                @if ($kursus_unit->biaya_kursus != null)
                                @currency($kursus_unit->biaya_kursus).00
                                @else
                                belum ada harga untuk kursus ini
                                @endif
                            </td>
                        </tr>
                    </table>
                    <a href="{{ route('unit.kursus.home') }}" class="btn btn-primary btn-sm"> <i
                            class="fa fa-angle-left" aria-hidden="true"></i> Kembali</a>

                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">...</div>

    </div>


</div>



@endsection
