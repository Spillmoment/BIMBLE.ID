<div class="card card-lg">
    <div class="card-body">

        <div class="card-header">
            <div class="alert alert-light text-dark" role="alert">
               <h5>
                   <strong>Kursus {{ Auth::user()->nama_pendaftar }} </strong>
                   </h5> 
            </div>
    </div>

 

    <nav class="mb-3 mt-2">
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
          <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Proses</a>
          <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Pending</a>
          <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Sukses</a>
        </div>
      </nav>

      <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">   
            
            <table class="table table-hover table-striped table-light">
                <thead>
                <tr>
                    <th>#</th>
                    <th scope="col" width="200">Nama Kursus</th>
                    <th scope="col" width="200">Gambar Kursus</th>
                    <th scope="col" width="200">Mentor</th>
                    <th  scope="col" width="200">Biaya</th>
                    <th>Status</th>
                </tr>
             </thead>
             <tbody>
                 
                @php $i = 1; @endphp
                @forelse ($process as $item)
                @foreach ($item->kursus as $cours)
                <tr>
                    <td scope="row">{{ $i++ }}</td>
                    <td><img src="{{ Storage::url('public/' . $cours->gambar_kursus) }}" class="img-fluid img-thumbnail" width="200px" height="200px"></td>
                    <td>{{ $cours->nama_kursus }}</td>
                    <td>{{ $cours->tutor->first()->nama_tutor }}</td>
                    <td>@currency($item->biaya_kursus).00</td>
                    <td><span class="badge badge-secondary badge-pill">Masih Diproses</span></td>
                </tr>
                @endforeach
                @empty
                <table>
                    <thead>
                     <div class="alert alert-light col text-center" role="alert">
                         <strong>Data kursus proses kosong</strong>
                      </div>
                    </thead>
                </table>
                @endforelse
                
            </tbody>
        </table>

        </div>
        <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
            <table class="table table-hover table-striped table-light">
                <thead>
                    <tr>
                        <th>#</th>
                        <th scope="col" width="200">Nama Kursus</th>
                        <th scope="col" width="200">Gambar Kursus</th>
                        <th scope="col" width="200">Mentor</th>
                        <th scope="col" width="200">Biaya</th>
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>
                   
                    @php $i = 1; @endphp
                    @forelse ($pending as $item)
                    @foreach ($item->kursus as $cours)
                    <tr>
                        <td scope="row"> {{ $i++ }}</td>
                        <td>{{ $cours->nama_kursus }}</td>
                        <td>
                            <img src="{{ Storage::url('public/' . $cours->gambar_kursus) }}" class="img-fluid img-thumbnail" width="200px" height="200px">
                        </td>
                        <td>{{ $cours->tutor->first()->nama_tutor }}</td>
                        <td>@currency($item->biaya_kursus).00</td>
                        <td><span class="badge badge-warning badge-pill text-light ">Menunggu Konfirmasi</span></td>
                    </tr>
                    @endforeach
                  
                    @empty
                    <table>
                        <thead>
                         <div class="alert alert-light col text-center" role="alert">
                             <strong>Data kursus pending kosong</strong>
                          </div>
                        </thead>
                    </table>
                    @endforelse
                    
                </tbody>
            </table>
        </div>
        <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
            <table class="table table-hover table-striped table-light">
                <thead>
                    <tr>
                        <th>#</th>
                        <th scope="col" width="200">Nama Kursus</th>
                        <th scope="col" width="200">Gambar Kursus</th>
                        <th scope="col" width="200">Mentor</th>
                        <th scope="col" width="200">Biaya</th>
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>
                    
                    @php $i = 1; @endphp
                    @forelse ($success as $item)
                    @foreach ($item->kursus as $cours)
                    <tr>
                        <td scope="row">{{ $i++ }}</td>
                        <td><img src="{{ Storage::url('public/' . $cours->gambar_kursus) }}" class="img-fluid img-thumbnail" width="200px" height="200px"></td>
                        <td>{{ $cours->nama_kursus }}</td>
                        <td>{{ $cours->tutor->first()->nama_tutor }}</td>
                        <td>@currency($item->biaya_kursus).00</td>
                        <td><span class="badge badge-success badge-pill">Aktif</span></td>
                    </tr>

                    @endforeach
                    @empty
                   <table>
                       <thead>
                        <div class="alert alert-light col text-center" role="alert">
                            <strong>Data kursus sukses kosong</strong>
                         </div>
                       </thead>
                   </table>
                    @endforelse
                    
                </tbody>
            </table>
            
        </div>
      </div>

 
</div>
</div>