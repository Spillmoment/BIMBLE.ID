@extends('unit.layouts.app')

@section('title','Unit - Detail Siswa Kelompok')

@section('content')

@if(session('status'))
@push('scripts')
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
@push('scripts')
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

<div class="container-fluid">
    <div class="row">
        <div class="mb-3 d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center">
            <div class="d-block mb-md-0 ">
                <nav aria-label="breadcrumb" class="d-none d-md-inline-block">
                    <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
                        <li class="breadcrumb-item"><a href="#"><span class="fas fa-user-circle"></span></a></li>
                        <li class="breadcrumb-item"><a href="#">Siswa Private</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Detail Siswa Private</li>
                    </ol>
                </nav>
            </div>
        </div>

        <h4>Data Siswa {{ $siswa->nama_siswa }}</h4>

        @foreach ($list_siswa as $data)
        <div class="col-md-4 my-4">
            <div class="card shadow-lg border-light components-section">
                <img class="card-img-top"
                    src="{{ url('assets/images/kursus/'. $data->kursus_unit->kursus->gambar_kursus) }}" alt="">
                <div class="card-body">
                    <h5 class="card-title">{{ $data->kursus_unit->kursus->nama_kursus }}</h5>
                    <hr>
                    <form action="{{ route('unit.siswa.private.edit', $data->id) }}" method="post">
                        @csrf
                        @method('put')
                        <div class="mb-3">
                            <label for="nilai">Nilai</label>
                            @if ($data->status_sertifikat == 'sertifikat')
                            <input id="nilai" class="form-control" type="number" name="none" value="{{ $data->nilai }}"
                                readonly>
                            @else
                            <input id="nilai" placeholder="Masukkan Nilai" class="form-control" type="number"
                                name="nilai" value="{{ $data->nilai }}">
                            @endif
                        </div>
                        <div class="mb-3">
                            <label for="status">Status</label>
                            <div class="mb-2">
                                @if ($data->status_sertifikat == 'sertifikat')
                                <span class="text-secondary"><em>"Siswa sudah mendapat
                                        sertifikat"</em></span>
                                @else
                                <small><em>* Untuk mengajukan sertifikat, ubah status menjadi
                                        <strong>Lulus</strong>. </em></small>
                            </div>
                            <select name="status_sertifikat" class="form-select">
                                <option value="terima" {{ ($data->status_sertifikat === 'terima') ? 'selected' : '' }}>
                                    Siswa</option>
                                <option value="lulus" {{ ($data->status_sertifikat === 'lulus') ? 'selected' : '' }}>
                                    Lulus
                                </option>
                            </select>

                            @endif
                        </div>
                        <div class="mb-3">
                            @if(!is_null($data->nilai))
                            <button type="submit" class="btn btn-warning btn-sm btn-block">Update</button>
                            @else
                            <button type="submit" class="btn btn-primary btn-sm btn-block">Simpan</button>
                            @endif
                        </div>

                    </form>
                </div>
                <div class="card-footer">
                    <small class="text-muted">terakhir diupdate {{ $data->updated_at->format('j F Y') }}</small>
                </div>
            </div>
        </div>
        @endforeach

        <nav aria-label="Page navigation example">
            <ul class="pagination pagination-template d-flex justify-content-center">
                {{ $list_siswa->appends(Request::all())->links() }}
            </ul>
        </nav>
    </div>
</div>

@endsection
