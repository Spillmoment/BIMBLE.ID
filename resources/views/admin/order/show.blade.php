<table class="table table-bordered">
    @foreach ($item->pendaftar as $user)

    <tr>
        <th>Nama</th>
        <td>{{ $user->nama_pendaftar }}</td>
    </tr>
    <tr>
        <th>Email</th>
        <td>{{ $user->email }}</td>
    </tr>
    @endforeach

    <tr>
        <th>Tanggal Order</th>
        <td>{{ $item->created_at->format('d -m-Y') }}</td>
    </tr>

    <tr>
        <th>Total Order</th>
        <td>@currency($item->total_tagihan).00</td>
    </tr>

    <tr>
        <th>Bukti Upload</th>
        <td>

            @if ($item->status_kursus == "SUCCESS" || $item->status_kursus == "PENDING")
            <img src="{{ Storage::url('uploads/bukti_pembayaran/'.$item->upload_bukti) }}" class="img-thumbnail"
                width="400px" height="400px">
            <br>

            @else
            <span class="alert alert-warning font-weight-700 col">Bukti upload belum di proses</span>
            @endif

        </td>
    </tr>

    <tr>
        <th>Status Order</th>
        <td><span class="font-weight-bold">{{ $item->status_kursus }}</span></td>
    </tr>
    <tr>

        <th>Pembelian Kursus</th>
        <td>
            <table class="tabble table-bordered w-100">
                <tr>
                    <th>Nama Kursus</th>
                    <th>Biaya Kursus</th>
                    <th>Diskon Kursus</th>
                    <th>Lama Kursus</th>
                </tr>
                @foreach ($detail as $row)
                @foreach ($row->kursus as $crs)
                <tr>
                    <td>{{ $crs->nama_kursus }}</td>
                    <td>@currency($crs->biaya_kursus)</td>
                    <td>{{ $crs->diskon_kursus }}%</td>
                    <td>{{ $crs->lama_kursus }} Hari</td>
                </tr>
                @endforeach
                @endforeach
            </table>
        </td>
    </tr>
</table>
<div class="row">
    <div class="col-4">
        <a href="{{ route('order.status', $item->id) }}?status=SUCCESS" class="btn btn-success btn-block">
            <i class="fa fa-check"></i> Set Sukses
        </a>
    </div>
    <div class="col-4">
        <a href="{{ route('order.status', $item->id) }}?status=FAILED" class="btn btn-warning btn-block">
            <i class="fa fa-times"></i> Set Gagal
        </a>
    </div>
    <div class="col-4">
        <a href="{{ route('order.status', $item->id) }}?status=PENDING" class="btn btn-info btn-block">
            <i class="fa fa-spinner"></i> Set Pending
        </a>
    </div>
</div>
