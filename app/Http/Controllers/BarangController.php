<?php

namespace App\Http\Controllers;
use App\Models\Barang;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function index(){
        foreach (Barang::all() as $b) {
            echo $b->nama;
        }
    }
}
