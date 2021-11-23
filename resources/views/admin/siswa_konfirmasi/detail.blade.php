@extends('admin.layouts.app-manager')

@section('title', 'Admin - Detail Halaman Konfirmasi Siswa')

@section('content')

@if (session('invalid'))
@push('scripts')
<script>
    swal({
        title: "Berhasil",
        text: "{{ session('invalid') }}",
        icon: "success",
        button: false,
        timer: 3000
    });

</script>
@endpush
@endif

@if (session('message_null'))
@push('scripts')
<script>
    swal({
        title: "Peringatan",
        text: "{{ session('message_null') }}",
        icon: "warning",
        button: false,
        timer: 3000
    });

</script>
@endpush
@endif

<div class="row">
    <div class="col-12 mb-4">

        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-4 pb-3">
            <div class="d-block mb-4 mb-md-0">
                <nav aria-label="breadcrumb" class="d-none d-md-inline-block">
                    <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
                        <li class="breadcrumb-item"><a href="#"><span class="fas fa-home"></span></a></li>
                        <li class="breadcrumb-item"><a href="{{ route('siswa.unit') }}">Kursus</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('siswa-konfirmasi.index') }}">Halaman Konfirmasi Siswa</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Detail Transaksi</li>
                    </ol>
                </nav>
            </div>

        </div>
        
      </div>
      {{-- <div class="card border-light shadow-sm components-section mt-3"> --}}
        <div class="row justify-content-md-center">
          <div class="col-8 col-lg-6">
              <div class="card border-0 shadow">
                  <div class="card-header border-bottom d-flex align-items-center justify-content-between">
                      <h5 class="fs-5 fw-bold mb-0">Detail Transaksi</h5>
                      <span>{{ $data->created_at->format('d M Y') }}</span>
                  </div>
                  <div class="card-body">
                      <div class="row mt-2 mb-1 align-items-center">
                        <div class="col-sm-3">Nama</div>
                        <div class="col-sm-9 fs-6 text-secondary">{{ $data->siswa->nama_siswa }}</div>
                      </div>
                      <div class="row mt-2 mb-1 align-items-center">
                        <div class="col-sm-3">Alamat</div>
                        <div class="col-sm-9 fs-6 text-secondary">
                          {{ substr($data->siswa->alamat_province, strpos($data->siswa->alamat_province, ".") + 1) }} - 
                          {{ substr($data->siswa->alamat_district, strpos($data->siswa->alamat_district, ".") + 1) }} - 
                          {{ substr($data->siswa->alamat_sub_district, strpos($data->siswa->alamat_sub_district, ".") + 1) }} -
                          {{ substr($data->siswa->alamat_village, strpos($data->siswa->alamat_village, ".") + 1) }}
                        </div>
                      </div>
                      <div class="row mt-2 mb-1 align-items-center">
                        <div class="col-sm-3">Email</div>
                        <div class="col-sm-9 fs-6 text-secondary">{{ $data->siswa->email }}</div>
                      </div>
                      <div class="row mt-2 mb-1 align-items-center">
                        <div class="col-sm-3">No. Telepon</div>
                        <div class="col-sm-9 fs-6 text-secondary">{{ $data->siswa->no_telp }}</div>
                      </div>

                      <div class="d-flex align-items-center justify-content-between border-bottom py-3">
                      </div>

                      <div class="row mt-2 mb-1 align-items-center">
                        <div class="col-sm-3">Penyedia Kursus</div>
                        <div class="col-sm-9 fs-6 text-secondary">{{ $data->kursus_unit->unit->nama_unit }}</div>
                      </div>
                      <div class="row mt-2 mb-1 align-items-center">
                        <div class="col-sm-3">Kursus</div>
                        <div class="col-sm-9 fs-6 text-secondary">{{ $data->kursus_unit->kursus->nama_kursus }}</div>
                      </div>
                      <div class="row mt-2 mb-1 align-items-center">
                        <div class="col-sm-3">Type</div>
                        <div class="col-sm-9 fs-6 text-secondary">{{ $data->kursus_unit->type->nama_type }}</div>
                      </div>
                      <div class="row mt-2 mb-1 align-items-center">
                        <div class="col-sm-3">Biaya</div>
                        <div class="col-sm-9 fs-6 text-secondary">@currency($data->kursus_unit->biaya_kursus)</div>
                      </div>
                      <div class="row mt-2 mb-1 align-items-center">
                        <div class="col-sm-3">Percent Admin</div>
                        <div class="col-sm-9 fs-6 text-secondary">{{ $rule_gaji->lppk }}%</div>
                      </div>
                      <div class="row mt-2 mb-1 align-items-center">
                        <div class="col-sm-3">Percent Unit</div>
                        <div class="col-sm-9 fs-6 text-secondary">{{ $rule_gaji->unit }}%</div>
                      </div>

                      <div class="d-flex align-items-center justify-content-between border-bottom py-3">
                      </div>
                      <div class="align-items-center justify-content-between">
                        <h6 class="ml-0 mt-3">Detail Transaksi</h6>
                      </div>

                      <div class="row mt-3 mb-1 align-items-center">
                        <div class="col-sm-12"><img src="{{ url('/assets/images/bukti-siswa/'.$data->file) }}" alt=""></div>
                      </div>

                      <form action="{{ route('siswa-konfirmasi.confirm', $data->id) }}" method="post">
                        @csrf
                        @method('put')
                        <button class="btn w-100 btn-success mt-2" type="submit">Konfirmasi</button>
                      </form>

                      <div class="mt-3 mb-4 text-center">
                        <span class="font-weight-bold">Atau kirim pesan kesalahan</span>
                      </div>
                      
                      <div class="text-center">
                        <form action="{{ route('siswa-konfirmasi.invalid', $data->id) }}" method="post">
                          @csrf
                          @method('put')
                          <textarea class="form-control" name="invalid_message" placeholder="{{ is_null($data->invalid_message) ? 'Ketik pesan anda...' : $data->invalid_message }}" rows="4"></textarea>
                          <button class="btn w-100 btn-secondary text-dark mt-2" type="submit">Kirim</button>
                        </form>
                      </div>

                      

                  </div>
              </div>
          </div>
        </div>  

      {{-- </div> --}}
</div>

@endsection
@push('scripts')
@endpush
