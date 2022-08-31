<?php

namespace App\Http\Controllers;
use App\Models\Barang;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BarangController extends Controller
{
    public function index(){
        $sql = "
            SELECT 
                b.id, b.kode, b.nama, ifnull( SUM(mb1.jumlah), 0) - ifnull( SUM(mb2.jumlah) , 0) as stok 
                FROM 
                    barang b 
                    left join mutasi_barang mb1 on b.id = mb1.id_barang and mb1.category = 'masuk' 
                    left join mutasi_barang mb2 on b.id = mb2.id_barang and mb2.category = 'keluar'
            GROUP BY  b.id, b.kode, b.nama
        ";
        $data =  DB::select($sql);
        //$data = DB::table('barang')->get();
        return view('barang.index', ['data' => $data]);
    }

    
    public function laporan(){
        $sql = "
            SELECT 
                b.id, b.kode, b.nama, ifnull( SUM(mb1.jumlah), 0) as masuk, ifnull( SUM(mb2.jumlah) , 0) as keluar 
                , ifnull( SUM(mb1.jumlah), 0) - ifnull( SUM(mb2.jumlah) , 0) as stok 
                FROM 
                    barang b 
                    left join mutasi_barang mb1 on b.id = mb1.id_barang and mb1.category = 'masuk' 
                    left join mutasi_barang mb2 on b.id = mb2.id_barang and mb2.category = 'keluar'
            GROUP BY  b.id, b.kode, b.nama
        ";
        $data =  DB::select($sql);
        //$data = DB::table('barang')->get();
        return view('barang.laporan', ['data' => $data]);
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
