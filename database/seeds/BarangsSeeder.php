<?php

use Illuminate\Database\Seeder;
use App\Modeli;                                                             
use App\Barang;

class BarangsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Sample penulis
        $modeli1= Modeli::create(['nama'=>'Vintage']);
        $modeli2= Modeli::create(['nama'=>'Classic']);
        $modeli3= Modeli::create(['nama'=>'Mewah']);
        
        //Sample buku
        $barang1= Barang::create(['nama_barang'=>'Sofa','jumlah_barang'=>3,'harga'=>1000000,'modeli_id'=>$modeli1->id]);
        $barang2= Barang::create(['nama_barang'=>'Tempat Tidur','jumlah_barang'=>3,'harga'=>1000000,'modeli_id'=>$modeli2->id]);
        $barang3= Barang::create(['nama_barang'=>'Meja','jumlah_barang'=>2,'harga'=>1000000,'modeli_id'=>$modeli3->id]);
        $barang4= Barang::create(['nama_barang'=>'Lemari','jumlah_barang'=>1,'harga'=>1000000,'modeli_id'=>$modeli1->id]);
       
    }
}
