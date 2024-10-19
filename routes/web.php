<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KategoriCOAController;
use App\Http\Controllers\ChartOfAccountController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\ProfitLossController;
use App\Http\Controllers\AuthController;

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

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::middleware(['auth'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::resource('kategori-coa', KategoriCOAController::class);
    Route::put('kategori-coa/{id}', [KategoriCOAController::class, 'update'])->name('kategori-coa.update');

    Route::resource('transaksi', TransaksiController::class);

    Route::resource('chart-of-account', ChartOfAccountController::class);

    Route::get('/profit-loss', [ProfitLossController::class, 'index'])->name('profit-loss.index');
    Route::get('/profit-loss/export', [ProfitLossController::class, 'export'])->name('profit-loss.export');

    Route::get('/', function () {
        return view('index');
    });
});


