<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Kursus;
use App\Order;
use App\Tutor;
use App\OrderDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class OrderController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function orderPost($slug)
    {
        $kursus = Kursus::where('slug', $slug)->first();

        $pendaftarId = Auth::id();

        $harga_kursus = $kursus->biaya_kursus;
        $diskon_kursus = $kursus->diskon_kursus;
        $diskon = $harga_kursus * ($diskon_kursus / 100);

        $check_order = Order::where('id_pendaftar', $pendaftarId)
            ->where('status_kursus', 'PROCESS')
            ->count();


        if ($check_order == 0) {
            $order = Order::create([
                'id_pendaftar'  => $pendaftarId,
                'total_tagihan' => $kursus->biaya_kursus - $diskon,
                'status_kursus' => 'PROCESS',
                'tgl_order'     => Carbon::now()
            ]);
            $orderId = $order->id;
        } else {
            $orderId = Order::where('id_pendaftar', $pendaftarId)
                ->where('status_kursus', 'PROCESS')
                ->first()
                ->id;
            Order::where('id', $orderId)->increment('total_tagihan', $kursus->biaya_kursus - $diskon);
        }

        OrderDetail::create([
            'id_order' => $orderId,
            'id_pendaftar' => $pendaftarId,
            'id_kursus' => $kursus->id,
            'biaya_kursus' => $kursus->biaya_kursus - $diskon,
            'status' => 'PROCESS',
        ]);

        // kursus success
        $order_k = OrderDetail::with('kursus')
            ->where('id_pendaftar', $pendaftarId)
            ->orderBy('created_at', 'desc')
            ->take(1)
            ->get();

        return redirect()->route('order.success')->with([
            'order' => $order_k
        ]);
    }

    public function view()
    {
        $pendaftarId = Auth::id();

        $order_kursus = OrderDetail::with(['pendaftar', 'kursus'])
            ->where('id_pendaftar', $pendaftarId)
            ->where(function ($query) {
                $query->where('status', 'PROCESS')
                    ->orWhere('status', 'CANCEL');
            })
            ->withCount('kursus')
            ->orderBy('created_at', 'DESC')
            ->paginate(6);

        $total_tagihan = OrderDetail::where('id_pendaftar', $pendaftarId)
            ->where('status', 'PROCESS')
            ->sum('biaya_kursus');

        $order = Order::where('id_pendaftar', $pendaftarId)
            ->where(function ($query) {
                $query->where('status_kursus', 'PENDING')
                    ->orWhere('status_kursus', 'FAILED');
            })
            ->get();

        $order_status = Order::where('id_pendaftar', $pendaftarId)
            ->where(function ($query) {
                $query->where('status_kursus', 'PENDING')
                    ->orWhere('status_kursus', 'FAILED');
            })
            ->count();

        $order_process = Order::where('id_pendaftar', $pendaftarId)
            ->where('status_kursus', 'PROCESS')->count();

        $kursus_state = OrderDetail::with(['kursus'])
            ->where('status', 'PENDING')
            ->where('id_pendaftar', $pendaftarId)->get();

        return view('web.web_order_cart', compact('order_kursus', 'total_tagihan', 'order', 'order_status', 'order_process', 'kursus_state'));
    }

    public function updateToPending(Request $request)
    {
        $order = OrderDetail::findOrFail($request->order_id);
        $order->status = $request->status;
        $order->save();
        // hitung total harga
        $tot_tagihan = OrderDetail::where('id_pendaftar', $request->id_pendaftar)
            ->where('status', 'PROCESS')
            ->sum('biaya_kursus');

        Order::find($request->order_fk)->update(['total_tagihan' => $tot_tagihan]);

        return response()->json([
            'message' => 'Bimbel ' . $request->nama_kursus . ' berhasil di update status.',
            'totalTagihan' => $tot_tagihan
        ]);
    }

    public function updateToDelete($id)
    {
        $order_detail = OrderDetail::findOrFail($id);
        $order_detail->forceDelete();

        $order = Order::find($order_detail->id_order);
        // $decrement = $order->total_tagihan - $order_detail->biaya_kursus;
        $tot_tagihan = OrderDetail::where('id_pendaftar', $order_detail->id_pendaftar)
            ->where('status', 'PROCESS')
            ->sum('biaya_kursus');
        $order->update(['total_tagihan' => $tot_tagihan]);

        return response()->json([
            'message' => 'Bimbel berhasil di cancel.',
            'totalTagihan' => $order->total_tagihan
        ]);
    }

    public function uploadFile(Request $request)
    {
        $request->validate([
            'upload_bukti_transfer' => 'required|image|mimes:jpeg,png,jpg',
        ]);

        $pendaftarId = Auth::id();
        $order = Order::where('id_pendaftar', $pendaftarId)
            ->where('status_kursus', 'PROCESS')
            ->first();

        if ($order->upload_bukti == null) {
            $fileName = "buktibayar-" . time() . '.' . request()->upload_bukti_transfer->getClientOriginalExtension();
            $request->upload_bukti_transfer->storeAs('public/uploads/bukti_pembayaran', $fileName);
            $order->upload_bukti = $fileName;
            $order->status_kursus = 'PENDING';
            $order->save();

            OrderDetail::where('id_order', $order->id)
                ->where('id_pendaftar', $pendaftarId)
                ->where('status', 'PROCESS')
                ->update(['status' => 'PENDING']);
            OrderDetail::where('id_order', $order->id)
                ->where('id_pendaftar', $pendaftarId)
                ->where('status', 'CANCEL')
                ->forceDelete();
        }

        return redirect()->back()->with([
            'status' => 'Upload bukti transfer berhasil, silahkan cek konfirmasi di status pesanan'
        ]);
    }

    public function updateFile(Request $request)
    {
        $request->validate([
            'fileTransfer' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $pendaftarId = Auth::id();
        $data = Order::where('id_pendaftar', $pendaftarId)->where('status_kursus', 'FAILED')->first();

        if ($request->hasFile('fileTransfer')) {
            Storage::disk('local')->delete('public/uploads/bukti_pembayaran/' . $data->upload_bukti);

            $fileName = "buktibayar-" . time() . '.' . request()->fileTransfer->getClientOriginalExtension();
            $request->fileTransfer->storeAs('public/uploads/bukti_pembayaran', $fileName);
            $data->upload_bukti = $fileName;
            $data->status_kursus = 'PENDING';
            $data->save();
        }

        return redirect()->back()->with([
            'status' => 'Update bukti transfer berhasil, silahkan menunggu konfirmasi berikutnya'
        ]);
    }

    public function deleteCheckout($id)
    {
        $order = Order::findOrFail($id);
        
        Storage::disk('local')->delete('public/uploads/bukti_pembayaran/' . $order->upload_bukti);
        $order->upload_bukti = null;
        $order->status_kursus = 'PROCESS';
        $order->save();
        
        OrderDetail::where('id_order', $id)
                    ->update([
                        'status' => 'PROCESS'
                      ]);

        return response()->json([
            'message' => 'Konfirmasi berhasil dibatalkan.'
        ]);
    }

    public function success()
    {
        $data = "Bimble | Halaman Sukses";
        return view('web.web_success', ['title' => $data]);
    }
}
