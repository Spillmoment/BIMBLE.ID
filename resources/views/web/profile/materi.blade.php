<div class="card card-lg">
    <div class="card-body">

        <div class="card-header">
            <div class="alert alert-light text-dark" role="alert">
               <h5>
                   <strong>Materi {{ $owner->kursus->nama_kursus }}</strong>
                </h5> 
                <p>Penyedia kursus : <span class="text-black-50">{{ $owner->unit->nama_unit }}</span></p>
            </div>
    </div>

    @if(!$materi->isEmpty())
    <table class="table table-hover table-striped table-light">
        <thead>
            <tr>
                {{-- <th>#</th> --}}
                <th scope="col" width="50">BAB</th>
                <th scope="col" width="300">Materi</th>
                <th scope="col" width="100">File</th>
            </tr>
        </thead>
        <tbody>
            
            @foreach ($materi as $data)
            <tr>
                {{-- <td scope="row">{{ $loop->iteration }}</td> --}}
                <td class="text-black-50">{{ $data->bab }}</td>
                <td class="text-black-50">{{ $data->judul }}</td>
                <td class="text-black-50">{{ $data->file }}</td>
            </tr>
            @endforeach
            
        </tbody>
    </table>
    @else
    <table>
        <thead>
            <div class="alert alert-light col text-center" role="alert">
                <strong>Materi mungkin tidak tersedia dalam bentuk online. Silahkan hubungi penyedia kursus!</strong>
            </div>
        </thead>
    </table>                
    @endif
 
</div>
</div>