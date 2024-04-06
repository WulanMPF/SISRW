<?php

use App\Http\Controllers\Ketua\DashboardController;
use App\Http\Controllers\Ketua\WargaController;
use App\Http\Controllers\Ketua\UmkmController;
use App\Http\Controllers\Ketua\PengaduanController;
use App\Http\Controllers\Ketua\IuranController;
use App\Http\Controllers\Ketua\BansosController;
use App\Http\Controllers\Ketua\LapkeuController;
use App\Http\Controllers\Sekretaris\DashboardController as SekretarisDashboardController;
use App\Http\Controllers\Sekretaris\PengumumanController;
use App\Http\Controllers\Sekretaris\UmkmController as SekretarisUmkmController;
use App\Http\Controllers\Sekretaris\BansosController as SekretarisBansosController;
use App\Http\Controllers\Sekretaris\WargaController as SekretarisWargaController;
use App\Http\Controllers\Bendahara\IuranController as BendaharaIuranController;
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

// Route Landing Page
Route::get('/', [WelcomeController::class, 'index']);

//Route Login Page
Route::get('/login', [WelcomeController::class, 'login']);

//Route Halaman Ketua RW
Route::get('/ketua', [WelcomeController::class, 'ketua']);
Route::group(['prefix' => 'ketua/dashboard'], function () {
    Route::get('/', [DashboardController::class, 'index']);
});
Route::group(['prefix' => 'ketua/warga'], function () {
    Route::get('/', [WargaController::class, 'index']);
    Route::post('/list', [WargaController::class, 'list']);
    Route::get('/{id}', [WargaController::class, 'show']);
});
Route::group(['prefix' => 'ketua/umkm'], function () {
    Route::get('/', [UmkmController::class, 'index']);
    Route::post('/list', [UmkmController::class, 'list']);
    Route::get('/{id}', [UmkmController::class, 'show']);
});
Route::group(['prefix' => 'ketua/bansos'], function () {
    Route::get('/', [BansosController::class, 'index']);
    Route::post('/list', [BansosController::class, 'list']);
    Route::get('/{id}', [BansosController::class, 'show']);
});
Route::group(['prefix' => 'ketua/laporan'], function () {
    Route::get('/', [LapkeuController::class, 'index']);
    Route::post('/list', [LapkeuController::class, 'list']);
    Route::get('/{id}', [LapkeuController::class, 'show']);
});
Route::group(['prefix' => 'ketua/pengaduan'], function () {
    Route::get('/', [PengaduanController::class, 'index']);
    Route::post('/list', [PengaduanController::class, 'list']);
});
Route::group(['prefix' => 'ketua/iuran'], function () {
    Route::get('/', [IuranController::class, 'index']);
    Route::post('/list', [IuranController::class, 'list']);
});

// Route Halaman Sekretaris RW
Route::get('/sekretaris', [WelcomeController::class, 'sekretaris']);
Route::group(['prefix' => 'sekretaris/dashboard'], function () {
    Route::get('/', [SekretarisDashboardController::class, 'index']);
});
Route::group(['prefix' => 'sekretaris/warga'], function () {
    Route::get('/', [SekretarisWargaController::class, 'index']);
    Route::post('/list', [SekretarisWargaController::class, 'list']);
    Route::get('/{id}', [SekretarisWargaController::class, 'show']);
});
Route::group(['prefix' => 'sekretaris/pengumuman'], function () {
    Route::get('/', [PengumumanController::class, 'index']);
    Route::get('/{id}', [PengumumanController::class, 'show']);
});
Route::group(['prefix' => 'sekretaris/umkm'], function () {
    Route::get('/', [SekretarisUmkmController::class, 'index']);
    Route::post('/list', [SekretarisUmkmController::class, 'list']);
    Route::get('/{id}', [SekretarisUmkmController::class, 'show']);
});
Route::group(['prefix' => 'sekretaris/bansos'], function () {
    Route::get('/', [SekretarisBansosController::class, 'index'])->name('sekretaris.bansos.index');
    Route::post('/list', [SekretarisBansosController::class, 'list'])->name('sekretaris.bansos.list');
    Route::get('/{id}', [SekretarisBansosController::class, 'show'])->name('sekretaris.bansos.show');
});



// Route Halaman Bendahara RW
Route::get('/bendahara', [WelcomeController::class, 'bendahara']);
Route::group(['prefix' => 'bendahara/iuran'], function () {
    Route::get('/', [BendaharaIuranController::class, 'index'])->name('bendahara.iuran.index');
    Route::post('/list', [BendaharaIuranController::class, 'list'])->name('bendahara.iuran.list');
    Route::get('/{id}', [BendaharaIuranController::class, 'show'])->name('bendahara.iura.show');
});
// Route Halaman Warga
Route::get('/warga', [WelcomeController::class, 'warga']);
