<?php

namespace App\Http\Controllers\Login;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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

        $credentials = [
            'nik' => $request->nik,
            'password' => $request->password,
        ];

        if (Auth::attempt($credentials)) {
            return redirect()->route('admin.dashboard');
        } else {
            return redirect()->route('login')->with('failed', 'NIK atau Password Salah');
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
            'nik' => 'required|unique:users|digits:16',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ], [
            'nik.required' => 'NIK tidak boleh kosong',
            'nik.unique' => 'NIK sudah terdaftar',
            'nik.digits' => 'NIK harus terdiri dari 16 digit',
            'name.required' => 'Nama lengkap tidak boleh kosong',
            'email.required' => 'Email tidak boleh kosong',
            'email.email' => 'Email tidak valid',
            'email.unique' => 'Email sudah terdaftar',
            'password.required' => 'Password tidak boleh kosong',
            'password.min' => 'Password minimal 8 karakter',
            'password.confirmed' => 'Konfirmasi password tidak cocok',
        ]);

        User::create([
            'nik' => $request->nik,
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('login')->with('success', 'Akun berhasil dibuat!');
    }
}
