@extends('admin.layouts.manager')

@section('title','Bimble - Detail Kursus')
@section('content')
<div class="breadcrumbs">
    <div class="breadcrumbs-inner">
        <div class="row m-0">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Detail Kursus</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="{{ route('kursus.index') }}">Data Kursus</a></li>
                            <li class="active">Detail Kursus </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="content">

    <div class="card">
        <div class="card-body">
            <h4 class="box-title">Detail Kursus
                <span class="badge badge-primary badge-pill badge-lg" style="font-size: 15px;">
                    {{ $kursus->nama_kursus }}
                </span>
            </h4>
            <table class="table table-bordered mt-2">

                <tr>
                    <th>ID</th>
                    <td>{{ $kursus->id }}</td>
                </tr>
                <tr>
                    <th>Nama Kursus </th>
                    <td>{{ $kursus->nama_kursus }}</td>
                </tr>

                <tr>
                    <th>Gambar Kursus</th>
                    <td>
                        <img src="{{ Storage::url('public/' . $kursus->gambar_kursus) }}" alt=""
                            class="img-thumbnail mb-2" width="150px">
                        <br>
                        <button type="submit" class="badge badge-primary btn-sm" data-toggle="modal" data-target="#modelId">
                            <i class="fa fa-eye    "></i> Lihat</button>
                    </td>
                </tr>

                <tr>
                    <th>Kategori Kursus</th>
                    @foreach ($kursus->kategori as $kat)
                    <td>{{ $kat->nama_kategori}}</td>
                    @endforeach
                </tr>

                <tr>
                    <th>Tutor Kursus</th>
                    @foreach ($kursus->tutor as $tur)
                    <td>{{ $tur->nama_tutor}}</td>
                    @endforeach
                </tr>

                <tr>
                    <th>Biaya Kursus</th>
                    <td>@currency($kursus->biaya_kursus).00</td>
                </tr>

                <tr>
                    <th>Diskon Kursus</th>
                    <td>{{ $kursus->diskon_kursus }}%</td>
                </tr>

                <tr>
                    <th>Latitude</th>
                    <td>{{ $kursus->latitude }}</td>
                </tr>

                <tr>
                    <th>Longitude</th>
                    <td>{{ $kursus->longitude }}</td>
                </tr>

                <tr>
                    <th>Lama Kursus</th>
                    <td>{{ $kursus->lama_kursus }} Hari</td>
                </tr>

                <tr>
                    <th>Keterangan</th>
                    <td>{{ $kursus->keterangan }}</td>
                </tr>
            </table>

              
            <a href="{{ route('kursus.index') }}" class="btn btn-primary btn-sm"> <i class="fa fa-angle-left" aria-hidden="true"></i> Kembali</a>

        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><span class="badge badge-light badge-pill badge-lg" style="font-size: 15px;">
                        Foto Kursus {{ $kursus->nama_Kursus }}
                    </span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <img src="{{ Storage::url('public/' . $kursus->gambar_kursus) }}" alt="" class="img-thumbnail mb-2">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>

            </div>
        </div>
    </div>
</div>

@endsection
