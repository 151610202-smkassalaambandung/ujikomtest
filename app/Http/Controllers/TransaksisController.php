<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Html\Builder;
use Yajra\Datatables\Datatables;
use App\Transaksi;
use Illuminate\Support\Facades\Session;
use App\Barang;

class TransaksisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Builder $htmlBuilder)
    {
        //
        
         if ($request->ajax()){
            $transaksis = Transaksi::with(['barang']);
            return Datatables::of($transaksis)
             
            ->addColumn('action', function($transaksi){
                return view('datatable._action', [
                'model' => $transaksi,
                'form_url' => route('transaksis.destroy',$transaksi->id), 
                'edit_url' => route('transaksis.edit',$transaksi->id),
                'confirm_message' => 'Yakin mau Menghapus'. $transaksi->nama_pembeli .'?'
                ]);
        })->make(true);
        }
        $html = $htmlBuilder

         ->addColumn(['data'=>'nama_pembeli','name'=>'nama_pembeli','title'=>'Nama Pembeli'])
         ->addColumn(['data'=>'jenis_kelamin','name'=>'jenis_kelamin','title'=>'Jenis Kelamin'])
         ->addColumn(['data'=>'alamat_pembeli','name'=>'alamat_pembeli','title'=>'Alamat Pembeli'])
         ->addColumn(['data'=>'tgl_membeli','name'=>'tgl_membeli','title'=>'Tanggal Pembelian'])
         ->addColumn(['data'=>'barang.nama_barang','name'=>'barang.nama_barang','title'=>'Barang'])
         ->addColumn(['data'=>'jumlah_barang','name'=>'jumlah_barang','title'=>'Jumlah Barang'])
         ->addColumn(['data'=>'total_harga','name'=>'total_harga','title'=>'Total Harga']);
         return view('transaksis.index')->with(compact('html'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('transaksis.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        
        $transaksi= new Transaksi();
        $transaksi->nama_pembeli=$request->nama_pembeli;
        $transaksi->jenis_kelamin=$request->jenis_kelamin;
        $transaksi->alamat_pembeli=$request->alamat_pembeli;
        $transaksi->tgl_membeli=$request->tgl_membeli;
        $transaksi->barang_id=$request->barang_id;
        $transaksi->jumlah_barang=$request->jumlah_barang;
        $barang = Barang::find($request->barang_id);
        $harga = $barang->harga;
        $total_harga = $harga * $request->jumlah_barang;
        $transaksi->total_harga=$total_harga;
        $transaksi->save();

     Session::flash("flash_notification",["level"=>"success","message"=>"Berhasil menyimpan $transaksi->nama_pembeli"]);
        return redirect()->route('transaksis.index');
       }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        Transaksi::destroy($id);

        Session::flash("flash_notification", ["level"=>"success","message"=>"Transaksi berhasil dihapus"]);
        return redirect()->route('transaksis.index');
   
    }
}
