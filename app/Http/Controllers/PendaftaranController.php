<?php

namespace App\Http\Controllers;

use App\Models\Acara;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;

class PendaftaranController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->role === 'peserta') {
            $pendaftarans = Pendaftaran::with('acara')
                ->where('user_id', $user->id)
                ->latest()
                ->paginate(10);
        } else {
            $pendaftarans = Pendaftaran::with('acara', 'user')
                ->latest()
                ->paginate(10);
        }

        return view('pendaftaran.index', compact('pendaftarans'));
    }

    public function store(Request $request, Acara $acara)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'no_hp' => 'required|string|max:20',
        ]);

        $sudahTerdaftar = Pendaftaran::where('acara_id', $acara->id)
            ->where('user_id', auth()->id())
            ->exists();

        if ($sudahTerdaftar) {
            return back()->with('gagal', 'Anda sudah terdaftar di acara ini.');
        }

        $jumlahPendaftar = Pendaftaran::where('acara_id', $acara->id)->count();
        if ($jumlahPendaftar >= $acara->kapasitas) {
            return back()->with('gagal', 'Kuota acara ini sudah penuh.');
        }

        Pendaftaran::create([
            'acara_id' => $acara->id,
            'user_id' => auth()->id(),
            'nama' => $request->nama,
            'no_hp' => $request->no_hp,
            'status' => 'menunggu',
        ]);

        return redirect()->route('pendaftaran.index')->with('sukses', 'Pendaftaran berhasil.');
    }

    public function updateStatus(Request $request, Pendaftaran $pendaftaran)
    {
        $request->validate([
            'status' => 'required|in:menunggu,diterima,ditolak',
        ]);

        $pendaftaran->update(['status' => $request->status]);

        return back()->with('sukses', 'Status pendaftaran diperbarui.');
    }
}
