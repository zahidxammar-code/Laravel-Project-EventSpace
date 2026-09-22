<?php

namespace App\Http\Controllers;

use App\Models\Acara;
use App\Models\Pendaftaran;

class DashboardController extends Controller
{
    public function index()
    {
        return match (auth()->user()->role) {
            'admin' => view('dashboard.admin', [
                'totalEvent' => Acara::count(),
                'totalUpcoming' => Acara::where('status', 'akan_datang')->count(),
                'totalPeserta' => Pendaftaran::count(),
                'acaraMendatang' => Acara::with('kategori')
                    ->where('status', 'akan_datang')
                    ->orderBy('tanggal')
                    ->take(5)
                    ->get(),
            ]),

            'panitia' => view('dashboard.panitia', [
                'totalAcara' => Acara::count(),
                'totalPeserta' => Pendaftaran::count(),
                'pendaftarTerbaru' => Pendaftaran::with('acara', 'user')
                    ->latest()
                    ->take(5)
                    ->get(),
            ]),

            'peserta' => view('dashboard.peserta', [
                'totalEventDibuka' => Acara::where('status', 'akan_datang')->count(),
                'totalDiikuti' => Pendaftaran::where('user_id', auth()->id())->count(),
                'acaraTerbaru' => Acara::with('kategori')
                    ->where('status', 'akan_datang')
                    ->latest()
                    ->take(5)
                    ->get(),
            ]),
        };
    }
}