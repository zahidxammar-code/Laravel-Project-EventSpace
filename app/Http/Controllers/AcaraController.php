<?php

namespace App\Http\Controllers;

use App\Models\Acara;
use App\Models\Kategori;
use App\Http\Requests\StoreAcaraRequest;
use App\Http\Requests\UpdateAcaraRequest;
use Illuminate\Http\Request;

class AcaraController extends Controller
{
    public function index(Request $request)
    {
        $acaras = Acara::with('kategori')
            ->when($request->search, fn($q) =>
            $q->where('nama', 'like', '%' . $request->search . '%'))
            ->when($request->kategori_id, fn($q) =>
            $q->where('kategori_id', $request->kategori_id))
            ->when($request->status, fn($q) =>
            $q->where('status', $request->status))
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $kategoris = Kategori::all();

        return view('acara.index', compact('acaras', 'kategoris'));
    }

    public function create()
    {
        $kategoris = Kategori::all();
        return view('acara.create', compact('kategoris'));
    }

    public function store(StoreAcaraRequest $request)
    {
        $acara = Acara::create($request->validated() + ['dibuat_oleh' => auth()->id()]);

        $acara->jadwal()->create([
            'tanggal' => $acara->tanggal,
            'waktu_mulai' => $acara->waktu_mulai,
            'waktu_selesai' => $acara->waktu_selesai,
        ]);

        return redirect()->route('acara.index')->with('sukses', 'Acara ditambahkan.');
    }

    public function show(Acara $acara)
    {
        $acara->load('kategori', 'pembuat', 'pendaftarans', 'jadwal');
        return view('acara.show', compact('acara'));
    }

    public function edit(Acara $acara)
    {
        $kategoris = Kategori::all();
        return view('acara.edit', compact('acara', 'kategoris'));
    }

    public function update(UpdateAcaraRequest $request, Acara $acara)
    {
        $acara->update($request->validated());
        return redirect()->route('acara.index')->with('sukses', 'Acara diperbarui.');
    }

    public function destroy(Acara $acara)
    {
        $acara->delete();
        return redirect()->route('acara.index')->with('sukses', 'Acara dihapus.');
    }
}
