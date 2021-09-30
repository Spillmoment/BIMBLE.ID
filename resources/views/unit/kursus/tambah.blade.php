@extends('unit.layouts.app')

@section('title', 'Unit - Tambah Detail Kursus')

@section('content')

@push('style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.2/switchery.min.css">
<link href="{{ asset('assets/js/picker/mdtimepicker.css') }}" rel="stylesheet">
@endpush


<div class="row my-3">
    <div class="col-sm-12">

        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center py-4">
            <div class="d-block mb-4 mb-md-0">
                <nav aria-label="breadcrumb" class="d-none d-md-inline-block">
                    <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
                        <li class="breadcrumb-item"><a href="#"><span class="fas fa-home"></span></a></li>
                        <li class="breadcrumb-item"><a href="#">Kursus</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Unit Pengelola Kursus</li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="card border-light shadow-sm components-section">
            <div class="card-header">
                <h4>Form Pengaturan Kursus Kelompok & Private</h4>
            </div>
            <div class="card-body">
                
                <ul class="nav nav-pills nav-fill mb-3" id="pills-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-kelompok" role="tab" aria-controls="pills-kelompok" aria-selected="true">Kelompok</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-private" role="tab" aria-controls="pills-private" aria-selected="false">Private</a>
                    </li>
                </ul>
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-kelompok" role="tabpanel" aria-labelledby="pills-kelompok-tab">
                        <div class="row">
                            <div class="col-md-4">
                                <form action="{{ route('unit.kursus.update.harga', $kursus_unit_kelompok->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                    
                                    <div class="row">
                                        <div class="col-md-6">
                                            
                                            <div class="form-group">
                                                <label for="">Status</label>
                    
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" name="status" class="js-switch" {{ $kursus_unit_kelompok->status == 'aktif' ? 'checked' : '' }}>
                                                        
                                                    </label>
                                                </div>
                    
                                            </div>
                                            
                                        </div>
                                    </div>
                    
                                    <div class="row">
                                        <div class="col-md">
                                            <div class="form-group">
                                                <label for="">Harga Kursus</label>
                                                <input type="number" id="biaya_kursus" name="biaya_kursus"
                                                    class="input-sm form-control-sm form-control"
                                                    value="{{ $kursus_unit_kelompok->biaya_kursus != 0 ? $kursus_unit_kelompok->biaya_kursus : 0 }}">
                                                <div class="invalid-feedback">
                                                    {{$errors->first('biaya_kursus')}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                    
                                    <div class="form-group">
                                        <button class="btn btn-primary" type="submit">
                                            Simpan
                                        </button>
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-8">
                                    <form action="{{ route('unit.kursus.update', $kursus_unit_kelompok->id) }}" method="post" class="form-horizontal">
                                        @csrf
                                        @method('put')
                                        <div class="row form-group">
                                            <div class="col-md-2 text-center"><label class=" form-control-label">Senin</label> <input type="hidden" name="hari" value="1"></div>
                                            @if ($senin)
                                            <div class="col-md-3"><input type="text" name="waktu_mulai" value="{{ $senin->waktu_mulai }}" class="form-control timepicker1"></div>
                                            <div class="col-md-3"><input type="text" name="waktu_selesai" value="{{ $senin->waktu_selesai }}" class="form-control timepicker1"></div>
                                            
                                            @else
                                            <div class="col-md-3"><input type="text" name="waktu_mulai" class="form-control timepicker1"></div>
                                            <div class="col-md-3"><input type="text" name="waktu_selesai" class="form-control timepicker1"></div>
                                                
                                            @endif
                                            <div class="col-md-3"><button type="submit" class="btn btn-primary">set</button></div>
                                        </div>
                                    </form>
                                    
                                    <form action="{{ route('unit.kursus.update', $kursus_unit_kelompok->id) }}" method="post" class="form-horizontal">
                                        @csrf
                                        @method('put')
                                        <div class="row form-group">
                                            <div class="col-md-2 text-center"><label class=" form-control-label">Selasa</label> <input type="hidden" name="hari" value="2"></div>
                                            @if ($selasa)
                                            <div class="col-md-3"><input type="text" name="waktu_mulai" value="{{ $selasa->waktu_mulai }}" class="form-control timepicker1"></div>
                                            <div class="col-md-3"><input type="text" name="waktu_selesai" value="{{ $selasa->waktu_selesai }}" class="form-control timepicker1"></div>
                                            
                                            @else
                                            <div class="col-md-3"><input type="text" name="waktu_mulai" class="form-control timepicker1"></div>
                                            <div class="col-md-3"><input type="text" name="waktu_selesai" class="form-control timepicker1"></div>
                                                
                                            @endif
                                            <div class="col-md-3"><button type="submit" class="btn btn-primary">set</button></div>
                                        </div>
                                    </form>
                                    
                                    <form action="{{ route('unit.kursus.update', $kursus_unit_kelompok->id) }}" method="post" class="form-horizontal">
                                        @csrf
                                        @method('put')
                                        <div class="row form-group">
                                            <div class="col-md-2 text-center"><label class=" form-control-label">Rabu</label> <input type="hidden" name="hari" value="3"></div>
                                            @if ($rabu)
                                            <div class="col-md-3"><input type="text" name="waktu_mulai" value="{{ $rabu->waktu_mulai }}" class="form-control timepicker1"></div>
                                            <div class="col-md-3"><input type="text" name="waktu_selesai" value="{{ $rabu->waktu_selesai }}" class="form-control timepicker1"></div>
                                            
                                            @else
                                            <div class="col-md-3"><input type="text" name="waktu_mulai" class="form-control timepicker1"></div>
                                            <div class="col-md-3"><input type="text" name="waktu_selesai" class="form-control timepicker1"></div>
                                                
                                            @endif
                                            <div class="col-md-3"><button type="submit" class="btn btn-primary">set</button></div>
                                        </div>
                                    </form>
                                    
                                    <form action="{{ route('unit.kursus.update', $kursus_unit_kelompok->id) }}" method="post" class="form-horizontal">
                                        @csrf
                                        @method('put')
                                        <div class="row form-group">
                                            <div class="col-md-2 text-center"><label class=" form-control-label">Kamis</label> <input type="hidden" name="hari" value="4"></div>
                                            @if ($kamis)
                                            <div class="col-md-3"><input type="text" name="waktu_mulai" value="{{ $kamis->waktu_mulai }}" class="form-control timepicker1"></div>
                                            <div class="col-md-3"><input type="text" name="waktu_selesai" value="{{ $kamis->waktu_selesai }}" class="form-control timepicker1"></div>
                                            
                                            @else
                                            <div class="col-md-3"><input type="text" name="waktu_mulai" class="form-control timepicker1"></div>
                                            <div class="col-md-3"><input type="text" name="waktu_selesai" class="form-control timepicker1"></div>
                                                
                                            @endif
                                            <div class="col-md-3"><button type="submit" class="btn btn-primary">set</button></div>
                                        </div>
                                    </form>
                                    
                                    <form action="{{ route('unit.kursus.update', $kursus_unit_kelompok->id) }}" method="post" class="form-horizontal">
                                        @csrf
                                        @method('put')
                                        <div class="row form-group">
                                            <div class="col-md-2 text-center"><label class=" form-control-label">Jum'at</label> <input type="hidden" name="hari" value="5"></div>
                                            @if ($jumat)
                                            <div class="col-md-3"><input type="text" name="waktu_mulai" value="{{ $jumat->waktu_mulai }}" class="form-control timepicker1"></div>
                                            <div class="col-md-3"><input type="text" name="waktu_selesai" value="{{ $jumat->waktu_selesai }}" class="form-control timepicker1"></div>
                                            
                                            @else
                                            <div class="col-md-3"><input type="text" name="waktu_mulai" class="form-control timepicker1"></div>
                                            <div class="col-md-3"><input type="text" name="waktu_selesai" class="form-control timepicker1"></div>
                                                
                                            @endif
                                            <div class="col-md-3"><button type="submit" class="btn btn-primary">set</button></div>
                                        </div>
                                    </form>
                                    
                                    <form action="{{ route('unit.kursus.update', $kursus_unit_kelompok->id) }}" method="post" class="form-horizontal">
                                        @csrf
                                        @method('put')
                                        <div class="row form-group">
                                            <div class="col-md-2 text-center"><label class=" form-control-label">Sabtu</label> <input type="hidden" name="hari" value="6"></div>
                                            @if ($sabtu)
                                            <div class="col-md-3"><input type="text" name="waktu_mulai" value="{{ $sabtu->waktu_mulai }}" class="form-control timepicker1"></div>
                                            <div class="col-md-3"><input type="text" name="waktu_selesai" value="{{ $sabtu->waktu_selesai }}" class="form-control timepicker1"></div>
                                            
                                            @else
                                            <div class="col-md-3"><input type="text" name="waktu_mulai" class="form-control timepicker1"></div>
                                            <div class="col-md-3"><input type="text" name="waktu_selesai" class="form-control timepicker1"></div>
                                                
                                            @endif
                                            <div class="col-md-3"><button type="submit" class="btn btn-primary">set</button></div>
                                        </div>
                                    </form>
                                    
                                    <form action="{{ route('unit.kursus.update', $kursus_unit_kelompok->id) }}" method="post" class="form-horizontal">
                                        @csrf
                                        @method('put')
                                        <div class="row form-group">
                                            <div class="col-md-2 text-center"><label class=" form-control-label">Minggu</label> <input type="hidden" name="hari" value="7"></div>
                                            @if ($minggu)
                                            <div class="col-md-3"><input type="text" name="waktu_mulai" value="{{ $minggu->waktu_mulai }}" class="form-control timepicker1"></div>
                                            <div class="col-md-3"><input type="text" name="waktu_selesai" value="{{ $minggu->waktu_selesai }}" class="form-control timepicker1"></div>
                                            
                                            @else
                                            <div class="col-md-3"><input type="text" name="waktu_mulai" class="form-control timepicker1"></div>
                                            <div class="col-md-3"><input type="text" name="waktu_selesai" class="form-control timepicker1"></div>
                                                
                                            @endif
                                            <div class="col-md-3"><button type="submit" class="btn btn-primary">set</button></div>
                                        </div>
                                    </form>
                                    
                            </div>
                        </div>
                        
                     </div>
                    <div class="tab-pane fade" id="pills-private" role="tabpanel" aria-labelledby="pills-private-tab">
                        <div class="row justify-content-end">
                            <div class="col-md-4">
                                <form action="{{ route('unit.kursus.update.harga', $kursus_unit_private->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                    
                                    <div class="row">
                                        <div class="col-md-6">
                                            
                                            <div class="form-group">
                                                <label for="">Status</label>
                    
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" name="status" class="js-switch" {{ $kursus_unit_private->status == 'aktif' ? 'checked' : '' }}>
                                                        
                                                    </label>
                                                </div>
                    
                                            </div>
                                            
                                        </div>
                                    </div>
                    
                                    <div class="row">
                                        <div class="col-md">
                                            <div class="form-group">
                                                <label for="">Harga Kursus</label>
                                                <input type="number" id="biaya_kursus" name="biaya_kursus"
                                                    class="input-sm form-control-sm form-control"
                                                    value="{{ $kursus_unit_private->biaya_kursus != 0 ? $kursus_unit_private->biaya_kursus : 0 }}">
                                                <div class="invalid-feedback">
                                                    {{$errors->first('biaya_kursus')}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                    
                                    <div class="form-group">
                                        <button class="btn btn-primary" type="submit">
                                            Simpan
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h4>Materi kursus {{ $kursus->nama_kursus }}</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('unit.kursus.materi', $kursus->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-2">
                            <label for="bab">BAB</label>
                            <select name="bab" id="bab" class="form-control { $errors->first('bab') ? 'is-invalid' : '' }}">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                            </select>
                            <div class="invalid-feedback">
                                {{$errors->first('bab')}}
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="judul">Judul</label>
                            <input type="judul" name="judul" id="judul" class="form-control { $errors->first('judul') ? 'is-invalid' : '' }}" value="{{ old('judul') }}">
                            <div class="invalid-feedback">
                                {{$errors->first('judul')}}
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="file">File</label>
                            <input type="file" name="file" id="file" class="form-control { $errors->first('file') ? 'is-invalid' : '' }}">
                            <div class="invalid-feedback">
                                {{$errors->first('file')}}
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </div>
                </form>

                @if (!$materi->isEmpty())
                <table class="table table-stripped">
                    <thead>
                        <tr>
                            <th>BAB</th>
                            <th>Judul Materi</th>
                            <th>File</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                            @foreach ($materi as $data)
                            <tr>
                                <td>{{ $data->bab }}</td>
                                <td>{{ $data->judul }}</td>
                                <td><a href="{{ route('materi.download', $data->file) }}">{{ $data->file }}</a></td>
                                <td>
                                    <form action="{{ route('unit.kursus.materi.delete', $data->id) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                    </tbody>
                </table>
                @endif
            </div>
        </div>
  
    </div>

   
    </div>

     

      <nav aria-label="Page navigation example">
        <ul class="pagination pagination-template d-flex ">
            {{ $kursus_unit->appends(Request::all())->links() }}
        </ul>
    </nav>

@endsection
@push('after-script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.2/switchery.min.js"></script>
<script src="{{ asset('assets/js/picker/mdtimepicker.js') }}"></script>
<script>
    let elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
    elems.forEach(function (html) {
        let switchery = new Switchery(html, {
            size: 'small'
        });
    }); 
</script>
<script>
    $(document).ready(function () {

        $('.timepicker1').mdtimepicker({

            // format of the time value (data-time attribute)
            timeFormat: 'hh:mm:ss.000',

            // format of the input value
            format: 'h:mm tt',

            // theme of the timepicker
            // 'red', 'purple', 'indigo', 'teal', 'green', 'dark'
            theme: 'blue',

            // determines if input is readonly
            readOnly: true,

            // determines if display value has zero padding for hour value less than 10 (i.e. 05:30 PM); 24-hour format has padding by default
            hourPadding: false,

            // determines if clear button is visible  
            clearBtn: false

        });
    });

</script>
@endpush
