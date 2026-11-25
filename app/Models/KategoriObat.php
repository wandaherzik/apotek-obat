<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class KategoriObat extends Model
{
    protected $table = 'kategori_obat';
    protected $primaryKey = 'id_kategori';

    protected $fillable = [
        'nama_kategori',
        'keterangan'
    ];

    public function getRouteKeyName()
    {
    return 'id_kategori';
    }

    public function obat(): HasMany
    {
        return $this->hasMany(Obat::class, 'id_kategori', 'id_kategori');
    }
}