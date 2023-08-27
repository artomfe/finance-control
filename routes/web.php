<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    //Wallets routes
    Route::get('/wallets', function () {
        return Inertia::render('Application/Wallet');
    })->name('wallets');

     //Actives routes
     Route::get('/actives', function () {
        return Inertia::render('Application/Active');
    })->name('actives');

     //Cryptos routes
     Route::get('/cryptos', function () {
        return Inertia::render('Application/Crypto');
    })->name('cryptos');

     //Selic routes
     Route::get('/selic', function () {
        return Inertia::render('Application/Selic');
    })->name('selic');
});
