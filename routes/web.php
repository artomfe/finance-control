<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\AssetController;
use App\Http\Controllers\CryptoController;
use App\Http\Controllers\WalletController;
use App\Http\Controllers\MovementController;
use App\Http\Controllers\WalletEarningController;
use App\Http\Controllers\SelicController;
use App\Http\Controllers\SelicYieldController;
use App\Http\Controllers\FinanceController;
use App\Http\Controllers\DashboardController;

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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    //Dashboard routes
    Route::get('/dashboard',[DashboardController::class, 'index'])->name('dashboard');

    //Wallets routes
    Route::get('/wallets/assets/{walletId}', [WalletController::class, 'assetDetail'])->name('wallets.assetDetail');
    Route::get('/wallets/cryptos/{walletId}', [WalletController::class, 'cryptoDetail'])->name('wallets.cryptoDetail');
    Route::get('/wallets', [WalletController::class, 'index'])->name('wallets');

    //Assets routes
    Route::get('/assets/create', [AssetController::class, 'create'])->name('assets.create');
    Route::post('/assets/store', [AssetController::class, 'store'])->name('assets.store');
    Route::post('/assets/update-prices', [AssetController::class, 'updateAssetQuotes'])->name('assets.updatePrices');
    Route::get('/assets/{asset}/edit', [AssetController::class, 'edit'])->name('assets.edit');
    Route::put('/assets/{asset}/update', [AssetController::class, 'update'])->name('assets.update');
    Route::delete('/assets/{asset}', [AssetController::class, 'destroy'])->name('assets.destroy');
    Route::get('/assets', [AssetController::class, 'index'])->name('assets');

    //Cryptos routes
    Route::delete('/cryptos/{crypto}', [CryptoController::class, 'destroy'])->name('cryptos.destroy');
    Route::post('/cryptos/update-prices', [CryptoController::class, 'updateCryptoPrices'])->name('cryptos.updatePrices');
    Route::get('/cryptos', [CryptoController::class, 'index'])->name('cryptos');

    //Movements routes
    Route::get('/movements/{type}', [MovementController::class, 'index'])->name('movements');
    Route::post('/movements/store', [MovementController::class, 'store'])->name('movements.store');

    //Yields routes
    Route::get('/yields', [WalletEarningController::class, 'index'])->name('yields');
    Route::post('/yields/store', [WalletEarningController::class, 'store'])->name('yields.store');

    //Selic routes
    Route::get('/selics', [SelicController::class, 'index'])->name('selics');
    Route::get('/selics/yields', [SelicYieldController::class, 'index'])->name('selics.yields');
    Route::post('/selics/yields/store', [SelicYieldController::class, 'store'])->name('selics.yields.store');

    //Finance routes
    Route::get('/finances', [FinanceController::class, 'index'])->name('finances');
    Route::post('/finances/update', [FinanceController::class, 'update'])->name('finances.update');
});
