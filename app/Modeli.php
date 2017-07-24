<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

class Modeli extends Model
{
    //
    protected $fillable = ['nama'];
     public function barangs()
 {
 	return $this->hasMany('App\Barang');
 }
   public static function boot()
 	{
 		parent::boot();

 		self::deleting(function($modeli){
 			//mengecek apakah penulis masih punya buku
 			if($modeli->barangs->count() > 0) {
 		    //menyiapkan error
 			$html = 'Model tidak bisa dihapus karena masih terdapat barang :';
 			$html .='<ul>';
 			foreach ($modeli->barangs as $barang) {
 				$html .="<li>$barang->nama_barang</li>";
 			}
 			$html .='</ul>';
 			Session::flash("flash_notification", ["level"=>"danger","message"=>$html]);
 			//membatalkan proses penghapusan
 			return false;
 			}
 		});
 	}

}
