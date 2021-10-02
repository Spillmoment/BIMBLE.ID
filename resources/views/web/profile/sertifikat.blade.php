<div class="card card-lg">
  <div class="card-body">

      <div class="card-header">
          <div class="alert alert-light text-dark" role="alert">
             <h5>
                 <strong>Sertifikat Kursus</strong>
              </h5> 
          </div>
  </div>

  @if(!$kursus_lulus->isEmpty())
  <table class="table table-hover table-striped table-light">
      <thead>
          <tr>
              {{-- <th>#</th> --}}
              <th scope="col" width="30">Nama Kursus</th>
              <th scope="col" width="200">Penyedia Kursus</th>
              <th scope="col" width="30">Nilai</th>
              <th scope="col" width="200">Kirim File</th>
          </tr>
      </thead>
      <tbody>
          
          @foreach ($kursus_lulus as $data)
          <tr>
              {{-- <td scope="row">{{ $loop->iteration }}</td> --}}
              <td class="text-black-50">{{ $data->kursus_unit->kursus->nama_kursus }}</td>
              <td class="text-black-50">{{ $data->kursus_unit->unit->nama_unit }}</td>
              <td class="text-black-50">{{ $data->nilai }}</td>
              <td>
                @if ($data->sertifikat != null)
                  <a href="{{ route('sertifikat.download', $data->sertifikat) }}" class="btn btn-primary btn-sm "> <i class="fas fa-download"></i> Download </a>
                @else
                  @if ($data->file == null)
                    <form action="{{ route('sertifikat.update', $data->id) }}" method="post" enctype="multipart/form-data">
                      @csrf
                      @method('put')
                      <div class="row">
                        <div class="col">
                          <input type="file" name="file" class="form-control">
                        </div>
                        <div class="col">
                          <button type="submit" class="btn btn-primary">Kirim</button>
                        </div>
                      </div>
                    </form>
                  @else
                    <p>Sertifikat masih dalam prosess.</p>
                    <p>Dengan bukti pembayaran :</p>
                    <img src="{{ asset('storage/pembayaran/'.$data->file) }}" height="150px" alt="" title="">
                  @endif
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
              <strong>Mungkin anda belum menyelesaikan satu kursus. Silahkan melanjutkan belajar!</strong>
          </div>
      </thead>
  </table>                
  @endif

</div>
</div>