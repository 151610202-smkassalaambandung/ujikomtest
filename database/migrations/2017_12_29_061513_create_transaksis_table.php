<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransaksisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksis', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama_pembeli');
            $table->string('jenis_kelamin');
            $table->string('alamat_pembeli');
            $table->date('tgl_membeli');
            $table->integer('barang_id')->unsigned();
            $table->integer('jumlah_barang')->unsigned();
            $table->integer('total_harga')->unsigned();
            $table->timestamps();
            $table->foreign('barang_id')->references('id')->on('barangs')->onUpdate('cascade')->onDelete('cascade');
        
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaksis');
    }
}
