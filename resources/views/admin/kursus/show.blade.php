@extends('admin.layouts.app-manager')

@section('title', 'Admin - Detail Kursus')

@section('content')

<div class="row">
    <div class="col-12 mb-4">

        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center py-4">
            <div class="d-block mb-4 mb-md-0">
                <nav aria-label="breadcrumb" class="d-none d-md-inline-block">
                    <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
                        <li class="breadcrumb-item"><a href="#"><span class="fas fa-home"></span></a></li>
                        <li class="breadcrumb-item"><a href="#">Kursus</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Detail Kursus</li>
                    </ol>
                </nav>
            </div>

        </div>
        <div class="card border-light shadow-sm components-section">
            <div class="card-header">
                <h4 class="card-title">Detail Kursus {{ $kursus->nama_kursus }}</h4>
            </div>
            <div class="row">
                <div class="col-md-3 mx-2">
                    <a href="{{ route('kursus.index') }}" class="btn btn-primary btn-sm"> <i class="fa fa-angle-left"
                            aria-hidden="true"></i> Kembali</a>
                </div>
            </div>
            <div class="row">
                <div class="card-body">
                    <style>
                        th,
                        td {
                            font-weight: 600;
                        }

                    </style>
                    <table class="table table-striped">

                        <tr>
                            <th>Nama Kursus </th>
                            <td>{{ $kursus->nama_kursus }}</td>
                        </tr>

                        <tr>
                            <th>Gambar Kursus</th>
                            <td>
                                @isset($kursus->gambar_kursus)
                                <img src="{{ url('assets/images/kursus/' . $kursus->gambar_kursus) }}" alt=""
                                    class="img-thumbnail mb-2" width="150px">
                                @else
                                Gambar belum ada
                                @endisset
                            </td>
                        </tr>

                        <tr>
                            <th>Kategori Kursus</th>
                            <td>{{ $kursus->kategori->nama_kategori}}</td>
                        </tr>

                        <tr>
                            <th>Deskripsi</th>
                            <td>{!! $kursus->deskripsi ? $kursus->deskripsi : 'deskripsi belum ada' !!}</td>
                        </tr>

                        <tr>
                            <th>Keterangan</th>
                            <td>{{ $kursus->keterangan }}</td>
                        </tr>

                    </table>

                </div>

            </div>
        </div>
    </div>
</div>

@endsection
