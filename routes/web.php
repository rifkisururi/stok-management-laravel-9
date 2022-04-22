<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomAuthController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('login',[CustomAuthController:: class,'index'])->name('login');
Route::get('registration',[CustomAuthController:: class,'registration'])->name('registration');
Route::POST('custom-registration',[CustomAuthController:: class,'customRegistration'])->name('custom.registration');
Route::POST('custom-login',[CustomAuthController:: class,'customLogin'])->name('custom.login');
Route::get('dashboard',[CustomAuthController:: class,'dashboard'])->name('dashboard');
Route::get('logout',[CustomAuthController:: class,'logOut'])->name('logout');


