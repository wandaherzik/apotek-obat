<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Obat;
use App\Models\KategoriObat;
use App\Models\Satuan;
use App\Http\Requests\ObatRequest;
class ObatController extends Controller
{
public function index()
{
    $obat = Obat::with([
        'kategori',
        'satuan'
    ])->get();

    $kategori = KategoriObat::all();

    $satuan = Satuan::all();

    $kode_obat = $this->generateKodeObat();

    return view(
        'layouts.obat.index',
        compact(
            'obat',
            'kategori',
            'satuan',
            'kode_obat'
        )
    );
}

    public function create()
    {
        return view('layouts.obat.create');
    }

public function store(ObatRequest $request)
{
    Obat::create(
        $request->validated()
    );

    return back()->with(
        'success',
        'Obat berhasil ditambahkan.'
    );
}

    public function show(string $id)
    {

    }

    public function edit(string $id)
    {
        return view('layouts.obat.edit');
    }

public function update(Request $request,$id)
{
    $request->validate([

        'nama_obat'=>'required',

        'id_kategori'=>'required',

        'id_satuan'=>'required',

        'harga_jual'=>'required|numeric',

        'stok_minimum'=>'required|numeric'

    ]);

    $obat = Obat::findOrFail($id);

    $obat->update($request->all());

    return back()->with(
        'success',
        'Data obat berhasil diperbarui.'
    );
}

public function destroy(Obat $obat)
{
    $obat->delete();

    return back()->with(
        'success',
        'Obat berhasil dihapus.'
    );
}

    // Method tambahan
    public function scanBarcode()
    {

    }

    public function search()
    {

    }

    private function generateKodeObat()
{
    $last = Obat::latest('id_obat')->first();

    if (!$last) {
        return 'OBT0001';
    }

    $number = (int) substr($last->kode_obat, 3);

    return 'OBT'.str_pad($number + 1, 4, '0', STR_PAD_LEFT);
}
}