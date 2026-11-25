<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class TransaksiRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [

            'nama_pembeli'=>'nullable|max:100',

            'metode_bayar'=>'required',

            'total_bayar'=>'required|numeric|min:0'

        ];
    }
}
