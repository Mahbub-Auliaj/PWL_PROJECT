<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\PengurusController;
use App\Http\Controllers\PinjamController;
use App\Http\Controllers\SimpanController;

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::resource('anggota',AnggotaController::class)->parameter('anggotum', 'anggota');
Route::resource('pengurus',PengurusController::class);
Route::resource('transaksi_simpan',SimpanController::class);
Route::resource('transaksi_pinjam',PinjamController::class);
Route::get('transaksi_simpans/cetak_pdf',[SimpanController::class,'cetak_pdf']);
