<?php

namespace Database\Seeders;

use App\Models\KategoriObat;
use Illuminate\Database\Seeder;

class KategoriObatSeeder extends Seeder
{
    public function run(): void
    {
        $kategori = [

            ['nama_kategori'=>'Antibiotik'],
            ['nama_kategori'=>'Vitamin'],
            ['nama_kategori'=>'Analgesik'],
            ['nama_kategori'=>'Sirup'],
            ['nama_kategori'=>'Salep'],
            ['nama_kategori'=>'Alat Kesehatan']

        ];

        foreach($kategori as $item)
        {
            KategoriObat::create($item);
        }
    }
}