<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Pasien;
use RealRashid\SweetAlert\Facades\Alert;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            Alert::success('Login Berhasil', 'Selamat datang kembali!');
            return redirect()->intended('home');
        }

        Alert::error('Login Gagal', 'Email atau password salah.');
        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        try {
            DB::transaction(function () use ($request) {
                $user = User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'type' => '0',
                    'password' => Hash::make($request->password),
                ]);

                Pasien::create([
                    'user_id' => $user->id,
                ]);
            });

            Alert::success('Berhasil Membuat Akun', 'Silahkan Login Kembali');
            return redirect()->route('login');
        } catch (\Exception $e) {
            Alert::error('Gagal Membuat Akun', 'Terjadi kesalahan, silahkan coba lagi.');
            return redirect()->back()->withInput();
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        Alert::success('Logout Berhasil', 'Anda telah keluar.');
        return redirect('/');
    }
}
