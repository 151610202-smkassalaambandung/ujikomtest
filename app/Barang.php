<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    //
     protected $fillable =['nama_barang','modeli_id','jumlah_barang','harga'];
    public function modeli()
    {
 	return $this->belongsTo('App\Modeli');
    }
}
