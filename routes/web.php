<?php

use App\Http\Controllers\Ketua\DashboardController;
use App\Http\Controllers\Ketua\WargaController;
use App\Http\Controllers\WelcomeController;
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

Route::get('/', [WelcomeController::class, 'index']);
Route::get('/login', [WelcomeController::class, 'login']);

Route::get('/ketua', [WelcomeController::class, 'ketua']);
Route::group(['prefix' => 'ketua/dashboard'], function () {
    Route::get('/', [DashboardController::class, 'index']);
});
Route::group(['prefix' => 'ketua/warga'], function () {
    Route::get('/', [WargaController::class, 'index']);
    Route::post('/list', [WargaController::class, 'list']);
    Route::get('/{id}', [WargaController::class, 'show']);
});

Route::get('/sekretaris', [WelcomeController::class, 'sekretaris']);

Route::get('/bendahara', [WelcomeController::class, 'bendahara']);

Route::get('/warga', [WelcomeController::class, 'warga']);
