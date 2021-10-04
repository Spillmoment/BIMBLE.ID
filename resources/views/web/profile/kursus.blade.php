<div class="card card-lg shadow mt-3">
    <div class="card-header text-dark">
        <h5>
            <strong>Daftar Kursus {{ Auth::user()->nama_siswa }} </strong>
        </h5>
    </div>
    <div class="card-body">

        <nav class="mb-2 mt-2">
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <a class="nav-item nav-link active" id="nav-kelas-tab" data-toggle="tab" href="#nav-kelas" role="tab"
                    aria-controls="nav-kelas" aria-selected="true">Kelas saya</a>
                <a class="nav-item nav-link" id="nav-proses-tab" data-toggle="tab" href="#nav-proses" role="tab"
                    aria-controls="nav-proses" aria-selected="false">Proses</a>
            </div>
        </nav>

        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-kelas" role="tabpanel" aria-labelledby="nav-kelas-tab">
                @if(!$kursus_terima->isEmpty())
                <table class="table table-hover table-striped table-light">
                    <thead>
                        <tr>
                            <th scope="col" width="200">Nama Kursus</th>
                            <th scope="col" width="200">Penyedia Kursus</th>
                            <th scope="col" width="200">Materi</th>
                            <th scope="col" width="200">Biaya</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($kursus_terima as $data)
                        <tr>
                            {{-- <td scope="row">{{ $loop->iteration }}</td> --}}
                            <td class="text-black">{{ $data->kursus_unit->kursus->nama_kursus }}</td>
                            <td class="text-black">{{ $data->kursus_unit->unit->nama_unit }}</td>
                            <td class="text-black"><a href="{{ route('user.materi', $data->kursus_unit->id) }}"
                                    class="badge badge-default badge-pill">Buka</a></td>
                            <td class="text-black">@currency($data->kursus_unit->biaya_kursus)</td>
                            <td>
                                @if ($data->status_sertifikat == 'terima')
                                <span class="badge badge-primary badge-pill">Siswa</span>
                                @else
                                <span class="badge badge-success badge-pill">Lulus</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
                @else
                <table>
                    <thead>
                        <div class="alert alert-light col text-center" role="alert">
                            <strong>Kelas anda masih kosong. Silahkan pesan kursus!</strong>
                        </div>
                    </thead>
                </table>
                @endif


            </div>

            <div class="tab-pane fade" id="nav-proses" role="tabpanel" aria-labelledby="nav-proses-tab">
                @if(!$kursus_proses->isEmpty())
                <table class="table table-hover table-striped table-light">
                    <thead>
                        <tr>
                            {{-- <th>#</th> --}}
                            <th scope="col" width="200">Nama Kursus</th>
                            <th scope="col" width="200">Penyedia Kursus</th>
                            <th scope="col" width="200">Biaya</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($kursus_proses as $data)
                        <tr>
                            {{-- <td scope="row">{{ $loop->iteration }}</td> --}}
                            <td class="text-black">{{ $data->kursus_unit->kursus->nama_kursus }}</td>
                            <td class="text-black">{{ $data->kursus_unit->unit->nama_unit }}</td>
                            <td class="text-black">@currency($data->kursus_unit->biaya_kursus).00</td>
                            <td>
                                <span class="badge badge-warning badge-pill">Menunggu konfirmasi</span> <br>
                                <small class="text-danger">Silahkan langsung mendatangi pengelola unit kursus! </small>
                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
                @else
                <table>
                    <thead>
                        <div class="alert alert-light col text-center" role="alert">
                            <strong>Tidak ada aktivitas pemesanan kursus.</strong>
                        </div>
                    </thead>
                </table>
                @endif
            </div>
        </div>


    </div>
</div>
