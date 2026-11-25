<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\KonversiSatuan;

class Satuan extends Model
{
    protected $table = 'satuans';

    protected $primaryKey = 'id_satuan';

    protected $fillable = [
        'nama_satuan',
        'keterangan'
    ];

    public function konversiAsal()
{
    return $this->hasMany(KonversiSatuan::class,'id_satuan_asal');
}

public function konversiTujuan()
{
    return $this->hasMany(KonversiSatuan::class,'id_satuan_tujuan');
}
}