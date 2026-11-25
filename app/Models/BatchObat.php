<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BatchObat extends Model
{
    protected $table = 'batch_obat';

    protected $primaryKey = 'id_batch';

    protected $fillable = [
        'id_obat',
        'nomor_batch',
        'tanggal_masuk',
        'tanggal_kadaluarsa',
        'harga_modal',
        'stok_awal',
        'stok_sisa',
    ];

    public function obat()
    {
        return $this->belongsTo(
            Obat::class,
            'id_obat',
            'id_obat'
        );
    }
}