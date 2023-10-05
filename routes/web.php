<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CodigoController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('Auth.login');
});

//AuthController
Route::post('sesion',[AuthController::class,'login'])->name('sesion');
Route::get('login',[AuthController::class,'index'])->name('login');
Route::get('registrar',[AuthController::class,'registrar'])->name('registrar');
Route::post('signUp',[AuthController::class,'signUp'])->name('signUp');

Route::middleware(['auth'])->group(function () {
    Route::get('dashboard',[AuthController::class,'dashboard'])->name('dashboard');
    Route::get('signout',[AuthController::class,'singOut'])->name('signout');
});

Route::post('decrypt',[CodigoController::class,'decrypt']);
Route::post('encryptWeb',[CodigoController::class,'encryptWeb']);


