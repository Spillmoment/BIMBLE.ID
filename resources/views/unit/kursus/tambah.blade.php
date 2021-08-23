@extends('admin.layouts.tutor')

@section('title','Unit - Tambah Kursus')
@section('content')

@push('after-style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.2/switchery.min.css">
<link href="{{ asset('assets/js/picker/mdtimepicker.css') }}" rel="stylesheet">
@endpush

<div class="breadcrumbs">
    <div class="breadcrumbs-inner">
        <div class="row m-0">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Data Kursus </h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="{{ route('unit.kursus.home') }}">Kursus</a></li>
                            <li class="active">Pengaturan kursus {{ $kursus_unit_kelompok->kursus->nama_kursus }}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

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

<div class="content">
    {{-- <div class="card">
        <div class="card-header">
            <strong>Pengaturan Detail Kursus {{ $kursus_unit->kursus->nama_kursus }}</strong>
        </div>
        <div class="card-body card-block">
            <form action="{{ route('unit.kursus.update', $kursus_unit->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-6">
                        
                        <div class="form-group">
                            <label for="">Type Kursus</label>

                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input" checked>
                                    {{ $kursus_unit->type_id == 1 ? 'Private' : 'Kelompok' }}
                                </label>
                            </div>

                        </div>
                        
                        <div class="form-group">
                            <label for="">Status</label>

                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="checkbox" name="status" class="js-switch" {{ $kursus_unit->status == 'aktif' ? 'checked' : '' }}>
                                    
                                </label>
                            </div>

                        </div>


                        <div class="form-group">
                            <label for="">Hari Kursus</label>
                            @if ($kursus_unit->type_id == 1)
                            <p class="text-danger">Jadwal tidak tersedia untuk kelas Private</p>
                            @else
                            <select name="hari" class="form-control">
                                @if (!empty($jadwal->hari))
                                @php
                                    $list_hari = array('none','Senin','Selasa','Rabu','Kamis','Jum\'at','Sabtu','Minggu');
                                @endphp
                                <option value="{{ $jadwal->hari }}">{{ $list_hari[$jadwal->hari] }}</option>
                                @else
                                <option value=""></option>
                                @endif
                                <option value="1">Senin</option>
                                <option value="2">Selasa</option>
                                <option value="3">Rabu</option>
                                <option value="4">Kamis</option>
                                <option value="5">Jum'at</option>
                                <option value="6">Sabtu</option>
                                <option value="7">Minggu</option>
                            </select>
                                
                            @endif
                            <div class="invalid-feedback">
                                {{$errors->first('hari')}}
                            </div>
                        </div>

                        <div class="row">
                            @if ($kursus_unit->type_id == 1)
                                
                            @else
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="awal">Jam Awal</label>
                                    @if ($jadwal)
                                    <input type="text" id="timepicker1" name="waktu_mulai" class="form-control" value="{{ $jadwal->waktu_mulai }}">
                                    @else
                                    <input type="text" id="timepicker1" name="waktu_mulai" class="form-control">
                                    @endif
                                    <div class="invalid-feedback">
                                        {{$errors->first('waktu_mulai')}}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="akhir">Jam Akhir</label>
                                    @if ($jadwal)
                                    <input type="text" id="timepicker2" name="waktu_selesai" class="form-control" value="{{ $jadwal->waktu_selesai }}">
                                    @else
                                    <input type="text" id="timepicker2" name="waktu_selesai" class="form-control">
                                    @endif
                                    <div class="invalid-feedback">
                                        {{$errors->first('waktu_selesai')}}
                                    </div>
                                </div>
                            </div>
                            
                            @endif
                        </div>


                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Harga Kursus</label>
                            <input type="number" id="biaya_kursus" name="biaya_kursus"
                                class="input-sm form-control-sm form-control"
                                value="{{ $kursus_unit->biaya_kursus != 0 ? $kursus_unit->biaya_kursus : 0 }}">
                            <div class="invalid-feedback">
                                {{$errors->first('biaya_kursus')}}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <button class="btn btn-primary btn-block" type="submit">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div> --}}

    <div class="row">
        <div class="col-lg">
            <div class="card">
                <div class="card-header">
                    <h4>Centered Tabs and Pills</h4>
                </div>
                <div class="card-body">
                    <p class="text-muted m-b-15">To center/justify the tabs and pills, use the <code>.nav-justified</code> class.</p>

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
                                    {{-- <div class="form-group">
                                        <label for="">Hari Kursus</label>
                                        <select name="hari" class="form-control">
                                            @if (!empty($jadwal->hari))
                                            @php
                                                $list_hari = array('none','Senin','Selasa','Rabu','Kamis','Jum\'at','Sabtu','Minggu');
                                            @endphp
                                            <option value="{{ $jadwal->hari }}">{{ $list_hari[$jadwal->hari] }}</option>
                                            @else
                                            <option value=""></option>
                                            @endif
                                            <option value="1">Senin</option>
                                            <option value="2">Selasa</option>
                                            <option value="3">Rabu</option>
                                            <option value="4">Kamis</option>
                                            <option value="5">Jum'at</option>
                                            <option value="6">Sabtu</option>
                                            <option value="7">Minggu</option>
                                        </select>
                                            
                                        <div class="invalid-feedback">
                                            {{$errors->first('hari')}}
                                        </div>
                                    </div>
            
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="awal">Jam Awal</label>
                                                @if ($jadwal)
                                                <input type="text" id="timepicker1" name="waktu_mulai" class="form-control" value="{{ $jadwal->waktu_mulai }}">
                                                @else
                                                <input type="text" id="timepicker1" name="waktu_mulai" class="form-control">
                                                @endif
                                                <div class="invalid-feedback">
                                                    {{$errors->first('waktu_mulai')}}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="akhir">Jam Akhir</label>
                                                @if ($jadwal)
                                                <input type="text" id="timepicker2" name="waktu_selesai" class="form-control" value="{{ $jadwal->waktu_selesai }}">
                                                @else
                                                <input type="text" id="timepicker2" name="waktu_selesai" class="form-control">
                                                @endif
                                                <div class="invalid-feedback">
                                                    {{$errors->first('waktu_selesai')}}
                                                </div>
                                            </div>
                                        </div>                                        
                                    </div> --}}
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
        </div>
    </div>

</div>
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
