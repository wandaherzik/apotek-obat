<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BatchObatRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [

            'id_obat'=>'required|exists:obat,id_obat',

            'nomor_batch'=>'required|max:30',

            'tanggal_masuk'=>'required|date',

        'tanggal_kadaluarsa' => 'required|date|after:tanggal_masuk',

        'harga_modal' => 'required|numeric|min:0',

        'stok_awal' => 'required|integer|min:1',

        ];
    }
}