<div class="card card-lg shadow mt-3">
    <div class="card-header text-dark">
        <h5>
            <strong>Materi {{ $owner->kursus->nama_kursus }}</strong>
        </h5>
        <p>Penyedia kursus : <strong>{{ $owner->unit->nama_unit }}</strong></p>

    </div>
    <div class="card-body">

        @if(!$materi->isEmpty())
        <table class="table table-hover table-striped table-light">
            <thead>
                <tr>
                    <th scope="col" width="30">Modul</th>
                    <th scope="col" width="300">Materi</th>
                    <th scope="col" width="200">File</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($materi as $data)
                <tr>
                    <td class="text-black-50">{{ $data->bab }}</td>
                    <td class="text-black-50">{{ $data->judul }}</td>
                    <td class="text-black-50"><a
                            href="{{ route('materi.download', $data->file) }}">modul_{{ $data->bab }}-{{ $data->judul }}</a>
                    </td>
                </tr>
                @endforeach

            </tbody>
        </table>
        @else
        <table>
            <thead>
                <div class="col">
                    <div class="alert alert-warning col-lg-12 col-sm-12 col-md-12 text-center">
                        Materi mungkin tidak tersedia dalam bentuk <strong>online</strong>. Silahkan hubungi penyedia
                        kursus!
                    </div>
                </div>
            </thead>
        </table>
        @endif

    </div>
</div>
