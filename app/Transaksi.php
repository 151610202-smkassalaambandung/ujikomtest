<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    //
     protected $fillable =['nama_pembeli','jenis_kelamin','alamat_pembeli','tgl_membeli','barang_id','jumlah_barang','total_harga'];
    public function barang()
    {
 	return $this->belongsTo('App\Barang');
    }
}
