<?php

use App\Http\Controllers\Bendahara\DashboardController as BendaharaDashboardController;
use App\Http\Controllers\Ketua\DashboardController;
use App\Http\Controllers\Ketua\WargaController;
use App\Http\Controllers\Ketua\UmkmController;
use App\Http\Controllers\Ketua\PengaduanController;
use App\Http\Controllers\Ketua\IuranController;
use App\Http\Controllers\Ketua\BansosController;
use App\Http\Controllers\Ketua\LapkeuController;
use App\Http\Controllers\Sekretaris\DashboardController as SekretarisDashboardController;
use App\Http\Controllers\Sekretaris\PengumumanController;
use App\Http\Controllers\sekretaris\SyaratBansosController as SekretarisSyaratBansosController;
use App\Http\Controllers\Sekretaris\UmkmController as SekretarisUmkmController;
use App\Http\Controllers\Sekretaris\BansosController as SekretarisBansosController;
use App\Http\Controllers\Sekretaris\WargaController as SekretarisWargaController;
use App\Http\Controllers\Bendahara\IuranController as BendaharaIuranController;
use App\Http\Controllers\Bendahara\LapkeuController as BendaharaLapkeuController;
use App\Http\Controllers\Bendahara\ProfileController as BendaharaProfileController;
use App\Http\Controllers\Ketua\ArsipSuratController;
use App\Http\Controllers\Ketua\ProfileController;
use App\Http\Controllers\Login\LoginController;
use App\Http\Controllers\Sekretaris\ProfileController as SekretarisProfileController;
use App\Http\Controllers\Sekretaris\SuratController as SekretarisSuratController;
use App\Http\Controllers\Warga\IuranController as WargaIuranController;
use App\Http\Controllers\Warga\PengaduanController as WargaPengaduanController;
use App\Http\Controllers\Warga\AjukanPersuratanController as AjukanPersuratanController;
use App\Http\Controllers\Warga\DashboardController as WargaDashboardController;
use App\Http\Controllers\Warga\SyaratBansosController as WargaSyaratBansosController;
use App\Http\Controllers\Warga\UmkmController as WargaUmkmController;
use App\Http\Controllers\Warga\ProfileController as WargaProfileController;
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

Route::get('/', function () {
    return view('landingpage.index');
});

// Route::get('/', [WelcomeController::class, 'index']);

// Route Landing Page
Route::get('/', [WelcomeController::class, 'index']);

//Route Login Page
Route::get('/login', [LoginController::class, 'index'])->name('login');
// Route::post('proses_login', [LoginController::class, 'proses_login'])->name('proses_login');
// Route::get('logout', [LoginController::class, 'logout'])->name('logout');

//Middleware Login
// Route::group(['middleware' => ['auth']], function () {

//     // Route::group(['middleware' => ['cek_login:1']], function () {
//     //     Route::resource('admin', AdminController::class);
//     // });
//     Route::group(['middleware' => ['cek_login:2']], function () {
//         Route::resource('ketua', WelcomeController:: class);
//     });
//     Route::group(['middleware' => ['cek_login:3']], function () {
//         Route::resource('sekretaris', WelcomeController:: class);
//     });
//     Route::group(['middleware' => ['cek_login:4']], function () {
//         Route::resource('bendahara', WelcomeController:: class);
//     });
//     Route::group(['middleware' => ['cek_login:5']], function () {
//         Route::resource('warga', WelcomeController:: class);
//     });
// });

