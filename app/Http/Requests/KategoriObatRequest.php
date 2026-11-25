<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class KategoriObatRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

public function rules(): array
{
    $id = $this->route('kategori_obat'); // sesuaikan jika nama parameter route berbeda

    return [
        'nama_kategori' => [
            'required',
            'max:100',
            Rule::unique('kategori_obat', 'nama_kategori')->ignore($id, 'id_kategori'),
        ],
        'keterangan' => 'nullable|max:500',
    ];
}

    public function messages()
    {
        return [

            'nama_kategori.required'=>'Nama kategori wajib diisi.',

            'nama_kategori.unique'=>'Kategori sudah ada.',

        ];
    }
}