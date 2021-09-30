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
                <h2 class="h4">Detail Kursus {{ $kursus->nama_kursus }}</h2>
            </div>

        </div>
        <div class="card border-light shadow-sm components-section">
            <div class="row">
                <div class="card-body">
                    <a href="{{ route('kursus.index') }}" class="btn btn-primary btn-sm"> <i class="fa fa-angle-left"
                            aria-hidden="true"></i> Kembali</a>
                    <table class="table table-striped mt-2">

                        <tr>
                            <th>Nama Kursus </th>
                            <td>{{ $kursus->nama_kursus }}</td>
                        </tr>

                        <tr>
                            <th>Gambar Kursus</th>
                            <td>
                                <img src="{{ url('assets/images/kursus/' . $kursus->gambar_kursus) }}" alt=""
                                    class="img-thumbnail mb-2" width="150px">
                                <br>
                                <button type="submit" class="btn btn-primary btn-sm" data-toggle="modal"
                                    data-target="#modelId">
                                    <i class="fas fa-eye"></i> Lihat</button>
                            </td>
                        </tr>

                        <tr>
                            <th>Kategori Kursus</th>
                            <td>{{ $kursus->kategori->nama_kategori}}</td>
                        </tr>

                        <tr>
                            <th>Materi</th>
                            <td>{!! $kursus->materi !!}</td>
                        </tr>

                        <tr>
                            <th>Deskripsi</th>
                            <td>{!! $kursus->deskripsi !!}</td>
                        </tr>

                        <tr>
                            <th>Keterangan</th>
                            <td>{{ $kursus->keterangan }}</td>
                        </tr>

                    </table>

                    <footer class="footer section py-2">

                </div>

            </div>
        </div>
    </div>
</div>

@endsection
