{{-- @extends('admin.layouts.tutor')

@section('title','Bimble - Tambah Data Siswa')
@section('content')

<div class="breadcrumbs">
    <div class="breadcrumbs-inner">
        <div class="row m-0">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Detail Siswa</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="{{ route('siswa.index') }}">Data Siswa</a></li>
                            <li class="active">Detail Siswa </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="content">

    <div class="card">
        <div class="card-header">
        <strong>Form Nilai <span class="badge badge-primary badge-lg badge-pill" style="font-size: 15px;">
            {{ $siswa->nama_siswa }}</span></strong>
    </div>
    <div class="card-body card-block">
        <form action="{{ route('siswa.add', [$siswa->id]) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="col-md-4">
                <div class="form-group ">
                    <label for="nilai">Nilai Siswa</label>
                    <input type="number" class="form-control {{ $errors->first('nilai') ? 'is-invalid' : '' }}"
                    name="nilai" id="nilai" value="{{old('nilai', $siswa->nilai)}}" placeholder="Nilai">
                    <div class="invalid-feedback">
                        {{$errors->first('nilai')}}
                    </div>
                </div>
                <div class="form-group">
                   <label for="keterangan">Keterangan</label>
                   <input name="keterangan" class="form-control {{ $errors->first('keterangan') ? 'is-invalid' : '' }}"
                       id="keterangan" rows="3" placeholder="Keterangan" value="{{ old('keterangan', $siswa->keterangan) }}">
                   <div class="invalid-feedback">
                       {{$errors->first('keterangan')}}
                   </div>
               </div>
            </div>

            <div class="form-group">
                @if ($siswa->nilai != null)
                <button class="btn btn-primary btn-block" type="submit">
                    Update Nilai
                </button>
                @else
                <button class="btn btn-primary btn-block" type="submit">
                    Tambah Nilai
                </button>
                @endif
            </div>
        </form>
    </div>
</div>
</div>
@endsection --}}
<form action="/tutor/siswa/nilai/{{ $siswa->id }}" method="post">
    @csrf
    @method('put')
    <input type="hidden" name="id" value="{{ $siswa->id }}">
    <div class="form-group">
      <label for="nilai">Nilai</label>
      <input type="text" class="form-control {{ $errors->first('nilai') ? 'is-invalid' : '' }}" name="nilai" id="nilai" value="{{ old('nilai', $siswa->nilai) }}">
      <div class="invalid-feedback">
        {{ $errors->first('nilai') }}
      </div>
    </div>
   <div class="form-group">
     <label for="keterangan">Keterangan</label>
     <input type="text" class="form-control {{ $errors->first('keterangan') ? 'is-invalid' : '' }}" name="keterangan" id="keterangan" value="{{ old('keterangan', $siswa->keterangan) }}">
     <div class="invalid-feedback">
      {{ $errors->first('keterangan') }}
    </div>
    </div>
    
        <button type="submit" class="btn btn-primary btn-block">Edit nilai</button>
  </form>