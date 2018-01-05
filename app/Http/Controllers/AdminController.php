<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Yajra\Datatables\Html\Builder;
use Yajra\Datatables\Datatables;
use App\Barang;
use Laratrust\LaratrustFacade as Laratrust;

class GuestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Builder $htmlBuilder)
    {
     
        if ($request->ajax()){
            $barangs = Barang::with(['modeli']);
            return Datatables::of($barangs)
             ->addColumn('cover', function($barangs){
                return '<img src="/img/'.$barangs->cover. '" height="100px" width="200px">';
            })
            ->addColumn('action', function($barang){
                return view('datatable._action', [
                'model' => $barang,
                'form_url' => route('barangs.destroy',$barang->id), 
                'edit_url' => route('barangs.edit',$barang->id),
                'confirm_message' => 'Yakin mau Menghapus'. $barang->nama_barang .'?'
                ]);
        })->make(true);
        }
        $html = $htmlBuilder

         ->addColumn(['data'=>'cover','name'=>'cover','title'=>'Gambar'])
         ->addColumn(['data'=>'nama_barang','name'=>'nama_barang','title'=>'Nama Barang'])
         ->addColumn(['data'=>'jumlah_barang','name'=>'jumlah_barang','title'=>'Jumlah'])
         ->addColumn(['data'=>'modeli.nama','name'=>'modeli.nama','title'=>'Model'])
         ->addColumn(['data'=>'harga','name'=>'harga','title'=>'Harga Per Satuan'])
         ->addColumn(['data'=>'action','name'=>'action','title'=>'','orderable'=>false,'searchable'=>false]);
         return view('admin.index')->with(compact('html'));
}
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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

        $barang = Barang::find($id);
        return view('admin.show',compact('barang'));
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
    }
}
