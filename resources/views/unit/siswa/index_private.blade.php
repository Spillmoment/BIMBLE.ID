@extends('admin.layouts.tutor')

@section('title','Unit - Halaman Siswa')

@section('content')
<!-- Breadcrumbs-->
<div class="breadcrumbs">
    <div class="breadcrumbs-inner">
        <div class="row m-0">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Siswa</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li class="active">Type Private</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.breadcrumbs-->

<div class="content">

    <div class="row">

        @if (!$list_siswa->isEmpty())
            
            @foreach ($list_siswa as $data)
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Nama Siswa</th>
                        <th>Kursus</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><a href="{{ route('unit.siswa.private.card', $data->id) }}">{{ $data->siswa->nama_siswa }}</a></td>
                        <td>{{ $data->kursus_unit->kursus->nama_kursus }}</td>
                        <td>
                            @switch($data->status_sertifikat)
                                @case('terima')
                                    <span class="badge badge-primary">Siswa</span>
                                    @break
                                @case('lulus')
                                    <span class="badge badge-success">Lulus</span>
                                    @break
                                @default
                                    <button class="btn btn-success"><i class="fa fa-download"></i> Lulus</button>
                            @endswitch
                        </td>
                    </tr>
                </tbody>
            </table>
            @endforeach
        @else
        <h2>Tidak tersesia data siswa di kursus type private</h2>
            
        @endif

        <div class="col-lg-12">
            <div class="card">
            </div>
        </div>
    </div>

</div>


<!-- .animated -->

@endsection
