<?php

namespace App\Http\Controllers;
use App\Models\Mutasi_barang;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class MutasiBarangController extends Controller
{
    public function index(){
        foreach (Mutasi_barang::all() as $b) {
            echo $b->harga;
        }
    }
}
