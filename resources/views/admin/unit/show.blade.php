@extends('admin.layouts.app-manager')

@section('title', 'Admin - Detail Unit')

@section('content')

<div class="row">
    <div class="col-12 mb-4">

        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center py-4">
            <div class="d-block mb-4 mb-md-0">
                <nav aria-label="breadcrumb" class="d-none d-md-inline-block">
                    <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
                        <li class="breadcrumb-item"><a href="#"><span class="fas fa-home"></span></a></li>
                        <li class="breadcrumb-item"><a href="#">Unit</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Detail Unit</li>
                    </ol>
                </nav>
            </div>

        </div>
        <div class="card border-light shadow-sm components-section">
            <div class="card-header">
                <h4 class="card-title">Detail Unit {{ $unit->nama_unit }}</h4>
            </div>
            <div class="row">
                <div class="col-md-3 mx-2">
                    <a href="{{ route('unit.index') }}" class="btn btn-primary btn-sm"> <i class="fa fa-angle-left"
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
                    <table class="table table-striped ">
                        <tr>
                            <th>Nama Unit </th>
                            <td>{{ $unit->nama_unit }}</td>
                        </tr>
                        <tr>
                            <th>Deskripsi</th>
                            <td>{{ $unit->deskripsi ? $unit->deskripsi : 'Belum ada deskripsi' }}</td>
                        </tr>
                        <tr>
                            <th>Alamat </th>
                            <td>{{ $unit->alamat }}</td>
                        </tr>

                        <tr>
                            <th>Email</th>
                            <td>{{ $unit->email }}</td>
                        </tr>

                        <tr>
                            <th>No Telepon</th>
                            <td>{{ $unit->no_telp ? $unit->no_telp : 'Belum ada no telepon' }}</td>
                        </tr>

                        <tr>
                            <th>Foto</th>
                            <td>
                                @isset($unit->gambar_unit)
                                <img src="{{ asset('assets/images/unit/'. $unit->gambar_unit) }}" alt=""
                                    class="img-thumbnail mb-2" width="150px">
                                @else
                                Gambar belum ada
                                @endisset
                            </td>
                        </tr>

                        <tr>
                            <th>Whats App</th>
                            <td>{{ $unit->whatsapp != null ? $unit->whatsapp : 'Belum ada whatsapp' }}</td>
                        </tr>
                        <tr>
                            <th>Telegram</th>
                            <td>{{ $unit->telegram != null ? $unit->telegram : 'Belum ada telegram' }}</td>
                        </tr>
                        <tr>
                            <th>Instagram</th>
                            <td>{{ $unit->instagram != null ? $unit->instagram : 'Belum ada instagram' }}</td>
                        </tr>

                        <tr>
                            <th>Status</th>

                            @if ($unit->status == 1)
                            <td><span class="btn btn-success btn-sm">Aktif</span></td>
                            @else
                            <td><span class="btn btn-danger btn-sm">Nonaktif</span></td>
                            @endif
                        </tr>

                        <tr>
                            <th>File Alumni</th>
                            <td>
                                <a href="/storage/file/{{ $unit->bukti_alumni }}"
                                    target="_blank">{{ $unit->bukti_alumni }}</a>
                            </td>
                        </tr>

                    </table>
                    <footer class="footer section py-2">

                </div>

            </div>
        </div>
    </div>
</div>

@endsection
