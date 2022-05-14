<?php

namespace App\Http\Controllers;
use App\Models\Barang;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BarangController extends Controller
{
    public function index(){
        $data = DB::table('barang')->get();
        return view('barang.index', ['data' => $data]);
    }

    public function store(Request $request){
        $data = new Barang($request->all());
        $data->save();
        return response()->json(array(
            'success' => true,
            'last_insert_id' => $data->id
        ), 200);
    }
}
