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
        Route::match(['get', 'post'], 'dompet/add', ['as' => 'dompet.add', 'uses' => DompetController::class . '@add']);
        Route::match(['get', 'post'], 'dompet/edit/{id}', ['as' => 'dompet.edit', 'uses' => DompetController::class . '@edit']);
        Route::get('dompet/detail/{id}', ['as' => 'dompet.detail', 'uses' => DompetController::class . '@detail']);
        Route::match(['get', 'post'], 'dompet/{id_status?}', ['as' => 'dompet', 'uses' => DompetController::class . '@index']);

        Route::match(['get', 'post'], 'kategori/add', ['as' => 'kategori.add', 'uses' => KategoriController::class . '@add']);
        Route::match(['get', 'post'], 'kategori/edit/{id}', ['as' => 'kategori.edit', 'uses' => KategoriController::class . '@edit']);
        Route::get('kategori/detail/{id}', ['as' => 'kategori.detail', 'uses' => KategoriController::class . '@detail']);
        Route::match(['get', 'post'], 'kategori/{id_status?}', ['as' => 'kategori', 'uses' => KategoriController::class . '@index']);
    });

    Route::group(['prefix' => 'transaksi', 'as' => 'transaksi.'], function () {
        Route::get('dompet-masuk', ['as' => 'dompet.masuk', 'uses' => DompetMasukController::class . '@index']);
        Route::match(['get', 'post'], 'dompet-masuk/add', ['as' => 'dompet.masuk.add', 'uses' => DompetMasukController::class . '@add']);
        Route::get('dompet-keluar', ['as' => 'dompet.keluar', 'uses' => DompetKeluarController::class . '@index']);
        Route::match(['get', 'post'], 'dompet-keluar/add', ['as' => 'dompet.keluar.add', 'uses' => DompetKeluarController::class . '@add']);
    });

    Route::group(['prefix' => 'laporan', 'as' => 'laporan.'], function () {
        Route::match(['get', 'post'], 'transaksi', ['as' => 'transaksi', 'uses' => LaporanTransaksiController::class . '@index']);
    });
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';
