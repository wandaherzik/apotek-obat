<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Http\Requests\SatuanRequest;
use App\Models\Satuan;

class SatuanController extends Controller
{
    /**
     * Menampilkan daftar satuan
     */
    public function index()
    {
        $satuan = Satuan::orderBy('nama_satuan')->get();

        return view('layouts.satuan.index', compact('satuan'));
    }

    /**
     * Simpan data
     */
    public function store(SatuanRequest $request)
    {
        Satuan::create([
            'nama_satuan' => $request->nama_satuan,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()
            ->route('satuan.index')
            ->with('success', 'Satuan berhasil ditambahkan.');
    }

    /**
     * Update data
     */
    public function update(SatuanRequest $request, $id)
    {
        $satuan = Satuan::findOrFail($id);

        $satuan->update([
            'nama_satuan' => $request->nama_satuan,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()
            ->route('satuan.index')
            ->with('success', 'Satuan berhasil diperbarui.');
    }

    /**
     * Hapus data
     */
    public function destroy($id)
    {
        $satuan = Satuan::findOrFail($id);

        $satuan->delete();

        return redirect()
            ->route('satuan.index')
            ->with('success', 'Satuan berhasil dihapus.');
    }
}