<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Yajra\Datatables\Html\Builder;
use Yajra\Datatables\Datatables;
use App\Barang;
use App\Modeli;

use Laratrust\LaratrustFacade as Laratrust;

class GuestController extends Controller
{
    //
    public function index(Request $request, Builder $htmlBuilder)
    {
    	$barang = Barang::all();

    	return view('guest.index')->with(compact('barang','model'));
    }
}
