<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Obat;
use App\Models\BatchObat;
use App\Models\Transaksi;
use Carbon\Carbon;
use App\Models\DetailTransaksi;
use Illuminate\Support\Facades\DB;


class DashboardController extends Controller
{
public function index()
{
    $grafikPenjualan = Transaksi::selectRaw("
        DATE(tanggal_transaksi) as tanggal,
        SUM(total_harga) as total
    ")
    ->whereDate(
        'tanggal_transaksi',
        '>=',
        now()->subDays(6)
    )
    ->groupBy(DB::raw('DATE(tanggal_transaksi)'))
    ->orderBy('tanggal')
    ->get();
    $obatTerlaris = DetailTransaksi::join(
        'batch_obat',
        'detail_transaksi.id_batch',
        '=',
        'batch_obat.id_batch'
    )
    ->join(
        'obat',
        'batch_obat.id_obat',
        '=',
        'obat.id_obat'
    )
    ->select(
        'obat.nama_obat',
        DB::raw('SUM(detail_transaksi.jumlah) as total')
    )
    ->groupBy(
        'obat.id_obat',
        'obat.nama_obat'
    )
    ->orderByDesc('total')
    ->limit(10)
    ->get();
    $totalObat = Obat::count();

    $totalBatch = BatchObat::count();

    $totalStok = BatchObat::sum('stok_sisa');

    $stokMinimum = Obat::with('batch')
        ->get()
        ->filter(function($obat){

            return $obat->batch->sum('stok_sisa')
                <=
                $obat->stok_minimum;

        })->count();

    $kadaluarsa = BatchObat::whereDate(
        'tanggal_kadaluarsa',
        '<',
        now()
    )->count();

    $hampirExp = BatchObat::whereBetween(
        'tanggal_kadaluarsa',
        [
            now(),
            now()->addMonths(6)
        ]
    )->count();

    $penjualanHariIni = Transaksi::whereDate(
        'tanggal_transaksi',
        today()
    )->sum('total_harga');

$expSoon = BatchObat::with('obat')
    ->whereDate(
        'tanggal_kadaluarsa',
        '<=',
        now()->addMonths(6)
    )
    ->orderBy('tanggal_kadaluarsa')
    ->get();

    $jumlahKadaluarsa = BatchObat::whereDate(
    'tanggal_kadaluarsa',
    '<',
    today()
)->count();

$jumlahHampirExp = BatchObat::whereBetween(
    'tanggal_kadaluarsa',
    [
        today(),
        today()->copy()->addMonths(6)
    ]
)->count();

$labelGrafik = [];
$dataGrafik = [];

for($i=6;$i>=0;$i--){

    $tgl = now()->subDays($i);

    $labelGrafik[] = $tgl->format('d M');

    $item = $grafikPenjualan
        ->firstWhere(
            'tanggal',
            $tgl->format('Y-m-d')
        );

    $dataGrafik[] = $item
        ? $item->total
        : 0;

}

$jumlahStokMinimum = Obat::with('batch')
    ->get()
    ->filter(function ($obat) {

        return $obat->batch->sum('stok_sisa')
            <=
            $obat->stok_minimum;

    })
    ->count();

    $labelObat = [];

$dataObat = [];

foreach($obatTerlaris as $item){

    $labelObat[] = $item->nama_obat;

    $dataObat[] = $item->total;

}

    return view(
        'layouts.dashboard.index',
        compact(
            
            'totalObat',
            'totalBatch',
            'totalStok',
            'stokMinimum',
            'kadaluarsa',
            'hampirExp',
            'penjualanHariIni',
             'expSoon',
             'jumlahKadaluarsa',
             'jumlahHampirExp',
             'jumlahStokMinimum',
             'labelObat',
             'labelGrafik',
            'dataGrafik',
            'dataObat'

            
        )
        
        
    );
}

}