//Route Halaman Ketua RW
Route::group(['prefix' => 'ketua/dashboard'], function () {
    Route::get('/', [DashboardController::class, 'index']);
});
Route::group(['prefix' => 'ketua/warga'], function () {
    Route::get('/', [WargaController::class, 'index']);
    Route::post('/list', [WargaController::class, 'list']);
    Route::get('/create-tetap', [WargaController::class, 'createTetap']);
    Route::post('/tetap', [WargaController::class, 'storeTetap']);
    Route::get('/create-sementara', [WargaController::class, 'createSementara']);
    Route::post('/sementara', [WargaController::class, 'storeSementara']);
    Route::get('/{id}', [WargaController::class, 'show']);
});
Route::group(['prefix' => 'ketua/surat'], function () {
    Route::get('/', [ArsipSuratController::class, 'index']);
    Route::post('/list', [ArsipSuratController::class, 'list']);
    Route::get('/create-undangan', [ArsipSuratController::class, 'createUndangan']);
    Route::post('/undangan', [ArsipSuratController::class, 'storeUndangan']);
    Route::get('/{id}', [ArsipSuratController::class, 'show']);
    Route::delete('/{id}', [ArsipSuratController::class, 'destroy']);
});
Route::group(['prefix' => 'ketua/umkm'], function () {
    Route::get('/', [UmkmController::class, 'index']);
    Route::post('/list', [UmkmController::class, 'list']);
    Route::get('/create', [UmkmController::class, 'create']);
    Route::post('/', [UmkmController::class, 'store'])->name('tambahUMKM');
    Route::get('/{id}', [UmkmController::class, 'show']);
    Route::get('/{id}/edit', [UmkmController::class, 'edit']);
    Route::put('/{id}', [UmkmController::class, 'update']);
    Route::delete('/{id}', [UmkmController::class, 'destroy']);
});
Route::group(['prefix' => 'ketua/bansos'], function () {
    Route::get('/', [BansosController::class, 'index']);
    Route::post('/list', [BansosController::class, 'list']);
    Route::get('/create', [BansosController::class, 'create']);
    Route::post('/', [BansosController::class, 'store']);
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
    Route::get('/{id}', [PengaduanController::class, 'show'])->name('pengaduan.show');
});
Route::group(['prefix' => 'ketua/iuran'], function () {
    Route::get('/', [IuranController::class, 'index']);
    Route::post('/list', [IuranController::class, 'list']);
});
Route::group(['prefix' => 'ketua/profile'], function () {
    Route::get('/', [ProfileController::class, 'index']);
    // Route::post('/list', [ProfileController::class, 'list']);
});

// Route Halaman Sekretaris RW
Route::group(['prefix' => 'sekretaris/dashboard'], function () {
    Route::get('/', [SekretarisDashboardController::class, 'index']);
});
Route::group(['prefix' => 'sekretaris/warga'], function () {
    Route::get('/', [SekretarisWargaController::class, 'index']);
    Route::post('/list', [SekretarisWargaController::class, 'list']);
    Route::get('/create-tetap', [SekretarisWargaController::class, 'createTetap']);
    Route::post('/', [SekretarisWargaController::class, 'storeTetap']);
    Route::get('/create-sementara', [SekretarisWargaController::class, 'createSementara']);
    Route::post('/', [SekretarisWargaController::class, 'storeSementara']);
    Route::get('/{id}', [SekretarisWargaController::class, 'show']);
});
Route::group(['prefix' => 'sekretaris/surat'], function () {
    Route::get('/', [SekretarisSuratController::class, 'index']);
    Route::post('/list', [SekretarisSuratController::class, 'list']);
    Route::get('/create', [SekretarisSuratController::class, 'create']);
    Route::post('/', [SekretarisSuratController::class, 'store']);
    Route::get('/{id}', [SekretarisSuratController::class, 'show']);
    Route::delete('/{id}', [SekretarisSuratController::class, 'destroy']);
});
Route::group(['prefix' => 'sekretaris/pengumuman'], function () {
    Route::get('/', [PengumumanController::class, 'index']);
    Route::get('/{id}', [PengumumanController::class, 'show']);
});
Route::group(['prefix' => 'sekretaris/skBansos'], function () {
    Route::get('/', [SekretarisSyaratBansosController::class, 'index']);
    Route::post('/list', [SekretarisSyaratBansosController::class, 'list']);
    Route::get('/create', [SekretarisSyaratBansosController::class, 'create']);
    Route::post('/', [SekretarisSyaratBansosController::class, 'store'])->name('sk_bansos.store');
    Route::get('/{id}', [SekretarisSyaratBansosController::class, 'show']);
});

