<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $table = 'transaksi';

    protected $primaryKey = 'id_transaksi';

    protected $fillable = [

        'kode_transaksi',

        'tanggal_transaksi',

        'nama_pembeli',

        'id_user',

        'total_harga',

        'metode_bayar',

        'total_bayar',

        'kembalian',

        'keterangan'

    ];

    public function detail()
    {
        return $this->hasMany(
            DetailTransaksi::class,
            'id_transaksi',
            'id_transaksi'
        );
    }

    public function user()
    {
        return $this->belongsTo(
            User::class,
            'id_user',
            'id_user'
        );
    }
}