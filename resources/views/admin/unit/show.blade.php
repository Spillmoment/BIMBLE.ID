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
                <h2 class="h4">Table Unit</h2>
            </div>

        </div>
        <div class="card border-light shadow-sm components-section">
            <div class="card-header">
                <h3 class="card-title">Detail Unit {{ $unit->nama_unit }}</h3>
            </div>
            <div class="row">
                <div class="card-body">
                    <table class="table table-striped mt-2">
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
                            <th>Username</th>
                            <td>{{ $unit->username != null ? $unit->username : 'Belum ada username' }}</td>
                        </tr>

                        <tr>
                            <th>Foto</th>
                            <td>
                                @if ($unit->gambar_unit)
                                <img src="{{ url('assets/images/unit'. $unit->gambar_unit) }}" alt=""
                                    class="img-thumbnail mb-2" width="150px">
                                <br>
                                <button type="submit" class="btn btn-primary" data-toggle="modal"
                                    data-target="#modelId">
                                    <i class="fa fa-eye    "></i> Lihat</button>
                                @else
                                foto unit belum ada
                                @endif
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
                            <td><span class="btn btn-success">Aktif</span></td>
                            @else
                            <td><span class="btn btn-danger">Nonaktif</span></td>
                            @endif
                        </tr>
                    </table>
                    <footer class="footer section py-2">

                </div>

            </div>
        </div>
    </div>
</div>

@endsection
