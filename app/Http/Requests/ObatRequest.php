<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ObatRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [

            'kode_obat'=>'required|max:20',

            'barcode'=>'nullable|max:100',

            'nama_obat'=>'required|max:150',

            'id_kategori'=>'required|exists:kategori_obat,id_kategori',

            'id_satuan'=>'required|exists:satuans,id_satuan',

            'harga_jual'=>'required|numeric|min:0',

            'stok_minimum'=>'required|integer|min:0',

            'status'=>'required|boolean',

            'keterangan'=>'nullable'

        ];
    }
}
