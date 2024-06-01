<?php

namespace App\Http\Controllers\Login;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\UserModel;
use App\Models\WargaModel;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function forgot_password()
    {
        return view('auth.forgot-password');
    }

    public function forgot_password_act(Request $request)
    {
        // (kode forgot_password_act tetap sama)
    }

    public function validasi_forgot_password_act(Request $request)
    {
        // (kode validasi_forgot_password_act tetap sama)
    }

    public function validasi_forgot_password(Request $request, $token)
    {
        // (kode validasi_forgot_password tetap sama)
    }

    public function login_proses(Request $request)
    {
        $request->validate([
            'nik' => 'required|digits:16',
            'password' => 'required',
        ], [
            'nik.required' => 'NIK tidak boleh kosong',
            'nik.digits' => 'NIK harus terdiri dari 16 digit',
            'password.required' => 'Password tidak boleh kosong',
        ]);

        // Ambil data user berdasarkan NIK yang diberikan
        $user = UserModel::whereHas('warga', function ($query) use ($request) {
            $query->where('nik', $request->nik);
        })->first();

        // Jika user tidak ditemukan atau password salah, kembalikan ke halaman login
        if (!$user || !Hash::check($request->password, $user->password)) {
            return redirect()->route('login')->with('failed', 'NIK atau Password Salah');
        }

        // Authentikasi pengguna dengan menggunakan user yang ditemukan
        Auth::login($user);

        // Cek level_id dan arahkan ke halaman yang sesuai
        switch ($user->level_id) {
            case 2:
                return redirect()->route('ketua.dashboard');
            case 3:
                return redirect()->route('sekretaris.dashboard');
            case 4:
                return redirect()->route('bendahara.dashboard');
            case 5:
                return redirect()->route('warga.dashboard');
            default:
                return redirect()->route('admin.dashboard'); // Default redirect jika level_id tidak cocok
        }
    }



    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')->with('success', 'Kamu berhasil logout');
    }

    public function register()
    {
        return view('auth.register');
    }

    public function register_proses(Request $request)
    {
        $request->validate([
            'nik' => 'required|digits:16',
            'email' => 'required|string|email|max:255|unique:user',
            'password' => 'required|string|min:8|confirmed',
        ], [
            'nik.required' => 'NIK tidak boleh kosong',
            'nik.digits' => 'NIK harus terdiri dari 16 digit',
            'email.required' => 'Email tidak boleh kosong',
            'email.email' => 'Email tidak valid',
            'email.unique' => 'Email sudah terdaftar',
            'password.required' => 'Password tidak boleh kosong',
            'password.min' => 'Password minimal 8 karakter',
            'password.confirmed' => 'Konfirmasi password tidak cocok',
        ]);

        // Cari data warga berdasarkan NIK
        $warga = WargaModel::where('nik', $request->nik)->first();

        // Jika warga tidak ditemukan, kembalikan ke halaman registrasi dengan pesan error
        if (!$warga) {
            return redirect()->back()->with('failed', 'Warga dengan NIK tersebut tidak ditemukan');
        }

        // Buat entri baru pada tabel user dengan warga_id yang sesuai
        $user = UserModel::create([
            'level_id' => 5, // Atur level_id menjadi 5
            'warga_id' => $warga->warga_id,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('login')->with('success', 'Akun berhasil dibuat!');
    }
}
