<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Http\Requests\KonversiSatuanRequest;
use App\Models\KonversiSatuan;
use App\Models\Satuan;

class KonversiSatuanController extends Controller
{
    public function index()
    {
        $konversi = KonversiSatuan::with([
            'satuanAsal',
            'satuanTujuan'
        ])->get();

        $satuan = Satuan::orderBy('nama_satuan')->get();

        return view('layouts.konversi.index', compact(
            'konversi',
            'satuan'
        ));
    }

    public function store(KonversiSatuanRequest $request)
    {
        KonversiSatuan::create($request->validated());

        return redirect()
            ->route('konversi-satuan.index')
            ->with('success','Konversi berhasil ditambahkan.');
    }

public function update(
    KonversiSatuanRequest $request,
    $id
){

    $konversi = KonversiSatuan::findOrFail($id);

    $konversi->update($request->validated());

    return redirect()
            ->route('konversi-satuan.index')
            ->with(
                'success',
                'Konversi berhasil diperbarui.'
            );
}

    public function destroy($id)
    {
        KonversiSatuan::findOrFail($id)->delete();

        return redirect()
            ->route('konversi-satuan.index')
            ->with('success','Konversi berhasil dihapus.');
    }
}