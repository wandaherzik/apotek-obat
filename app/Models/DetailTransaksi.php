<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailTransaksi extends Model
{
    protected $table = 'detail_transaksi';

    protected $primaryKey = 'id_detail';

    protected $fillable = [

        'id_transaksi',

        'id_batch',

        'jumlah',

        'harga_jual',

        'harga_modal',

        'subtotal'

    ];

    public function transaksi()
    {
        return $this->belongsTo(
            Transaksi::class,
            'id_transaksi',
            'id_transaksi'
        );
    }

    public function batch()
    {
        return $this->belongsTo(
            BatchObat::class,
            'id_batch',
            'id_batch'
        );
    }
    public function obat()
{
    return $this->batch->obat;
}
}