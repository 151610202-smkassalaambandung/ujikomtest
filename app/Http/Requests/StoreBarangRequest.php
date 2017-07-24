<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreBarangRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
            'cover'=>'image|max:2048',
            'nama_barang'=>'required|unique:barangs,nama_barang',
            'modeli_id'=>'required|exists:modelis,id',
            'jumlah_barang'=>'required|numeric',
            'harga'=>'required|numeric'
        ];
    }
}
