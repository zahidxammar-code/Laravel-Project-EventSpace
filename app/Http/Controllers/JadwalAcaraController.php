<?php

namespace App\Http\Controllers;

use App\Models\Acara;
use App\Models\JadwalAcara;
use Illuminate\Http\Request;

class JadwalAcaraController extends Controller
{
    public function store(Request $request, Acara $acara)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'waktu_mulai' => 'required',
            'waktu_selesai' => 'required|after:waktu_mulai',
        ]);

        $acara->jadwal()->create($request->only('tanggal', 'waktu_mulai', 'waktu_selesai'));

        return back()->with('sukses', 'Jadwal ditambahkan.');
    }

    public function destroy(JadwalAcara $jadwal)
    {
        $jadwal->delete();
        return back()->with('sukses', 'Jadwal dihapus.');
    }
}