<?php

use App\Http\Controllers\WalletController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Storage;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('logout', 'logout');
    Route::post('refresh', 'refresh');
    Route::put('profile','profileedit');
    Route::get('profile','profile');
});

Route::get('/categories', [CategoryController::class, 'index']);
Route::post('/categories', [CategoryController::class, 'store']);

Route::group(['prefix'=>'transcations','as'=>'transcation.'], function(){
    Route::get('/', [TransactionController::class, 'index'])->name('index');
    Route::get('/{id}',[TransactionController::class,'show']);
    Route::post('/store', [TransactionController::class, 'store'])->name('store');
    Route::delete('/destroy/{id}', [TransactionController::class, 'destroy'])->name('destroy');
});

Route::group(['prefix'=>'wallets','as'=>'wallet.'], function(){
    Route::get('/', [WalletController::class, 'index'])->name('index');
//    Route::get('/{id}',[TransactionController::class,'show']);
    Route::post('/store', [WalletController::class, 'store'])->name('store');
//    Route::delete('/destroy/{id}', [TransactionController::class, 'destroy'])->name('destroy');
});
