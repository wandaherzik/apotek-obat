<?php

namespace App\Http\Controllers\Transaction;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\DetailTransaksi;
use App\Models\BatchObat;
use App\Models\StokLog;
use App\Models\Obat;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class TransaksiController extends Controller
{
    public function index()
    {
        $kode = $this->generateKode();

        $obat = Obat::with('satuan')
            ->where('status', true)
            ->orderBy('nama_obat')
            ->get();

        return view(
            'layouts.transaksi.index',
            compact(
                'kode',
                'obat'
            )
        );
    }

    public function create()
    {
        return view('transaksi.create');
    }

    public function store(Request $request)
{
    $cart = json_decode($request->cart, true);

    if (empty($cart)) {

        return back()->with(
            'error',
            'Keranjang masih kosong.'
        );

    }
    $transaksi = null;

    DB::transaction(function () use (&$transaksi, $request, $cart) {

        $transaksi = Transaksi::create([

            'kode_transaksi'     => $this->generateKode(),

            'tanggal_transaksi'  => now(),

            'nama_pembeli'       => $request->nama_pembeli,

            'id_user'            => auth()->user()->id_user,

            'total_harga'        => collect($cart)->sum(function($item){

                return $item['qty'] * $item['harga'];

            }),

            'metode_bayar'       => $request->metode_bayar,

            'total_bayar'        => $request->total_bayar,

            'kembalian'          => $request->total_bayar -
                                    collect($cart)->sum(fn($i)=>$i['qty']*$i['harga'])

        ]);
        foreach ($cart as $item) {

    $batches = BatchObat::where('id_obat', $item['id'])
        ->where('stok_sisa', '>', 0)
        ->orderBy('tanggal_kadaluarsa')
        ->lockForUpdate()
        ->get();

    $sisa = $item['qty'];

    foreach ($batches as $batch) {

        if ($sisa <= 0) {

            break;

        }

        $stokSebelum = $batch->stok_sisa;

        $ambil = min($stokSebelum, $sisa);

        $batch->stok_sisa -= $ambil;

        $batch->save();

        $stokSesudah = $batch->stok_sisa;

        DetailTransaksi::create([

            'id_transaksi' => $transaksi->id_transaksi,

            'id_batch' => $batch->id_batch,

            'jumlah' => $ambil,

            'harga_jual' => $item['harga'],

            'harga_modal' => $batch->harga_modal,

            'subtotal' => $ambil * $item['harga']

        ]);

        StokLog::create([

            'id_batch' => $batch->id_batch,

            'jenis' => 'KELUAR',

            'jumlah' => $ambil,

            'stok_sebelum' => $stokSebelum,

            'stok_sesudah' => $stokSesudah,

            'keterangan' => 'Penjualan '.$transaksi->kode_transaksi

        ]);

        $sisa -= $ambil;

    }

    if ($sisa > 0) {

        throw new \Exception(
            'Stok '.$item['nama'].' tidak mencukupi.'
        );

    }

}

    });

return redirect()->route(
    'transaksi.sukses',
    $transaksi->id_transaksi
);
}

    public function scanBarcode()
    {

    }
    

public function cariObat(Request $request)
{
    $search = $request->search;

    $obat = Obat::with(['satuan','batch'])
        ->where('status',1)
        ->where(function($q) use($search){

            $q->where('nama_obat','like',"%{$search}%")
              ->orWhere('kode_obat','like',"%{$search}%")
              ->orWhere('barcode','like',"%{$search}%");

        })
        ->limit(20)
        ->get();

    $result=[];

    foreach($obat as $item){

        $stok = $item->batch->sum('stok_sisa');

        $result[]=[

            'id'=>$item->id_obat,

            'text'=>$item->nama_obat,

            'nama'=>$item->nama_obat,

            'kode'=>$item->kode_obat,

            'barcode'=>$item->barcode,

            'harga'=>$item->harga_jual,

            'stok'=>$stok,

            'minimum'=>$item->stok_minimum,

            'satuan'=>$item->satuan->nama_satuan

        ];

    }

    return response()->json([
        'results'=>$result
    ]);
}

    public function tambahKeranjang()
    {

    }

    public function hapusItem()
    {

    }

    public function pembayaran()
    {

    }

public function cetak($id)
{
    $transaksi = Transaksi::with([
        'user',
        'detail.batch.obat'
    ])->findOrFail($id);

    return view(
        'layouts.transaksi.cetak',
        compact('transaksi')
    );
}
    public function riwayat()
{
    $transaksi = Transaksi::with('user')
        ->latest('tanggal_transaksi')
        ->get();

    return view(
        'layouts.transaksi.riwayat',
        compact('transaksi')
    );
}
    
    private function generateKode()
{
    $today = now()->format('Ymd');

    $last = Transaksi::whereDate(
        'tanggal_transaksi',
        today()
    )->latest('id_transaksi')->first();

    if(!$last){

        return 'TRX-'.$today.'-0001';

    }

    $number = (int) substr(
        $last->kode_transaksi,
        -4
    );

    return 'TRX-'.$today.'-'.str_pad(

        $number+1,

        4,

        '0',

        STR_PAD_LEFT

    );
}
public function show($id)
{
    $transaksi = Transaksi::with([

        'detail.batch.obat',

        'user'

    ])->findOrFail($id);

    return view(

        'layouts.transaksi.show',

        compact('transaksi')

    );
}

public function sukses($id)
{
    $transaksi = Transaksi::findOrFail($id);

    return view(
        'layouts.transaksi.sukses',
        compact('transaksi')
    );
}

}