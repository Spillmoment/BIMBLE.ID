<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Order;
use App\OrderDetail;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $items = Order::with(['pendaftar', 'order_detail'])
            ->orderBy('created_at', 'DESC')
            ->paginate(10);
        $start_date = $request->get('start_date');
        $end_date = $request->get('end_date');

        if ($start_date != "" && $end_date != "") {
            $items = Order::whereBetween('tgl_order', [$start_date, $end_date])
                ->orderBy('tgl_order', 'ASC')
                ->paginate(10);
            $start_date = \Carbon\Carbon::parse($start_date)->format('d-F-Y');
            $end_date = \Carbon\Carbon::parse($end_date)->format('d-F-Y');
        }

        return view('admin.order.index', [
            'items' => $items,
            'start_date' => $start_date,
            'end_date' => $end_date
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $items = Order::with([
            'pendaftar', 'order_detail'
        ])->findOrFail($id);

        $check = OrderDetail::with('pendaftar', 'order', 'kursus')
            ->where('id_order', $items->id) // hasMany to Order
            ->get();

        return view('admin.order.show', [
            'item' => $items,
            'detail' => $check,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * 
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $order = Order::findOrFail($id);
        return view('admin.order.edit', [
            'order' => $order
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(OrderRequest $request, $id)
    {
        $data = $request->all();
        $item = Order::findOrFail($id);
        $item->update($data);

        return redirect()->route('order.index')->with([
            'status', 'Data Order Berhasil Di Update!'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Order::findOrFail($id);
        $item->forceDelete();

        OrderDetail::where('id_order', $item->id)
            ->forceDelete();

        return redirect()->route('order.index')->with([
            'status' => 'Data Order Berhasil Di Hapus!'
        ]);
    }

    public function setStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:PENDING,SUCCESS,FAILED'
        ]);

        $item = Order::findOrFail($id);
        $item->status_kursus = $request->status;

        if ($request->status == 'SUCCESS') {
            OrderDetail::where('id_order', $item->id)
                ->update(['status' => 'SUCCESS']);
        } elseif ($request->status == 'PENDING') {
            OrderDetail::where('id_order', $item->id)
                ->update(['status' => 'PENDING']);
        } else {
            OrderDetail::where('id_order', $item->id)
                ->update(['status' => 'FAILED']);
        }

        $item->save();

        return redirect()->route('order.index')->with([
            'status' => 'Status order berhasil Diubah ke  ' . $item->status_kursus
        ]);
    }
}
