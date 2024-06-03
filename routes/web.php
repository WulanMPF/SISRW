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

Route::get('/forgot-password', [LoginController::class, 'forgot_password'])->name('forgot-password');
Route::post('/forgot-password-act', [LoginController::class, 'forgot_password_act'])->name('forgot-password-act');

Route::get('/validasi-forgot-password/{token}', [LoginController::class, 'validasi_forgot_password'])->name('validasi-forgot-password');
Route::post('/validasi-forgot-password-act', [LoginController::class, 'validasi_forgot_password_act'])->name('validasi-forgot-password-act');

Route::post('/login-proses', [LoginController::class, 'login_proses'])->name('login-proses');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [LoginController::class, 'register'])->name('register');
Route::post('/register-proses', [LoginController::class, 'register_proses'])->name('register-proses');

Route::get('/reset-password', [LoginController::class, 'forgot_password'])->name('forgot-password');
Route::post('/reset-proses', [LoginController::class, 'register_proses'])->name('register-proses');
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
    Route::get('/', [DashboardController::class, 'index'])->name('ketua.dashboard');;
});
Route::group(['prefix' => 'ketua/warga'], function () {
    Route::get('/', [WargaController::class, 'index'])->name('warga.index');
    Route::get('/sementara', [WargaController::class, 'indexSementara'])->name('warga.indexSementara');
    Route::post('/list', [WargaController::class, 'list']);
    Route::post('/list-sementara', [WargaController::class, 'listSementara']);
    Route::get('/create-kk', [WargaController::class, 'createKK']);
    Route::get('/create-warga/{kk_id}', [WargaController::class, 'createWarga'])->name('warga.create');
    Route::post('/tetap-kk', [WargaController::class, 'storeKK']);
    Route::post('/tetap-warga', [WargaController::class, 'storeWarga']);
    Route::get('/create-sementara', [WargaController::class, 'createSementara']);
    Route::post('/sementara', [WargaController::class, 'storeSementara']);
    Route::get('/edit-warga/{kk_id}/{warga_id}', [WargaController::class, 'editWarga']);
    Route::put('/update-warga/{warga_id}', [WargaController::class, 'updateWarga']);
    Route::get('/edit-kk/{kk_id}', [WargaController::class, 'editKK']);
    Route::put('/update-kk/{kk_id}', [WargaController::class, 'updateKK']);
    Route::get('/{kk_id}', [WargaController::class, 'show'])->name('warga.show');
    Route::get('/show/{warga_id}', [WargaController::class, 'showSementara']);
    Route::delete('/destroy-warga/{kk_id}/{warga_id}', [WargaController::class, 'destroyWarga']);
    Route::delete('/destroy-kk/{kk_id}', [WargaController::class, 'destroyKK']);
    Route::delete('/destroy-wargaSementara/{warga_id}', [WargaController::class, 'destroyWargaSementara']);
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
    Route::get('/', [UmkmController::class, 'index'])->name('umkm.index');
    Route::post('/list', [UmkmController::class, 'list']);
    Route::get('/create', [UmkmController::class, 'create']);
    Route::post('/', [UmkmController::class, 'store'])->name('tambahUMKM');
    Route::get('/{id}', [UmkmController::class, 'show']);
    Route::get('/{id}/edit', [UmkmController::class, 'edit']);
    Route::put('/{id}', [UmkmController::class, 'update']);
    Route::delete('/deactive/{umkm_id}', [UmkmController::class, 'deactive']);
    Route::get('/{umkm_id}/accept', [UmkmController::class, 'acceptUmkm']);
    Route::get('/{umkm_id}/reject', [UmkmController::class, 'rejectUmkm']);
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
    Route::get('/', [PengaduanController::class, 'index'])->name('pengaduan.index');
    Route::post('/list', [PengaduanController::class, 'list']);
    Route::get('/{id}', [PengaduanController::class, 'show'])->name('pengaduan.show');
    Route::get('/{id}/show', [PengaduanController::class, 'show'])->name('pengaduan.show');
    Route::get('/{id}/edit', [PengaduanController::class, 'edit']);
    Route::put('/{id}', [PengaduanController::class, 'update'])->name('pengaduan.update');
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
    Route::get('/', [SekretarisDashboardController::class, 'index'])->name('sekretaris.dashboard');;
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
    Route::get('/', [PengumumanController::class, 'index'])->name('sekretaris.pengumuman.index');
    Route::get('/create', [PengumumanController::class, 'create'])->name('sekretaris.pengumuman.create');
    Route::post('/', [PengumumanController::class, 'store'])->name('sekretaris.pengumuman.store');
    Route::get('/{id}', [PengumumanController::class, 'show'])->name('sekretaris.pengumuman.show');
    Route::get('/{id}/edit', [PengumumanController::class, 'edit'])->name('sekretaris.pengumuman.edit');
    Route::put('/{id}', [PengumumanController::class, 'update'])->name('sekretaris.pengumuman.update');
    Route::delete('/{id}', [PengumumanController::class, 'destroy'])->name('sekretaris.pengumuman.destroy');
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
    Route::get('/', [BendaharaDashboardController::class, 'index'])->name('bendahara.dashboard');;
});
Route::group(['prefix' => 'bendahara/iuran'], function () {
    Route::get('/', [BendaharaIuranController::class, 'index'])->name('bendahara.iuran.index');
    Route::post('/list', [BendaharaIuranController::class, 'list'])->name('bendahara.iuran.list');
    Route::get('/{id_periode}', [BendaharaIuranController::class, 'bayar'])->name('bendahara.iuran.bayar');
    Route::post('/', [BendaharaIuranController::class, 'store'])->name('iuran.store');
    // Route::get('/{id}', [BendaharaIuranController::class, 'show'])->name('bendahara.iuran.show');
    // Route::get('/create', [BendaharaIuranController::class, 'create'])->name('iuran.create');
});
Route::group(['prefix' => 'bendahara/laporan'], function () {
    Route::get('/', [BendaharaLapkeuController::class, 'index']);
    Route::post('/list', [BendaharaLapkeuController::class, 'list']);
    Route::get('/create', [BendaharaLapkeuController::class, 'create'])->name('laporan.create');
    Route::post('/', [BendaharaLapkeuController::class, 'store'])->name('laporan.store');
    Route::get('/{id}', [BendaharaLapkeuController::class, 'show']);
    Route::get('/{id}/edit', [BendaharaLapkeuController::class, 'edit']);
    Route::put('/{id}', [BendaharaLapkeuController::class, 'update'])->name('laporan.update');
    Route::delete('/{id}', [BendaharaLapkeuController::class, 'destroy']);
});
Route::group(['prefix' => 'bendahara/profile'], function () {
    Route::get('/', [BendaharaProfileController::class, 'index']);
});

// Route Halaman Warga
Route::group(['prefix' => 'warga/dashboard'], function () {
    Route::get('/', [WargaDashboardController::class, 'index'])->name('warga.dashboard');
});
Route::group(['prefix' => 'warga/iuran'], function () {
    Route::get('/', [WargaIuranController::class, 'index']);
    Route::post('/list', [WargaIuranController::class, 'list']);
    Route::get('/{id}', [WargaIuranController::class, 'show']);
});

Route::group(['prefix' => 'warga/pengaduan'], function () {
    Route::get('/', [WargaPengaduanController::class, 'index'])->name('pengaduan.index');
    Route::post('/list', [WargaPengaduanController::class, 'list']);
    Route::post('/', [WargaPengaduanController::class, 'store'])->name('pengaduan.store');
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
