<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class KonversiSatuanRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
public function authorize(): bool
{
    return true;
}

public function rules(): array
{
    return [

        'id_satuan_asal'=>'required|exists:satuans,id_satuan',

        'jumlah'=>'required|integer|min:1',

        'id_satuan_tujuan'=>'required|exists:satuans,id_satuan',

        'keterangan'=>'nullable|max:255'

    ];
}
}
