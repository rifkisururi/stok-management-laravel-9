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

    public function update(Request $request)
    {
        $id = $request->id;
        $data = Barang::find($id);
        $data->nama = $request->nama;
        $data->kode = $request->kode;
        $data->save();

        return response()->json(array(
            'success' => true
        ), 200);
    }

    public function hapus(Request $request)
    {
        Barang::where('id',$request->id)->delete();
        return response()->json(array(
            'success' => true
        ), 200);
    }
}
