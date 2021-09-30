@extends('admin.layouts.app-manager')

@section('title', 'Admin - Detail Komentar')

@section('content')

<div class="row">
    <div class="col-12 mb-4">

        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center py-4">
            <div class="d-block mb-4 mb-md-0">
                <nav aria-label="breadcrumb" class="d-none d-md-inline-block">
                    <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
                        <li class="breadcrumb-item"><a href="#"><span class="fas fa-home"></span></a></li>
                        <li class="breadcrumb-item"><a href="#">Komentar</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Detail Komentar</li>
                    </ol>
                </nav>
                <h2 class="h4">Detail Komentar {{ $komentar->nama }}</h2>
            </div>

        </div>
        <div class="card border-light shadow-sm components-section">
            <div class="row">
                <div class="card-body">
                    <a href="{{ route('komentar.index') }}" class="btn btn-primary btn-sm"> <i class="fa fa-angle-left"
                            aria-hidden="true"></i> Kembali</a>
                    <table class="table table-striped mt-2">

                        <tr>
                            <th>Nama Siswa </th>
                            <td>{{ $komentar->nama }}</td>
                        </tr>

                        <tr>
                            <th>Email </th>
                            <td>{{ $komentar->email }}</td>
                        </tr>

                        <tr>
                            <th>Kursus </th>
                            <td>{{ $komentar->kursus_unit[0]->kursus->nama_kursus }}</td>
                        </tr>

                        <tr>
                            <th>Unit </th>
                            <td>{{ $komentar->kursus_unit[0]->unit->nama_unit }}</td>
                        </tr>

                        <tr>
                            <th>Komentar </th>
                            <td>{{ $komentar->komentar }}</td>
                        </tr>




                    </table>

                    <footer class="footer section py-2">

                </div>

            </div>
        </div>
    </div>
</div>

@endsection
