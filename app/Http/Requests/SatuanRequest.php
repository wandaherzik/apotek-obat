<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SatuanRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $id = $this->route('satuan');

        return [

            'nama_satuan' => [
                'required',
                'max:50',
                Rule::unique('satuans','nama_satuan')
                    ->ignore($id,'id_satuan')
            ],

            'keterangan'=>'nullable|max:255'

        ];
    }

    public function messages(): array
    {
        return [

            'nama_satuan.required'=>'Nama satuan wajib diisi.',

            'nama_satuan.unique'=>'Nama satuan sudah ada.'

        ];
    }
}