<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StokLog extends Model
{
    protected $table = 'stok_log';

    protected $primaryKey = 'id_log';

    protected $fillable = [
        'id_batch',
        'jenis',
        'jumlah',
        'stok_sebelum',
        'stok_sesudah',
        'keterangan'
    ];

    public function batch()
    {
        return $this->belongsTo(
            BatchObat::class,
            'id_batch',
            'id_batch'
        );
    }
}