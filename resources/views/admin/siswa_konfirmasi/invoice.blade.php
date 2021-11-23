<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Invoice Bimble.id</title>
    <link rel="stylesheet" href="{{ asset('assets/backend/css/styleInvoice.css')}}" media="all" />
</head>

<body>
    <header class="clearfix">
        <div id="logo">
            <img style="width: 170px; height: 75px;" src="{{asset('assets/logo/belaNJ-hijau.png')}}">
        </div>
        <h1></h1>
        <div id="project">
            <div><span>Kode Transaksi/Detail Pesanan</span><br>
                {{ $d->kode_transaksi }}/{{ $pengiriman->kode_invoice }}</div>
            <div><span>Diterbitkan atas nama</span></div>
            <div><span>Penjual</span>:{{$d->transaksi_detail[0]->user->nama_lengkap}}
            </div>
            <div><span>Toko</span>:{{$d->transaksi_detail[0]->user->nama_toko}}</div>
            <div><span>Tanggal</span>: {{ \Carbon\Carbon::parse($d->waktu_transaksi)->format('d M, Y') }}</div>
        </div>
        <div id="company">
            <div>Tujuan Pengiriman :<br />{!! $d->to !!}</div>
        </div>
    </header>
    <main>
        <table>
            <thead>
                <tr>
                    <th class="desc">PRODUK</th>
                    <th>JUMLAH</th>
                    <th>BERAT</th>
                    <th>HARGA</th>
                    <th>DISKON</th>
                    <th>SUB TOTAL</th>
                </tr>
            </thead>
            <tbody>
                @foreach($d->transaksi_detail as $de)
                <tr>
                    <td class="desc">
                        <img style="width: 50px; height: 50px; margin: 5px;"
                            src="{{ asset('assets/foto_produk').'/'.$de->produk->foto_produk[0]->foto_produk }}"><br>
                        {{ $de->produk->nama_produk}}</td>
                    <td class="qty">{{ $de->jumlah}}</td>
                    <td class="qty">{{ $de->produk->berat}} gram/{{ $de->produk->satuan}}</td>
                    <td class="total">@currency($de->harga_jual)</td>
                    <td class="total">{{ $de->diskon }}%</td>
                    <td class="total">@currency($de->harga_jual - ($de->diskon / 100 * $de->harga_jual))</td>
                </tr>
                <tr>
                    <td colspan="5" class="grand total">SUBTOTAL HARGA BARANG:</td>
                    <td class="grand total">@currency($de->sub_total)</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <table class="right">
            <tbody>
                <tr>
                    <td colspan="5">SHIPPING:</td>
                </tr>
                <tr>
                    <td colspan="3">{{ $pengiriman->kurir }} - {{ $pengiriman->service }}<br>
                        Etd: {{ $pengiriman->etd }}<br></td>
                    <td>
                        @if($pengiriman->resi != '')
                        Resi: {{ $pengiriman->resi }}
                        @endif</td>
                    <td class="total">Rp. {{$pengiriman->ongkir}}</td>
                </tr>
                <tr>
                    <td colspan="4" class="grand total">SUBTOTAL PEMBAYARAN:</td>
                    <td class="grand total">Rp. {{$d->transaksi_detail->sum('sub_total')}}</td>
                </tr>
            </tbody>
        </table>
        <div id="notices">
            <div>CATATAN:</div>
            <div class="notice">Jika barang tidak sesuai anda bisa langsung menghubungi pelapak atau admin Belanj.id
            </div>
        </div>
    </main>
    <footer>
        Invoice ini dibuat di komputer dan valid tanpa tanda tangan dan meterai.
    </footer>
</body>

</html>
