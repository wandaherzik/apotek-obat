<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Satuan;

class KonversiSatuan extends Model
{
    protected $table = 'konversi_satuan';

    protected $primaryKey = 'id_konversi';


    protected $fillable = [
        'id_satuan_asal',
        'jumlah',
        'id_satuan_tujuan',
        'keterangan'
    ];


    public function satuanAsal()
    {
        return $this->belongsTo(
            Satuan::class,
            'id_satuan_asal',
            'id_satuan'
        );
    }


    public function satuanTujuan()
    {
        return $this->belongsTo(
            Satuan::class,
            'id_satuan_tujuan',
            'id_satuan'
        );
    }
}