<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\MutasiBarangController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/', function () { return view('welcome');});
Route::get('/',[CustomAuthController:: class,'index'])->name('login');

Route::get('login',[CustomAuthController:: class,'index'])->name('login');
Route::get('registration',[CustomAuthController:: class,'registration'])->name('registration');
Route::POST('custom-registration',[CustomAuthController:: class,'customRegistration'])->name('custom.registration');
Route::POST('custom-login',[CustomAuthController:: class,'customLogin'])->name('custom.login');
Route::get('dashboard',[CustomAuthController:: class,'dashboard'])->name('dashboard');
Route::get('logout',[CustomAuthController:: class,'logOut'])->name('logout');

// Barang
Route::get('barang',[BarangController:: class,'index'])->name('list-barang');
Route::POST('barang/store',[BarangController:: class,'store']);
Route::POST('barang/update',[BarangController:: class,'update']);
Route::POST('barang/hapus',[BarangController:: class,'hapus']);


// Mutasi barang
Route::get('mutasibarang',[MutasiBarangController:: class,'index'])->name('list-mutasi');
Route::get('mutasibarangmasuk',[MutasiBarangController:: class,'masuk'])->name('mutasi-masuk');
Route::get('mutasibarangkeluar',[MutasiBarangController:: class,'keluar'])->name('mutasi-keluar');
Route::POST('mutasibarang/store',[MutasiBarangController:: class,'store']);
Route::POST('mutasibarang/update',[MutasiBarangController:: class,'update']);
Route::POST('mutasibarang/hapus',[MutasiBarangController:: class,'hapus']);

Route::get('rekapitulasi',[MutasiBarangController:: class,'rekapitulasi'])->name('rekapitulasi');
Route::get('cetak',[MutasiBarangController:: class,'cetak'])->name('cetak');


