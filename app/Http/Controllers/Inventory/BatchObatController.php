<?php

namespace App\Http\Controllers\Inventory;

use App\Models\BatchObat;
use App\Http\Controllers\Controller;
use App\Models\Obat;
use App\Http\Requests\BatchObatRequest;


class BatchObatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
public function index()
{
    $batch = BatchObat::with('obat')->get();

    $obat = Obat::orderBy('nama_obat')->get();

    $nomor_batch = $this->generateNomorBatch();

    return view(
        'layouts.batch.index',
        compact(
            'batch',
            'obat',
            'nomor_batch'
        )
    );
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
public function store(BatchObatRequest $request)
{
    $data = $request->validated();

    $data['stok_sisa'] = $data['stok_awal'];

    BatchObat::create($data);

    return back()->with(
        'success',
        'Batch berhasil ditambahkan.'
    );
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
public function update(BatchObatRequest $request, string $id)
{
    $batch = BatchObat::findOrFail($id);

    $data = $request->validated();

    /*
     * Jika stok belum pernah dipakai,
     * stok_sisa mengikuti stok_awal.
     */

    if ($batch->stok_sisa == $batch->stok_awal) {

        $data['stok_sisa'] = $data['stok_awal'];

    }

    $batch->update($data);

    return redirect()
        ->route('batch-obat.index')
        ->with('success','Batch berhasil diperbarui.');
}

    /**
     * Remove the specified resource from storage.
     */
public function destroy(string $id)
{
    $batch = BatchObat::findOrFail($id);

    $batch->delete();

    return redirect()
        ->route('batch-obat.index')
        ->with('success', 'Batch berhasil dihapus.');
}
    private function generateNomorBatch()
{
    $last = BatchObat::latest('id_batch')->first();

    if (!$last) {

        return 'BATCH0001';

    }

    $number = (int) substr($last->nomor_batch,5);

    return 'BATCH'.str_pad(
        $number+1,
        4,
        '0',
        STR_PAD_LEFT
    );
}
}
