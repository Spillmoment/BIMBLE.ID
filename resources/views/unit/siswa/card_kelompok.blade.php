@extends('admin.layouts.tutor')

@section('title','Unit - Halaman Siswa')

@if(session('status'))
@push('after-script')
<script>
    swal({
        title: "Success",
        text: "{{session('status')}}",
        icon: "success",
        button: false,
        timer: 2000
    });

</script>
@endpush
@endif

@if($errors->any())
@push('after-script')
<script>
    swal({
        title: "Error",
        text: "Periksa kembali inputan Anda.",
        icon: "error",
        button: false,
        timer: 2000
    });

</script>
@endpush
@endif

@section('content')
<!-- Breadcrumbs-->
<div class="breadcrumbs">
    <div class="breadcrumbs-inner">
        <div class="row m-0">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Data siswa, {{ $siswa->nama_siswa }}</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li class="active">Type Kelompok</li>
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
        <div class="col-lg-12">

        @foreach ($list_siswa as $data)
            
        <div class="card mb-3" style="max-width: 350px;">
            <div class="card-deck">
                <div class="card">
                <img src="{{ url('assets/images/kursus/'. $data->kursus_unit->kursus->gambar_kursus) }}" class="card-img-top" alt="Gambar kursus">
                <div class="card-body">
                    <h5 class="card-title">{{ $data->kursus_unit->kursus->nama_kursus }}</h5>
                    <form action="{{ route('unit.siswa.kelompok.edit', $data->id) }}" method="post">
                        @csrf
                        @method('put')
                        <table class="table table-borderless">
                            <tr>
                                <td>Nilai</td>
                                <td>
                                    @if ($data->status_sertifikat == 'sertifikat')
                                        <input class="form-control" type="text" name="none" value="{{ $data->nilai }}" readonly>
                                    @else
                                    <input class="form-control" type="text" name="nilai" value="{{ $data->nilai }}">
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>Status</td>
                                <td>
                                    @if ($data->status_sertifikat == 'sertifikat')
                                        <span class="text-secondary"><em>"Siswa sudah mendapat sertifikat"</em></span>
                                    @else
                                    <small><em>* Untuk mengajukan sertifikat, ubah status menjadi <strong>Lulus</strong>. </em></small>
                                    <select name="status_sertifikat" class="form-control">
                                        <option value="terima" {{ ($data->status_sertifikat === 'terima') ? 'Selected' : '' }}>Siswa</option>
                                        <option value="lulus" {{ ($data->status_sertifikat === 'lulus') ? 'Selected' : '' }}>Lulus</option>
                                    </select>
                                        
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td><button type="submit" class="btn btn-warning">Ubah</button></td>
                            </tr>
                        </table>
                    </form>
                </div>
                <div class="card-footer">
                    <small class="text-muted">Last updated {{ $data->updated_at->format('j F Y') }}</small>
                </div>
                </div>
            </div>
        </div>

        @endforeach

            
 
        </div>        
    </div>

</div>

@endsection
