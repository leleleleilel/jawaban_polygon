<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;

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
    return redirect('/login');
});

Route::get('/login', [AuthController::class, 'gotologin']);
Route::get('/logout', [AuthController::class, 'logout']);

Route::post('/login', [AuthController::class, 'login']);

Route::get('/dashboard', [DashboardController::class, 'gotodashboard']);

Route::get('/transaction', [TransactionController::class, 'gototransaction']);
Route::post('/transaction', [TransactionController::class, 'insertTransaction']);

Route::get('/confirm/{id}', [DashboardController::class, 'konfirmasiTransaksi']);
Route::post('/transaction/edit/{id}', [DashboardController::class, 'editData']);
Route::get('/delete/{id}', [DashboardController::class, 'deleteData']);

Route::get('/transaction/edit/{id}', [DashboardController::class, 'gotoedittransaction']);
