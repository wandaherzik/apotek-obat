<?php

namespace App\Http\Controllers\Master;

use App\Http\Requests\KategoriObatRequest;
use App\Http\Controllers\Controller;
use App\Models\KategoriObat;

class KategoriObatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kategori = KategoriObat::latest()->get();

        return view('layouts.kategori-obat.index', compact('kategori'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('layouts.kategori-obat.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(KategoriObatRequest $request)
    {
        KategoriObat::create([

            'nama_kategori' => $request->nama_kategori,

            'keterangan' => $request->keterangan

        ]);

        return redirect()
            ->route('kategori-obat.index')
            ->with('success', 'Kategori berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(KategoriObat $kategoriObat)
    {
        return view('layouts.kategori-obat.edit', compact('kategoriObat'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(KategoriObatRequest $request, $id)
    {
        $kategori = KategoriObat::findOrFail($id);

        $kategori->update([
            'nama_kategori' => $request->nama_kategori,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()
            ->route('kategori-obat.index')
            ->with('success', 'Kategori obat berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(KategoriObat $kategoriObat)
    {
        $kategoriObat->delete();

        return redirect()
            ->route('kategori-obat.index')
            ->with('success', 'Kategori berhasil dihapus.');
    }
}