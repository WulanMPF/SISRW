<?php

namespace App\Http\Controllers\Login;

use App\Http\Controllers\Controller;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function index()
    {
        // Kita ambil data user lalu simpan pada variable $user
        $user = Auth::user();

        // Kondisi jika user nya ada
        if ($user) {
            // Jika user nya memiliki level Admin
            if ($user->level_id == '1') {
                return redirect()->intended('admin');
            }
            // Jika user nya memiliki level Ketua RW
            else if ($user->level == '2') {
                return redirect()->intended('ketua');
            }
            // Jika user nya memiliki level Sekretaris RW
            else if ($user->level == '3') {
                return redirect()->intended('sekretaris');
            }
            // Jika user nya memiliki level Bendahara RW
            else if ($user->level == '4') {
                return redirect()->intended('bendahara');
            }
            // Jika user nya memiliki level Warga
            else if ($user->level == '5') {
                return redirect()->intended('warga');
            }
        }
        return view('login.index');
    }

    public function proses_login(Request $request)
    {
        // Setelah login berhasil, arahkan ke dashboard sesuai dengan peran pengguna
        if (Auth::check()) {
            $user = Auth::user();
            // Cek lagi jika level user admin maka arahkan ke halaman admin
            if ($user->level_id == '1') {
                //dd($user->level_id);
                return redirect()->intended('admin');
            }
            // Tapi jika level user nya user biasa maka arahkan ke halaman ketua
            else if ($user->level_id == '2') {
                return redirect()->intended('ketua');
            }
            // Tapi jika level user nya user biasa maka arahkan ke halaman sekretaris
            else if ($user->level_id == '3') {
                return redirect()->intended('sekretaris');
            }
            // Tapi jika level user nya user biasa maka arahkan ke halaman bendahara
            else if ($user->level_id == '4') {
                return redirect()->intended('bendahara');
            }
            // Tapi jika level user nya user biasa maka arahkan ke halaman warga
            else if ($user->level_id == '5') {
                return redirect()->intended('warga');
            }
            // Jika belum ada role maka ke halaman /
            return redirect()->intended('/');
        }

        // Jika login gagal, kembali ke halaman login dengan pesan kesalahan
        return redirect('login.index')
            ->withInput()
            ->withErrors(['login_gagal' => 'Pastikan kembali username dan password yang dimasukkan sudah benar']);
    }
}