Route::group(['prefix' => 'sekretaris/umkm'], function () {
    Route::get('/', [SekretarisUmkmController::class, 'index']);
    Route::post('/list', [SekretarisUmkmController::class, 'list']);
    Route::get('/create', [SekretarisUmkmController::class, 'create']);
    Route::post('/', [SekretarisUmkmController::class, 'store'])->name('tambahSekreUMKM');
    Route::get('/{id}', [SekretarisUmkmController::class, 'show']);
    Route::get('/{id}/edit', [SekretarisUmkmController::class, 'edit']);
    Route::put('/{id}', [SekretarisUmkmController::class, 'update']);
});
Route::group(['prefix' => 'sekretaris/bansos'], function () {
    Route::get('/', [SekretarisBansosController::class, 'index'])->name('sekretaris.bansos.index');
    Route::post('/list', [SekretarisBansosController::class, 'list'])->name('sekretaris.bansos.list');
    Route::get('/{id}', [SekretarisBansosController::class, 'show'])->name('sekretaris.bansos.show');
});
Route::group(['prefix' => 'sekretaris/profile'], function () {
    Route::get('/', [SekretarisProfileController::class, 'index']);
});

// Route Halaman Bendahara RW
Route::group(['prefix' => 'bendahara/dashboard'], function () {
    Route::get('/', [BendaharaDashboardController::class, 'index']);
});
Route::group(['prefix' => 'bendahara/iuran'], function () {
    Route::get('/', [BendaharaIuranController::class, 'index'])->name('bendahara.iuran.index');
    Route::post('/list', [BendaharaIuranController::class, 'list'])->name('bendahara.iuran.list');
    Route::get('/detail/{bulan}', [BendaharaIuranController::class, 'detail'])->name('bendahara.iuran.detail');
    Route::get('/{id}', [BendaharaIuranController::class, 'show'])->name('bendahara.iuran.show');
});
Route::group(['prefix' => 'bendahara/laporan'], function () {
    Route::get('/', [BendaharaLapkeuController::class, 'index']);
    Route::post('/list', [BendaharaLapkeuController::class, 'list']);
    Route::get('/create', [BendaharaLapkeuController::class, 'create'])->name('laporan.create');
    Route::post('/', [BendaharaLapkeuController::class, 'store'])->name('laporan.store');
    Route::get('/{id}', [BendaharaLapkeuController::class, 'show']);
});
Route::group(['prefix' => 'bendahara/profile'], function () {
    Route::get('/', [BendaharaProfileController::class, 'index']);
});

// Route Halaman Warga
Route::group(['prefix' => 'warga/dashboard'], function () {
    Route::get('/', [WargaDashboardController::class, 'index']);
});
Route::group(['prefix' => 'warga/iuran'], function () {
    Route::get('/', [WargaIuranController::class, 'index']);
    Route::post('/list', [WargaIuranController::class, 'list']);
    Route::get('/{id}', [WargaIuranController::class, 'show']);
});

Route::group(['prefix' => 'warga/pengaduan'], function () {
    Route::get('/', [WargaPengaduanController::class, 'index']);
    Route::post('/list', [WargaPengaduanController::class, 'list']);
    Route::post('/pengaduan', [WargaPengaduanController::class, 'store'])->name('pengaduan.store');
});

Route::group(['prefix' => 'warga/surat'], function () {
    Route::get('/', [AjukanPersuratanController::class, 'index']);
    Route::get('/create', [AjukanPersuratanController::class, 'create'])->name('ajukanpersuratan.create');
    Route::post('/list', [AjukanPersuratanController::class, 'list']);
});

Route::group(['prefix' => 'warga/umkm'], function () {
    Route::get('/', [WargaUmkmController::class, 'index']);
    Route::post('/list', [WargaUmkmController::class, 'list']);
    Route::get('/create', [WargaUmkmController::class, 'create']);
    Route::post('/', [WargaUmkmController::class, 'store'])->name('umkm.store');
    Route::get('/{id}', [WargaUmkmController::class, 'show']);
});

Route::group(['prefix' => 'warga/bansos'], function () {
    Route::get('/', [WargaSyaratBansosController::class, 'index']);
    Route::get('/{id}', [WargaSyaratBansosController::class, 'show']);
});

Route::group(['prefix' => 'warga/profile'], function () {
    Route::get('/', [WargaProfileController::class, 'index']);
});
