<?php

namespace App\Http\Requests;

class UpdateBarangRequest extends StoreBarangRequest
{
	public function rules()
	{
		$rules = parent::rules();
		$rules['nama_barang'] = 'required|unique:barangs,nama_barang,' . $this->route('barang');
		return $rules;
	}
}