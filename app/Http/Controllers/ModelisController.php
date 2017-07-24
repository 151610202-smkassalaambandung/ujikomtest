<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Modeli;
use Yajra\Datatables\Html\Builder;
use Yajra\Datatables\Datatables;
use Session;


class ModelisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Builder $htmlBuilder)
    {
        if ($request->ajax()){
            $modelis = Modeli::select(['id', 'nama']);
            return Datatables::of($modelis)
            ->addColumn('action', function($modeli){
                return view('datatable._action', [
                'model' => $modeli,
                'form_url' => route('modelis.destroy',$modeli->id), 
                'edit_url' => route('modelis.edit',$modeli->id),
                'confirm_message' => 'Yakin mau Menghapus'. $modeli->nama .'?'
                ]);
        })->make(true);
        

        }
        $html = $htmlBuilder
        ->addColumn(['data'=>'nama','name'=>'nama','title'=>'Model'])
        ->addColumn(['data'=>'action','name'=>'action','title'=>'','orderable'=>false,'searchable'=>false]);
        return view('modelis.index')->with(compact('html'));
    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('modelis.create');
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
        $this->validate($request,['nama'=>'required|unique:modelis']);
        $modeli = Modeli::create($request->only('nama'));
        Session::flash("flash_notification",["level"=>"success","message"=>"Berhasil menyimpan $modeli->nama"]);
        return redirect()->route('modelis.index');
   
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
        $modeli = Modeli::find($id);
        return view('modelis.edit')->with(compact('modeli'));
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
        $this->validate($request, ['nama' =>'required|unique:modelis,nama,'.$id]);
        $modeli = Modeli::find($id);
        $modeli->update($request->only('nama'));
        Session::flash('flash_notification', ["level"=>"success", "message"=>"Berhasil menyimpan $modeli->name"]);
        return redirect()->route('modelis.index');

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
        Modeli::destroy($id);

        Session::flash("flash_notification", ["level"=>"success","message"=>"Model berhasil dihapus"]);
        return redirect()->route('modelis.index');
   
    }
}
