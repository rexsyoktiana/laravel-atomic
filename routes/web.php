<?php

use App\Http\Controllers\Laporan\LaporanTransaksiController;
use App\Http\Controllers\Master\DompetController;
use App\Http\Controllers\Master\KategoriController;
use App\Http\Controllers\Transaksi\DompetKeluarController;
use App\Http\Controllers\Transaksi\DompetMasukController;
use Illuminate\Support\Facades\Route;

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

Route::middleware(['auth'])->group(function () {
    Route::group(['prefix' => 'master', 'as' => 'master.'], function () {
        Route::get('dompet', ['as' => 'dompet', 'uses' => DompetController::class . '@index']);
        Route::get('kategori', ['as' => 'kategori', 'uses' => KategoriController::class . '@index']);
    });

    Route::group(['prefix' => 'transaksi', 'as' => 'transaksi.'], function () {
        Route::get('dompet-masuk', ['as' => 'dompet.masuk', 'uses' => DompetMasukController::class . '@index']);
        Route::get('dompet-keluar', ['as' => 'dompet.keluar', 'uses' => DompetKeluarController::class . '@index']);
    });

    Route::group(['prefix' => 'laporan', 'as' => 'laporan.'], function () {
        Route::get('transaksi', ['as' => 'transaksi', 'uses' => LaporanTransaksiController::class . '@index']);
    });
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';
