<?php

namespace App\Http\Controllers\Inventory;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\RestokRequest;
use App\Models\BatchObat;
use App\Models\StokLog;

class RestokController extends Controller
{
public function index()
{
    $batch = BatchObat::with('obat')->get();

    $log = StokLog::with('batch.obat')
                ->where('jenis','MASUK')
                ->latest()
                ->get();

    return view(
        'layouts.restok.index',
        compact(
            'batch',
            'log'
        )
    );
}

    public function create()
    {
        return view('layouts.restok.create');
    }

public function store(RestokRequest $request)
{
    $batch = BatchObat::findOrFail(
        $request->id_batch
    );

    $stokSebelum = $batch->stok_sisa;

    $batch->stok_awal += $request->jumlah;

    $batch->stok_sisa += $request->jumlah;

    $batch->save();

    StokLog::create([

        'id_batch' => $batch->id_batch,

        'jenis' => 'MASUK',

        'jumlah' => $request->jumlah,

        'stok_sebelum' => $stokSebelum,

        'stok_sesudah' => $batch->stok_sisa,

        'keterangan' => $request->keterangan

    ]);

    return back()->with(
        'success',
        'Restok berhasil.'
    );
}

    public function edit(string $id)
    {

    }

    public function update(Request $request, string $id)
    {

    }

    public function destroy(string $id)
    {

    }

    public function riwayat()
    {

    }
}