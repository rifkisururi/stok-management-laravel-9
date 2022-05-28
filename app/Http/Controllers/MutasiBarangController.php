<?php

namespace App\Http\Controllers;
use App\Models\Barang;
use App\Models\Mutasi_barang;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class MutasiBarangController extends Controller
{

    public function index(){
        $mulai = $_GET['mulai'];
        $selesai = $_GET['selesai'];

        if($mulai == '0000-00-00' && '0000-00-00' == $selesai){
            $data = DB::table('mutasi_barang')
            ->join('barang', 'barang.id', '=', 'mutasi_barang.id_barang')
            ->select('barang.nama', 'barang.kode', 'mutasi_barang.*')
            ->get();
        }else{
            $data = DB::table('mutasi_barang')
            ->join('barang', 'barang.id', '=', 'mutasi_barang.id_barang')
            ->where('mutasi_barang.tanggal','>=',$mulai)
            ->where('mutasi_barang.tanggal','<=',$selesai)
            ->select('barang.nama', 'barang.kode', 'mutasi_barang.*')
            ->get();
        }

        $barang = DB::table('barang')->get();
        return view('mutasi.index', ['data' => $data, 'barang' => $barang]);
    }
    
    public function masuk(){
        $mulai = $_GET['mulai'];
        $selesai = $_GET['selesai'];

        if($mulai == '0000-00-00' && '0000-00-00' == $selesai){
            $data = DB::table('mutasi_barang')
            ->join('barang', 'barang.id', '=', 'mutasi_barang.id_barang')
            ->where('mutasi_barang.category','=','masuk')
            ->select('barang.nama', 'barang.kode', 'mutasi_barang.*')
            ->get();
        }else{
            $data = DB::table('mutasi_barang')
            ->join('barang', 'barang.id', '=', 'mutasi_barang.id_barang')
            ->where('mutasi_barang.tanggal','>=',$mulai)
            ->where('mutasi_barang.tanggal','<=',$selesai)
            ->where('mutasi_barang.category','=','masuk')
            ->select('barang.nama', 'barang.kode', 'mutasi_barang.*')
            ->get();
        }

        $barang = DB::table('barang')->get();
        return view('mutasi.masuk', ['data' => $data, 'barang' => $barang]);
    }
    public function keluar(){
        $mulai = $_GET['mulai'];
        $selesai = $_GET['selesai'];

        if($mulai == '0000-00-00' && '0000-00-00' == $selesai){
            $data = DB::table('mutasi_barang')
            ->join('barang', 'barang.id', '=', 'mutasi_barang.id_barang')
            ->where('mutasi_barang.category','=','keluar')
            ->select('barang.nama', 'barang.kode', 'mutasi_barang.*')
            ->get();
        }else{
            $data = DB::table('mutasi_barang')
            ->join('barang', 'barang.id', '=', 'mutasi_barang.id_barang')
            ->where('mutasi_barang.tanggal','>=',$mulai)
            ->where('mutasi_barang.tanggal','<=',$selesai)
            ->where('mutasi_barang.category','=','keluar')
            ->select('barang.nama', 'barang.kode', 'mutasi_barang.*')
            ->get();
        }

        $barang = DB::table('barang')->get();
        return view('mutasi.keluar', ['data' => $data, 'barang' => $barang]);
    }
    
    public function store(Request $request){
        $data = new Mutasi_barang($request->all());
        $data->save();
        $barang = DB::table('barang')->where('id', $request->id_barang)->first();
        return response()->json(array(
            'success' => true,
            'last_insert_id' => $data->id,
            'kode' => $barang->kode,
            'nama' => $barang->nama
        ), 200);
    }

    public function update(Request $request)
    {
        $id = $request->id;
        $data = Mutasi_barang::find($id);
        $data->id_barang = $request->id_barang;
        $data->tanggal = $request->tanggal;
        $data->jumlah = $request->jumlah;
        $data->harga = $request->harga;
        $data->category = $request->category;
        $data->save();
        $barang = DB::table('barang')->where('id', $request->id_barang)->first();
        return response()->json(array(
            'success' => true,
            'kode' => $barang->kode,
            'nama' => $barang->nama
        ), 200);
    }

    public function hapus(Request $request)
    {
        Mutasi_barang::where('id',$request->id)->delete();
        return response()->json(array(
            'success' => true
        ), 200);
    }
}
