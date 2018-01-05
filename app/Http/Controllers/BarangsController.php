<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Html\Builder;
use Yajra\Datatables\Datatables;
use App\Barang;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;
use App\Http\Requests\StoreBarangRequest;
use App\Http\Requests\UpdateBarangRequest;

class BarangsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request,Builder $htmlBuilder)
    {
        //
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
         return view('barangs.index')->with(compact('html'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('barangs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBarangRequest $request)
    {
        //
       
        $barang = Barang::create($request->except('cover'));

        //Isi field cover jika ada cover yang diupload
        if ($request->hasFile('cover')) {
            //Mengambil file yang di upload
            $uploaded_cover = $request->file('cover');
            //Mengambil extension file
            $extension = $uploaded_cover->getClientOriginalExtension();
            //Membuat nama file random berikut extension
            $filename = md5(time()) . '.'. $extension;
            //menyimpan cover ke folder public/img
            $destinationPath = public_path() . DIRECTORY_SEPARATOR .'img';
            $uploaded_cover->move($destinationPath,$filename);
            //mengisi field cover di book dengan file name yamg baru dibuat
            $barang->cover = $filename;
            $barang->save();
        }

        Session::flash("flash_notification",["level"=>"success","message"=>"Berhasil menyimpan $barang->nama_barang"]);
        return redirect()->route('barangs.index');

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

        $barang = Barang::find($id);
        return view('barangs.edit')->with(compact('barang'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBarangRequest $request, $id)
    {
        

        $barang = Barang::find($id);
        $barang->update($request->all());

        if ($request->hasFile('cover')) {
         
            $filename = null;
            $uploaded_cover = $request->file('cover');
            $extension = $uploaded_cover->getClientOriginalExtension();

            //Membuat nama file random berikut extension
            $filename = md5(time()) . '.'. $extension;
            $destinationPath = public_path() . DIRECTORY_SEPARATOR .'img';

            $uploaded_cover->move($destinationPath,$filename);
           if ($barang->cover) {
                $old_cover = $barang->cover;
                $filepath = public_path() . DIRECTORY_SEPARATOR .'img' . DIRECTORY_SEPARATOR . $barang->cover;

            try {
                File::delete($filepath);
            } catch (FileNotFoundException $e) {
                //File sudah dihapus/tidak ada
            }
            
        }
         //ganti field cover dengan cover yang baru
        $barang->cover = $filename;
        $barang->save();
    }
        Session::flash("flash_notification", ["level"=>"success","message"=>"Berhasil menyimpan  $barang->nama_barang"]);
        return redirect()->route('barangs.index');
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
           //
        $barang = Barang::find($id);

        if($barang->cover) {
            $old_cover =$barang->cover;
            $filepath = public_path() . DIRECTORY_SEPARATOR .'img' . DIRECTORY_SEPARATOR . $barang->cover;
        try {
                File::delete($filepath);
            } catch (FileNotFoundException $e) {
              //file sudah dihapus tidak ada
 
        }
    }
    $barang->delete();
    
    Session::flash("flash_notification",["level"=>"success","message"=>"$barang->nama_barang Berhasil Dihapus"]);
    return redirect()->route('barangs.index');
    }
}
