<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RestokRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [

            'id_batch' => 'required|exists:batch_obat,id_batch',

            'jumlah' => 'required|integer|min:1',

            'keterangan' => 'nullable|max:255'

        ];
    }
}