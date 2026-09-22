<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Http\Requests\StoreKategoriRequest;
use App\Http\Requests\UpdateKategoriRequest;

class KategoriController extends Controller
{
    public function index()
    {
        $kategoris = Kategori::latest()->paginate(10);
        return view('kategori.index', compact('kategoris'));
    }

    public function create()
    {
        return view('kategori.create');
    }

    public function store(StoreKategoriRequest $request)
    {
        Kategori::create($request->validated());
        return redirect()->route('kategori.index')->with('sukses', 'Kategori ditambahkan.');
    }

    public function show(Kategori $kategori)
    {
        //
    }

    public function edit(Kategori $kategori)
    {
        return view('kategori.edit', compact('kategori'));
    }

    public function update(UpdateKategoriRequest $request, Kategori $kategori)
    {
        $kategori->update($request->validated());
        return redirect()->route('kategori.index')->with('sukses', 'Kategori diperbarui.');
    }

    public function destroy(Kategori $kategori)
    {
        if ($kategori->acaras()->exists()) {
            return redirect()
                ->route('kategori.index')
                ->with('gagal', 'Kategori tidak dapat dihapus karena masih digunakan oleh acara.');
        }
        $kategori->delete();

        return redirect()
            ->route('kategori.index')
            ->with('sukses', 'Kategori dihapus.');
    }
}
