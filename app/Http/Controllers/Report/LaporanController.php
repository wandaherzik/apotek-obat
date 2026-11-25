<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaksi;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanController extends Controller
{
    public function index(Request $request)
{
    return $this->penjualan($request);
}
    public function penjualan(Request $request)
    {
        $query = Transaksi::with([
            'user',
            'detail'
        ]);

        if($request->filled('tanggal_awal')){
            $query->whereDate(
                'tanggal_transaksi',
                '>=',
                $request->tanggal_awal
            );
        }

        if($request->filled('tanggal_akhir')){
            $query->whereDate(
                'tanggal_transaksi',
                '<=',
                $request->tanggal_akhir
            );
        }

        $transaksi = $query
            ->orderByDesc('tanggal_transaksi')
            ->get();

        $totalPenjualan = $transaksi->sum('total_harga');

        $totalKeuntungan = 0;

        foreach($transaksi as $trx){

            foreach($trx->detail as $detail){

                $totalKeuntungan +=
                    ($detail->harga_jual - $detail->harga_modal)
                    * $detail->jumlah;

            }

        }

        return view(
            'layouts.laporan.penjualan',
            compact(
                'transaksi',
                'totalPenjualan',
                'totalKeuntungan'
            )
        );
    }
    public function exportPdf(Request $request)
{
    $query = Transaksi::with([
        'user',
        'detail.batch.obat'
    ]);

    if($request->filled('tanggal_awal')){
        $query->whereDate(
            'tanggal_transaksi',
            '>=',
            $request->tanggal_awal
        );
    }

    if($request->filled('tanggal_akhir')){
        $query->whereDate(
            'tanggal_transaksi',
            '<=',
            $request->tanggal_akhir
        );
    }

    $transaksi = $query
        ->orderBy('tanggal_transaksi')
        ->get();

    $totalPenjualan = $transaksi->sum('total_harga');

    $totalKeuntungan = 0;

    foreach($transaksi as $trx){

        foreach($trx->detail as $detail){

            $totalKeuntungan +=
                ($detail->harga_jual - $detail->harga_modal)
                * $detail->jumlah;

        }

    }

    $pdf = Pdf::loadView(
        'layouts.laporan.pdf',
        compact(
            'transaksi',
            'totalPenjualan',
            'totalKeuntungan'
        )
    );

    $pdf->setPaper('A4','landscape');

    return $pdf->stream('laporan-penjualan.pdf');
}
}