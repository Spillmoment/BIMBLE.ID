<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kursus;
use App\Tutor;
use App\Pendaftar;
use App\Order;

class DashboardController extends Controller
{

    public function index()
    {
        $kursus = Kursus::all()->count();
        $tutor = Tutor::all()->count();
        $total_order = Order::where('status_kursus', 'SUCCESS')
            ->sum('total_tagihan');

        $jumlah_order = Order::count();

        $pie = [
            'pending' => Order::where('status_kursus', 'PENDING')->count(),
            'success' => Order::where('status_kursus', 'SUCCESS')->count(),
            'process' => Order::where('status_kursus', 'PROCESS')->count(),
            'failed' => Order::where('status_kursus', 'FAILED')->count()
        ];

        $order_baru = Order::orderBy('created_at', 'DESC')->take(6)->get();

        return view(
            'admin.dashboard.index',
            [
                'kursus' => $kursus,
                'tutor' => $tutor,
                'pie' => $pie,
                'total' => $total_order,
                'order' => $jumlah_order,
                'new_order' => $order_baru
            ]
        );
    }
}
