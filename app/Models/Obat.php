<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Obat extends Model
{
    protected $table = 'obat';

    protected $primaryKey = 'id_obat';

    protected $fillable = [
        'kode_obat',
        'barcode',
        'nama_obat',
        'id_kategori',
        'id_satuan',
        'harga_jual',
        'stok_minimum',
        'status',
        'keterangan'
    ];

    public function kategori()
    {
        return $this->belongsTo(
            KategoriObat::class,
            'id_kategori',
            'id_kategori'
        );
    }

    public function satuan()
    {
        return $this->belongsTo(
            Satuan::class,
            'id_satuan',
            'id_satuan'
        );
    }
        public function batch()
    {
        return $this->hasMany(
            BatchObat::class,
            'id_obat',
            'id_obat'
        );
    }
}